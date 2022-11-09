<?php

namespace App\Controller;

use App\Model\UserManager;
use DateTime;
use App\Model\MemberManager;
use App\Controller\AbstractController;

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
        'president' => 'Président',
        'vice' => 'Vice-président',
        'accountant' => 'Comptable',
        'secretary' => 'Secrétaire',
        'adjSecretary' => 'Secrétaire-adjoint',
        'member' => 'Membre actif'
    ];


    public function index(): string
    {
        if (!$this->user) {
            header('HTTP/1.1 401 Unauthorized');

            return $this->twig->render('Error/error.html.twig');
        }

        $memberManager = new MemberManager();
        $members = $memberManager->selectAll('firstname');

        return $this->twig->render('Admin/members.html.twig', ['members' => $members]);
    }

    private function uploadFile(): array
    {
        $errors = [];
        $files = $_FILES;
        $uploadFile = '';
        $uniqName = '';
        $fileName = '';

        if (!empty($files['photo']['name'])) {
            $errorsUpload = $this->verifUpload($files);

            if (empty($errorsUpload)) {
                $extension = pathinfo($files['photo']['name'], PATHINFO_EXTENSION);
                $uniqName = uniqid('', true) . '.' . $extension;
                $uploadFile = self::UPLOAD_DIR . $uniqName;
            }

            if (!empty($errorsUpload) || !move_uploaded_file($files['photo']['tmp_name'], $uploadFile)) {
                $errors[] = $files['photo']['name'] . ' n\'a pu être chargé. Veuillez réessayer.';
            } else {
                $fileName = $uniqName;
            }

            $errors = array_merge($errorsUpload, $errors);
        }

        return [$errors, $fileName];
    }

    private function controlDateOfBirth(string $memberDateOfBirth): array
    {
        $errors = [];
        $dateOfBirth = new DateTime();
        $date = explode("-", $memberDateOfBirth);
        $dateOfBirth->setDate(intval($date[0]), intval($date[1]), intval($date[2]));

        if (!$dateOfBirth::getLastErrors()) {
            $errors[] = 'La date d\'anniversaire est incorrecte.';
        }

        return $errors;
    }

    public function add(string $message = ''): string
    {
        if (!$this->user) {
            header('HTTP/1.1 401 Unauthorized');

            return $this->twig->render('Error/error.html.twig');
        }
        $errors = [];
        $member = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $member = array_map('trim', $_POST);
            $errors = array_merge($this->verification($member), $errors);
            $errors = array_merge($this->controlDateOfBirth($member['dateOfBirth']), $errors);
            $errors = array_merge($this->roleVerification($member['role']), $errors);

            $uploadResult = $this->uploadFile();
            $errors = array_merge($uploadResult[0], $errors);
            $member['photo'] = $uploadResult[1];

            if (empty($errors)) {
                $memberManager = new MemberManager();
                $memberManager->insert($member);
                header('location: /admin/membres/add?message=success');

                return '';
            }
        }

        return $this->twig->render(
            'Admin/membersAdd.html.twig',
            [
                'member' => $member,
                'roles' => self::ROLES,
                'errors' => $errors,
                'message' => $message,
                'label' => 'Ajouter',
            ]
        );
    }

    public function edit(int $id, string $message = ''): ?string
    {
        $errors = [];
        $memberManager = new MemberManager();
        $member = $memberManager->selectOneById($id);
        $lastRole = $member['role'];
        $lastPhoto = $member['photo'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $member = array_map('trim', $_POST);
            $uploadResult = $this->uploadFile();
            $errors = $uploadResult[0];
            $member['photo'] = $uploadResult[1];

            if ($lastRole != $member['role']) {
                $errors = array_merge($this->roleVerification($member['role']));
            }

            if (
                $lastPhoto != $member['photo'] &&
                !empty($lastPhoto) &&
                file_exists(self::UPLOAD_DIR . $lastPhoto)
            ) {
                unlink(self::UPLOAD_DIR . $lastPhoto);
            }

            if (empty($errors)) {
                $memberManager->update($member);
                header('location: /admin/membres/edit?id=' . $id . '&message=success');

                return '';
            }
        }

        return $this->twig->render('Admin/membersEdit.html.twig', [
            'member' => $member,
            'roles' => self::ROLES,
            'errors' => $errors,
            'message' => $message,
            'label' => 'Modifier',
        ]);
    }

    private function roleVerification(string $role): array
    {
        $errors = [];
        $memberManager = new MemberManager();

        if ($role !== 'member' && !empty($role)) {
            if ($memberManager->selectOneByRole($role)) {
                $errors[] = 'Vous ne pouvez pas choisir un rôle dans l\'association déjà attribué.';
            }
        }

        return $errors;
    }

    private function verifUpload(array $files): array
    {
        $errors = [];

        if (file_exists($files['photo']['tmp_name']) && filesize($files['photo']['tmp_name']) > self::MAX_FILE_SIZE) {
            $errors[] = 'Votre fichier doit être inférieur à ' . self::MAX_FILE_SIZE / 1000000 . 'Mo.';
        }

        if ((!in_array(pathinfo($files['photo']['name'], PATHINFO_EXTENSION), self::AUTH_EXTENSION))) {
            $extString = implode(', ', self::AUTH_EXTENSION);
            $errors[] = 'Veuillez sélectionner une image de type ' . $extString . '.';
        }

        if (!empty($files['error'])) {
            $errors[] = 'Erreur d \'upload : ' . $files['error'] . '.';
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
