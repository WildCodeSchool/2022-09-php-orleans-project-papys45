<?php

namespace App\Controller;

use App\Model\MemberManager;

class AdminMemberController extends AbstractController
{
    public function index(): string
    {
        $membersManager = new MemberManager();
        $members = $membersManager->selectAll('firstname');

        return $this->twig->render('Admin/members.html.twig', ['members' => $members]);
    }

    public function login(): string
    {
        return $this->twig->render('Admin/login.html.twig');
    }
}
