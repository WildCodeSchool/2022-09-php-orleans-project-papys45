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

    public function add(int $id): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $registration = array_map('trim', $_POST);

            $registrationManager = new RegistrationManager();
            $registrationManager->insert($registration);

            header('Location:/admin/inscription/ajouter?id=' . $id);
            return '';
        }
        return $this->twig->render('Admin/addRegistration.html.twig');
    }
}
