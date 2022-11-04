<?php

namespace App\Controller;

use App\Model\RouteManager;

class AdminRouteController extends AbstractController
{
    public function index(): string
    {
        $RouteManager = new RouteManager();
        $route = $RouteManager->selectAll('date', 'DESC');

        return $this->twig->render('AdminRoute/adminRoute.html.twig', ['route' => $route]);
    }
}
