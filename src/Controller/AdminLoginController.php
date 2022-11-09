<?php

namespace App\Controller;

use App\Model\UserManager;
use App\Controller\AbstractController;

class AdminLoginController extends AbstractController
{
    public function login(): string
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userLogin = array_map('trim', $_POST);
            $userManager = new UserManager();

            $errors = $this->verificationLogin($userLogin);

            if (empty($errors)) {
                $user = $userManager->selectOneByEmail($userLogin['email']);

                if ($user && password_verify($userLogin['password'], $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    header('Location: /admin/membres');

                    return '';
                } else {
                    $errors[] = 'Erreur d\'authentification';

                    return $this->twig->render('Admin/login.html.twig', ['errors' => $errors]);
                }
            } else {
                return $this->twig->render('Admin/login.html.twig', ['errors' => $errors]);
            }
        }
        return $this->twig->render('Admin/login.html.twig', ['errors' => $errors]);
    }

    public function logout(): void
    {
        if (isset($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
        }

        header('Location: /');
    }

    private function verificationLogin(array $userLogin): array
    {
        $errors = [];

        if (!filter_var(($userLogin['email']), FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Le format d\'email est incorrect';
        }

        if (empty($userLogin['email'])) {
            $errors[] = 'L\'email est obligatoire';
        }

        if (empty($userLogin['password'])) {
            $errors[] = 'Le mot de passe est obligatoire';
        }

        return $errors;
    }
}
