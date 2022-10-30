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

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $adminMembersManager = new AdminMembersManager();
            $adminMembersManager->delete((int)$id);

            header('Location:/');
        }
    }
}
