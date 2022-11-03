<?php

namespace App\Controller;

use App\Model\AdminActualityManager;

class ActualityController extends AbstractController
{
    public function actuality(): string
    {
        $adminActualityManager = new AdminActualityManager();
        $actuality = $adminActualityManager->selectAll('title');

        return $this->twig->render('Admin/admin_actuality.html.twig', ['title' => $actuality]);
    }
}
