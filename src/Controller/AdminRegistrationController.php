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

        $adminMembersManager = new MemberManager();
        $members = $adminMembersManager->selectAll('firstname');

        $registrationManager = new RegistrationManager();
        $registrations = $registrationManager->selectByRouteId($id);
        return $this->twig->render(
            'Admin/registration.html.twig',
            [
                'registrations' => $registrations,
                'members' => $members,
                'route' => $route
            ]
        );
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['member_id']);
            $idRoute = trim($_POST['route_id']);
            $registrationManager = new RegistrationManager();
            $registrationManager->deleteByRouteId((int)$idRoute, (int)$id);

            header('Location:/admin/inscription?id=' . $idRoute);
        }
    }
}
