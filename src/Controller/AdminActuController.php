<?php

namespace App\Controller;

use App\Model\ActualityManager;
use App\Controller\AbstractController;

class AdminActuController extends AbstractController
{
    public function index(): string
    {
        $adminActualityManager = new ActualityManager();
        $actualities = $adminActualityManager->selectAll();

        return $this->twig->render('Admin/admin_actuality.html.twig', ['actualities' => $actualities]);
    }
}
