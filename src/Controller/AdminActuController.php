<?php

namespace App\Controller;

use App\Model\ActualityManager;

class ActualityController extends AbstractController
{
    public function index(): string
    {
        $adminActualityManager = new ActualityManager();
        $actuality = $adminActualityManager->selectAll('title');

        return $this->twig->render('Admin/admin_actuality.html.twig', ['title' => $actuality]);
    }

    public function edit (): void
    {
        
    }
}
