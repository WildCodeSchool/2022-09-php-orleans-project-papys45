<?php

namespace App\Controller;

use App\Model\MemberManager;
use App\Model\RegistrationManager;

class AdminRegistrationController extends AbstractController
{
    public function index(): string
    {
        $adminMemberManager = new MemberManager();
        $members = $adminMemberManager->selectAll('firstname');

        return $this->twig->render(
            'Admin/addRegistration.html.twig',
            ['members' => $members]
        );
    }
    public function add(): string
    {
        return $this->twig->render('Admin/addRegistration.html.twig');
    }
}
