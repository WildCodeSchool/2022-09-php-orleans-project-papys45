<?php

namespace App\Controller;

use App\Model\ActualityManager;

class ActualityController extends AbstractController
{
    public function index(): string
    {
        $actualityManager = new ActualityManager();
        $actuality = $actualityManager->selectAll('title');

        return $this->twig->render('Admin/admin_actuality.html.twig', ['title' => $actuality]);
    }
}
