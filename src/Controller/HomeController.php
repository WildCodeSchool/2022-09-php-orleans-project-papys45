<?php

namespace App\Controller;

use App\Model\ActualityManager;
use App\Controller\AbstractController;
use App\Model\MemberManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {

        $actualityManager = new ActualityManager();
        $actualities = $actualityManager->selectAll('id');

        $memberManager = new MemberManager();
        $president = $memberManager->selectOneByRole('president');

        return $this->twig->render('Home/index.html.twig', ['actualities' => $actualities, 'president' => $president]);
    }
    public function error(): string
    {
        return $this->twig->render('Error/error.html.twig');
    }
}
