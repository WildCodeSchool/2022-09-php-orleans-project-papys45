<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\RouteManager;

class RouteController extends AbstractController
{

    public const EASY_ROUTE = 1;
    public const MEDIUM_ROUTE = 2;
    public const HARD_ROUTE = 3;

    public function index()
    {
        $itemManager = new RouteManager();
        $routes = $itemManager->selectAll('date', 'DESC');

        return $this->twig->render('List/listRoute.html.twig', ['routes' => $routes]);
    }
}
