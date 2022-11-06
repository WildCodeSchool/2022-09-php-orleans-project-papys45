<?php

namespace App\Controller;

use App\Model\RouteManager;

class AddRouteController extends AbstractController
{
    public function index(): string
    {
        $adminMembersManager = new RouteManager();
        $members = $adminMembersManager->selectAll();

        return $this->twig->render('Admin/AddRouteForm.html.twig');
    }
}
