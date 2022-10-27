<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\RouteManager;

class ListRouteController extends AbstractController
{
    public function index()
    {
        $itemManager = new RouteManager();
        $routes = $itemManager->selectAll();

        return $this->twig->render('List/listRoute.html.twig', ['routes' => $routes]);
    }
}
