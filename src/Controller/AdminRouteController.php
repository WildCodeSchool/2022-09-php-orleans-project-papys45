<?php

namespace App\Controller;

use App\Model\RouteManager;

class AdminRouteController extends AbstractController
{
    public function index(string $message = ''): string
    {
        $this->isAuthorizedToAccess();

        $routeManager = new RouteManager();
        $route = $routeManager->selectAll('date', 'DESC');

        return $this->twig->render('AdminRoute/adminRoute.html.twig', ['routes' => $route, 'message' => $message]);
    }

    public function delete(): void
    {
        $this->isAuthorizedToAccess();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $routeManager = new RouteManager();
            $routeManager->delete((int)$id);

            header('Location: /admin/route?message=success');
        }
    }
}
