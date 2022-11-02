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

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $adminMembersManager = new AdminMemberManager();
            $idPhoto = $adminMembersManager->idPhoto((int) $id);
            $adminMembersManager->delete((int)$id);

            if (file_exists('upload/' . $idPhoto[0])) {
                unlink('upload/' . $idPhoto[0]);
                echo "Le fichier a été supprimé";
            }

            header('Location:/admin/membres');
        }
    }
}
