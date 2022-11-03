<?php

namespace App\Controller;

use App\Model\AdminRouteManager;

class AdminRouteController extends AbstractController
{
    public function index(): string
    {
        $adminRouteManager = new AdminRouteManager();
        $route = $adminRouteManager->selectAll();

        return $this->twig->render('AdminRoute/adminRoute.html.twig', ['route' => $route]);
    }
}
