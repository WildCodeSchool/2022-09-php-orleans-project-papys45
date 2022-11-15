<?php

namespace App\Controller;

use App\Model\RegistrationManager;

class AdminRegistrationController extends AbstractController
{
    public function add(): string
    {

        return $this->twig->render('DetailRoute/DetailRoute.html.twig');
    }
}
