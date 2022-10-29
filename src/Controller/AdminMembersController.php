<?php

namespace App\Controller;

use App\Model\AdminMembersManager;

class AdminMembersController extends AbstractController
{
    public function index(): string
    {
        $adminMembersManager = new AdminMembersManager();
        $members = $adminMembersManager->selectAll();

        return $this->twig->render('Admin/members.html.twig', ['members' => $members]);
    }
}
