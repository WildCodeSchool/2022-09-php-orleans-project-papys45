<?php

namespace App\Controller;

use App\Model\RouteManager;

class RouteController extends AbstractController
{
    public function index()
    {
        $routeManager = new routeManager();
        $routes = $routeManager->selectAll();

        return $this->twig->render('list_route/list_route.html.twig', [
            'routes' => $routes,
        ]);
    }
}
