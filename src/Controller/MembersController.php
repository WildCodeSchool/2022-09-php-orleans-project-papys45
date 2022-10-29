<?php

namespace App\Controller;

use App\Model\MembersManager;
use App\Controller\AbstractController;

class MembersController extends AbstractController
{
    public function index(): string
    {

        $memberManager = new MembersManager();
        $members = $memberManager->selectAll('');

        return $this->twig->render('Members/index.html.twig', ['members' => $members]);
    }
}
