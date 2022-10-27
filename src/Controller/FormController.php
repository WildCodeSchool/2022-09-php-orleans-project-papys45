<?php

namespace App\Controller;

class FormController extends AbstractController
{
    public const MAX_FULLNAME_LENGTH = 90;
    public const MAX_EMAIL_LENGTH = 255;
    public const SUBJECTS = [
        'info' => 'Demande d\'informations',
        'remove' => 'Annuler une inscription à une sortie',
        'register' => 'Demande d\'adhésion',
    ];

    public function index(string $message = ''): string
    {
        $contact = [];
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contact = array_map('trim', $_POST);

            $errors = $this->verification($contact);

            if (empty($errors)) {
                //Do somethong, for example : send email, put informations in database
                // and redirection
                header('location: /contact?message=success');
                return '';
            }
        }
        return $this->twig->render(
            'Form/form.html.twig',
            ['errors' => $errors, 'contact' => $contact, 'subjects' => self::SUBJECTS, 'message' => $message]
        );
    }
    private function verification(array $contact): array
    {
        $errors = [];

        if (strlen($contact['fullName']) > self::MAX_FULLNAME_LENGTH) {
            $errors[] = 'Le nom doit être inférieur à ' . self::MAX_FULLNAME_LENGTH . ' caractères';
        }

        if (strlen($contact['email']) > self::MAX_EMAIL_LENGTH) {
            $errors[] = 'L\'email doit être inférieur à ' . self::MAX_EMAIL_LENGTH . ' caractères';
        }

        if (!filter_var(($contact['email']), FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Le format d\'email est incorrect';
        }

        if (!key_exists($contact['subject'], self::SUBJECTS)) {
            $errors[] = 'Le sujet est incorrect.';
        }
        if (empty($contact['fullName'])) {
            $errors[] = 'Le nom est obligatoire';
        }

        if (empty($contact['email'])) {
            $errors[] = 'L\'email est obligatoire';
        }

        if (empty($contact['subject'])) {
            $errors[] = 'Le sujet est obligatoire';
        }

        return $errors;
    }
}
