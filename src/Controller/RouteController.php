<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\RouteManager;
use App\Model\MemberManager;
use App\Model\RegisterManager;

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

    public function showRoute(int $id): string
    {
        $itemRouteManager = new RouteManager();
        $route = $itemRouteManager->selectOneById($id);

        $registerManager = new RegisterManager();
        $photos = $registerManager->selectByRouteId($id);

        $photos = array_column($photos, 'photo');

        return $this->twig->render('DetailRoute/DetailRoute.html.twig', ['route' => $route, 'photos' => $photos]);
    }
}
