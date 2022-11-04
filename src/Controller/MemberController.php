<?php

namespace App\Controller;

use App\Model\MemberManager;
use App\Controller\AbstractController;

class MemberController extends AbstractController
{
    public function index(): string
    {
        $adminMembersManager = new MemberManager();
        $members = $adminMembersManager->selectAll('firstname');

        return $this->twig->render('Admin/members.html.twig', ['members' => $members]);
    }
}
