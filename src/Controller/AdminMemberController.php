<?php

namespace App\Controller;

use App\Model\AdminMemberManager;

class AdminMemberController extends AbstractController
{
    public function index(): string
    {
        $adminMembersManager = new AdminMemberManager();
        $members = $adminMembersManager->selectAll('firstname');

        return $this->twig->render('Admin/members.html.twig', ['members' => $members]);
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $adminMembersManager = new AdminMemberManager();
            $idPhoto = $adminMembersManager->idPhoto((int) $id);
            $adminMembersManager->delete((int)$id);

            if (file_exists('upload/' . $idPhoto['photo'])) {
                unlink('upload/' . $idPhoto['photo']);
            }

            header('Location:/admin/membres');
        }
    }
}
