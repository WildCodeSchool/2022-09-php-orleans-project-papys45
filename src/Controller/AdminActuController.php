<?php

namespace App\Controller;

use App\Model\ActualityManager;
use App\Controller\AbstractController;

class AdminActuController extends AbstractController
{
    public const MAX_LENGTH = 255;

    public function index(): string
    {
        $adminActuManager = new ActualityManager();
        $actualities = $adminActuManager->selectAll();

        return $this->twig->render('Admin/Actualities/admin_actuality.html.twig', ['actualities' => $actualities]);
    }

    public function add(string $actuality = ''): string
    {
        $actuality = [];
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $actuality = array_map('trim', $_POST);

            if (empty($actuality['title'])) {
                $errors[] = 'Veuillez renseigner un titre';
            }

            if (strlen($actuality['title']) > self::MAX_LENGTH) {
                $errors[] = 'Le titre doit faire moins de ' . self::MAX_LENGTH . ' caractères';
            }

            if (empty($actuality['content'])) {
                $errors[] = 'Veuillez renseigner une actualité';
            }

            if (empty($errors)) {
                $adminActuManager = new ActualityManager();
                $adminActuManager->add($actuality);

                header("Location: /admin/actualites?message=success");

                return '';
            }
        }

        return $this->twig->render(
            'Admin/Actualities/form_actu_add.html.twig',
            [
                'errors' => $errors,
                'actuality' => $actuality,
            ]
        );
    }

    public function update(int $id, string $actuality = ''): ?string
    {
        $errors = [];
        $actualityManager = new ActualityManager();
        $actuality = $actualityManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $actuality = array_map('trim', $_POST);

            if (empty($actuality['title'])) {
                $errors[] = 'Veuillez renseigner un titre';
            }

            if (strlen($actuality['title']) > self::MAX_LENGTH) {
                $errors[] = 'Le titre doit faire moins de ' . self::MAX_LENGTH . ' caractères';
            }

            if (empty($actuality['content'])) {
                $errors[] = 'Veuillez renseigner une actualité';
            }

            if (empty($errors)) {
                $actualityManager->update($actuality);
                header('location: /admin/actualites?id=' . $id . '&message=success');

                return '';
            }
        }

        return $this->twig->render('Admin/Actualities/form_actu_edit.html.twig', [
            'errors' => $errors,
            'actuality' => $actuality,
        ]);
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $actualityManager = new ActualityManager();
            $actualityManager->delete((int)$id);

            header('Location: /admin/actualites?message=success');
        }
    }
}
