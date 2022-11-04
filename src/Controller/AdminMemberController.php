<?php

namespace App\Controller;

use App\Model\MemberManager;

class AdminMemberController extends AbstractController
{
    public function index(): string
    {
        $adminMembersManager = new MemberManager();
        $members = $adminMembersManager->selectAll('firstname');

        return $this->twig->render('Admin/members.html.twig', ['members' => $members]);
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $adminMembersManager = new MemberManager();
            $idPhoto = $adminMembersManager->idPhoto(intval($id));
            $adminMembersManager->delete(intval($id));

            if (!empty($idPhoto['photo']) && file_exists('upload/' . $idPhoto['photo'])) {
                unlink('upload/' . $idPhoto['photo']);
            }

            header('Location:/admin/membres');
        }
    }
}
