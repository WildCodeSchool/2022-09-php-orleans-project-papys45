<?php

namespace App\Controller;

use App\Controller\AbstractController;

class ListRouteController extends AbstractController
{
    public function index()
    {

        return $this->twig->render('List/listRoute.html.twig');
    }
}
