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

        return $this->twig->render('Admin/Actualities/admin_actuality.html.twig', ['actualities' => $actualities]);
    }
}
