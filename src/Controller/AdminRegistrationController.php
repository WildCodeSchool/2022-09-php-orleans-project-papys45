<?php

namespace App\Controller;

use App\Model\MemberManager;
use App\Model\RegistrationManager;

class AdminRegistrationController extends AbstractController
{
    public function index(int $id): string
    {
        $registrationManager = new RegistrationManager();
        $registrations = $registrationManager->selectByRouteId($id);
        return $this->twig->render(
            'Admin/registration.html.twig',
            ['registrations' => $registrations]
        );
    }
}
