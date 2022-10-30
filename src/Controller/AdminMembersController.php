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

    public function edit(int $id): ?string
    {
        $adminMembersManager = new AdminMembersManager();
        $member = $adminMembersManager->selectOneById($id);
        $roles = [
            'Président' => 'Président',
            'vice' => 'Vice-président',
            'accountant' => 'Comptable',
            'secretary' => 'Secrétaire',
            'adjSecretary' => 'Secrétaire-adjoint',
            'activeMember' => 'Membre actif'
        ];


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $member = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $adminMembersManager->update($member);

            header('Location: /Admin/membersEdit?id=' . $id);

            // we are redirecting so we don't want any content rendered
            return null;
        }

        return $this->twig->render('Admin/membersEdit.html.twig', [
            'member' => $member,
            'roles' => $roles,
        ]);
    }
}
