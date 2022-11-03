<?php

namespace App\Controller;

use App\Model\AdminMemberManager;

class AdminMemberController extends AbstractController
{
    public const MAX_FIRSTNAME_LENGTH = 80;
    public const MAX_LASTNAME_LENGTH = 80;
    public const MAX_ROLE_LENGTH = 20;
    public const MAX_MAIL_LENGTH = 255;
    public const MAX_FILE_SIZE = 1000000;
    public const AUTH_EXTENSION = ['jpg', 'png', 'jpeg'];
    public const UPLOAD_DIR = 'upload/';
    public const ROLES = [
        'President' => 'Président',
        'vice' => 'Vice-président',
        'accountant' => 'Comptable',
        'secretary' => 'Secrétaire',
        'adjSecretary' => 'Secrétaire-adjoint',
        'activeMember' => 'Membre actif'
    ];
    public function index(): string
    {
        $adminMembersManager = new AdminMemberManager();
        $members = $adminMembersManager->selectAll('firstname');

        return $this->twig->render('Admin/members.html.twig', ['members' => $members]);
    }

    public function add(string $message = '', array $member = ['photo' => 'default.svg']): ?string
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $member = array_map('trim', $_POST);

            if (!empty($_FILES['photo']['name'])) {
                $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                $errorsUpload = $this->verifUpload($extension);

                if (empty($errorsUpload)) {
                    $uniqName = uniqid('', true) . '.' . $extension;
                    $uploadFile = self::UPLOAD_DIR . $uniqName;

                    if (!move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                        $errors[] = $_FILES['photo']['name'] . 'n\'a pas pu être uploadé. Veuillez réessayer.';
                    } else {
                        $member['photo'] = $uniqName;
                    }
                } else {
                    $errors = array_merge($errorsUpload, $errors);
                }
            }


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
                $adminMembersManager = new AdminMemberManager();
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
    private function verifUpload(string $extension): array
    {
        $errors = [];

        if (file_exists($_FILES['photo']['tmp_name']) && filesize($_FILES['photo']['tmp_name']) > self::MAX_FILE_SIZE) {
            $errors[] = 'Votre fichier doit être inférieur à ' . self::MAX_FILE_SIZE / 1000000 . 'Mo.';
        }

        if ((!in_array($extension, self::AUTH_EXTENSION))) {
            $extString = implode(', ', self::AUTH_EXTENSION);
            $errors[] = 'Veuillez sélectionner une image de type ' . $extString . '.';
        }

        if (!empty($_FILES['error'])) {
            $errors[] = 'Erreur d \'upload : ' . $_FILES['error'] . '.';
        }

        return $errors;
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
