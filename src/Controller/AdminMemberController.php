<?php

namespace App\Controller;

use App\Model\AdminMemberManager;

class AdminMemberController extends AbstractController
{
    public function index(): string
    {
        $adminMembersManager = new AdminMemberManager();
        $members = $adminMembersManager->selectAll();

        return $this->twig->render('Admin/members.html.twig', ['members' => $members]);
    }
}
