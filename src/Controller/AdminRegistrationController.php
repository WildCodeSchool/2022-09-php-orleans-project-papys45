<?php

namespace App\Controller;

use App\Model\RouteManager;
use App\Model\MemberManager;
use App\Model\RegistrationManager;

class AdminRegistrationController extends AbstractController
{
    public function index(int $id): string
    {
        $itemRouteManager = new RouteManager();
        $route = $itemRouteManager->selectOneById($id);

        $registrationManager = new RegistrationManager();
        $registrations = $registrationManager->selectByRouteId($id);

        return $this->twig->render(
            'Admin/registration.html.twig',
            [
                'registrations' => $registrations,
                'route' => $route
            ]
        );
    }

    public function add($id): string
    {
        $itemRouteManager = new RouteManager();
        $route = $itemRouteManager->selectOneById($id);

        $adminMembersManager = new MemberManager();
        $members = $adminMembersManager->selectAll('firstname');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $registration = array_map('trim', $_POST);

            $registrationManager = new RegistrationManager();
            $registrationManager->insert($registration);

            header('Location:/admin/inscription?id=' . $id);
        }
        return $this->twig->render(
            'Admin/addRegistration.html.twig',
            [
                'members' => $members,
                'route' => $route
            ]
        );
    }
}
