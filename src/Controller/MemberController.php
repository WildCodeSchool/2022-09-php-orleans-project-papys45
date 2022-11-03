<?php

namespace App\Controller;

use App\Model\MemberManager;
use App\Controller\AbstractController;

class MemberController extends AbstractController
{
    public function index(): string
    {

        $memberManager = new MemberManager();
        $members = $memberManager->selectAll('');

        return $this->twig->render('Members/index.html.twig', ['members' => $members]);
    }
}
