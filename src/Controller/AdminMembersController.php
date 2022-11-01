<?php

namespace App\Controller;

use App\Model\AdminMembersManager;

class AdminMembersController extends AbstractController
{
    public const MAX_FIRSTNAME_LENGTH = 80;
    public const MAX_LASTNAME_LENGTH = 80;
    public const MAX_ROLE_LENGTH = 20;
    public const MAX_MAIL_LENGTH = 255;
    public const ROLES = [
        'president' => 'Président',
        'vice_president' => 'Vice-président',
        'accountant' => 'Comptable',
        'secretary' => 'Secrétaire',
        'vice_secretary' => 'Secrétaire-adjoint',
        'member' => 'Membre actif'
    ];
    public function index(): string
    {
        $adminMembersManager = new AdminMembersManager();
        $members = $adminMembersManager->selectAll();

        return $this->twig->render('Admin/members.html.twig', ['members' => $members]);
    }

    public function add($message = '', array $member = ['photo' => 'default.svg']): ?string
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $member = array_map('trim', $_POST);

            $errors = $this->verification($member);

            $dateOfBirth = str_replace('.', '-', $member['dateOfBirth']);
            $dateOfBirth = date("Y-m-d", strtotime($dateOfBirth));
            $date = explode("-", $dateOfBirth);

            if (!$this->checkDateOfBirth($date)) {
                $errors[] = 'La date d\'anniversaire est incorrecte.';
            } else {
                $member['dateOfBirth'] = implode('-', $date);
            }
            if (empty($errors)) {
                $adminMembersManager = new AdminMembersManager();
                $adminMembersManager->insert($member);

                header('location: /admin/membres/add?message=success');

                return '';
            }
        }
        return $this->twig->render('Admin/membersAdd.html.twig', [
            'member' => $member,
            'roles' => self::ROLES,
            'errors' => $errors,
            'message' => $message,
        ]);
    }

    private function verification(array $member): array
    {
        $errors = [];

        $errors = $this->verifEmpty($member, $errors);

        if (strlen($member['firstname']) > self::MAX_FIRSTNAME_LENGTH) {
            $errors[] = 'Le prénom doit être inférieur à ' . self::MAX_FIRSTNAME_LENGTH . ' caractères';
        }

        if (strlen($member['lastname']) > self::MAX_LASTNAME_LENGTH) {
            $errors[] = 'Le nom doit être inférieur à ' . self::MAX_LASTNAME_LENGTH . ' caractères';
        }

        if (!key_exists($member['role'], self::ROLES)) {
            $errors[] = 'Le role dans l\'association est incorrect.';
        }

        if (strlen($member['mail']) > self::MAX_MAIL_LENGTH) {
            $errors[] = 'L\'email doit être inférieur à ' . self::MAX_MAIL_LENGTH . ' caractères';
        }

        if (!filter_var(($member['mail']), FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Le format d\'email est incorrect';
        }

        return $errors;
    }

    private function checkDateOfBirth(array $date): bool
    {
        return checkdate(intval($date[1]), intval($date[2]), intval($date[0]));
    }



    private function verifEmpty(array $member, array $errors): array
    {
        if (empty($member['firstname'])) {
            $errors[] = 'Le prénom est obligatoire';
        }

        if (empty($member['lastname'])) {
            $errors[] = 'Le prénom est obligatoire';
        }

        if (empty($member['role'])) {
            $errors[] = 'Le rôle dans l\'association est obligatoire';
        }

        if (empty($member['dateOfBirth'])) {
            $errors[] = 'Le date de naissance est obligatoire';
        }

        if (empty($member['mail'])) {
            $errors[] = 'L\'email est obligatoire';
        }

        return $errors;
    }
}
