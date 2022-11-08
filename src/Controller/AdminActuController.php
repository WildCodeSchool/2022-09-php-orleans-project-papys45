<?php

namespace App\Controller;

use App\Model\ActualityManager;
use App\Controller\AbstractController;

class AdminActuController extends AbstractController
{
    public function index(): string
    {
        $adminActuManager = new ActualityManager();
        $actualities = $adminActuManager->selectAll();

        return $this->twig->render('Admin/admin_actuality.html.twig', ['actualities' => $actualities]);
    }

    public function add(string $actuality = ''): void
    {
        $actualities = [];
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $actualities = array_map('trim', $_POST);
        }
    }
}
