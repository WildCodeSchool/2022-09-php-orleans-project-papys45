<?php

namespace App\Controller;

use App\Model\PhotoManager;
use App\Model\RouteManager;
use App\Model\MemberManager;
use App\Model\RegistrationManager;
use App\Controller\AbstractController;

class RouteController extends AbstractController
{
    public const EASY_ROUTE = 1;
    public const MEDIUM_ROUTE = 2;
    public const HARD_ROUTE = 3;

    public function index()
    {
        $itemManager = new RouteManager();
        $routes = $itemManager->selectAll('date', 'DESC');

        return $this->twig->render('List/listRoute.html.twig', ['routes' => $routes]);
    }

    public function showRoute(int $id): string
    {
        $registrationManager = new RegistrationManager();
        $members = $registrationManager->selectMembersRegistrered($id);

        $itemManager = new RouteManager();
        $route = $itemManager->selectOneById($id);

        $photoManager = new PhotoManager();
        $photos = $photoManager->selectOneByIdWithPhoto($id);
        $photos = array_column($photos, 'photo');

        return $this->twig->render(
            'DetailRoute/detailRoute.html.twig',
            ['route' => $route, 'members' => $members, 'photos' => $photos]
        );
    }
}
