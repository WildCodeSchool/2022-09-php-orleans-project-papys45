<?php

namespace App\Controller;

use App\Model\RouteManager;

class AddRouteController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('Admin/AddRouteForm.html.twig');
    }
}
