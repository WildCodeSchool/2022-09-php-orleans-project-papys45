<?php

namespace App\Controller;

use App\Model\RouteManager;

class AdminRouteController extends AbstractController
{
    public function index(): string
    {
        $routeManager = new RouteManager();
        $route = $routeManager->selectAll('date', 'DESC');

        return $this->twig->render('AdminRoute/adminRoute.html.twig', ['routes' => $route]);
    }

    public function delete(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $routeManager = new RouteManager();
            $routeManager->delete((int)$id);

            header('Location:/admin/deleteRoute');
        }
        return '';
    }
}
