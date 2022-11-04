<?php

namespace App\Controller;

use App\Model\MemberManager;

class AdminMemberController extends AbstractController
{
    public const UPLOAD_DIR = 'upload/';

    public function index(string $message = ''): string
    {
        $membersManager = new MemberManager();
        $members = $membersManager->selectAll('firstname');

        return $this->twig->render('Admin/members.html.twig', ['members' => $members, 'message' => $message]);
    }

    public function delete(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $membersManager = new MemberManager();
            $idPhoto = $membersManager->idPhoto(intval($id));
            $membersManager->delete(intval($id));

            if (!empty($idPhoto['photo']) && file_exists(self::UPLOAD_DIR . $idPhoto['photo'])) {
                unlink(self::UPLOAD_DIR . $idPhoto['photo']);
            }

            header('Location:/admin/membres/?message=success');

            return '';
        }

        return $this->twig->render('Admin/members.html.twig');
    }
}
