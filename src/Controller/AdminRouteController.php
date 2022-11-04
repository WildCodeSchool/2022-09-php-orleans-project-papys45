<?php

namespace App\Controller;

use App\Model\RouteManager;

class AdminRouteController extends AbstractController
{
    public function index(): string
    {
        $routemanager = new RouteManager();
        $route = $routemanager->selectAll('date', 'DESC');

        return $this->twig->render('AdminRoute/adminRoute.html.twig', ['route' => $route]);
    }
}
