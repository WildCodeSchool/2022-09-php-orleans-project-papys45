<?php

namespace App\Controller;

use App\Model\RouteManager;

class AddRouteController extends AbstractController
{
    public const START_MAXLENGTH = 255;
    public const FINISH_MAXLENGTH = 255;
    public const RAVITO_MAXLENGTH = 255;
    public const GPX_MAXLENGTH = 255;
    public const DESCRIPTION_MAXLENGTH = 255;
    public const RAPPORT_MAXLENGTH = 255;


    public function add(): ?string
    {
        $errors = [];
        $route = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $route = array_map('trim', $_POST);

            // TODO validations (length, format..  .)
            $errors = $this->verifempty($route);
            $errors = $this->verifyLength($route);
            if (empty($errors)) {
            // if validation is ok, insert and redirection
                $routeManager = new RouteManager();
                $routeManager->insert($route);
                header('Location: /Admin/AddRoute');
            }
        }
        return $this->twig->render('Admin/AddRouteForm.html.twig', ['errors' => $errors, 'route' => $route]);
    }



    private function verifempty(array $route)
    {
        $errors = [];

        if (empty($route['date'])) {
            $errors[] = 'La date est obligatoire.';
        }
        if (empty($route['time'])) {
            $errors[] = 'L\'heure est obligatoire.';
        }
        if (empty($route['start'])) {
            $errors[] = 'Le lieu de départ est obligatoire.';
        }
        if (empty($route['finish'])) {
            $errors[] = 'Le lieu d\'arrivée est obligatoire.';
        }
        if (empty($route['distance'])) {
            $errors[] = 'La distance est  obligatoire.';
        }
        if ($route['difficulty'] === '0') {
            $errors[] = 'La difficulté est obligatoire.';
        }
        if (empty($route['gpx'])) {
            $errors[] = 'L\'id est obligatoire.';
        }
        return $errors;
    }

    private function verifyLength(array $route)
    {

        $errors = [];

        $errors = $this->verifEmpty($route);

        if (strlen($route['start']) > self::START_MAXLENGTH) {
            $errors[] = 'Le lieu de départ ne doit pas dépasser' . ' ' . self::START_MAXLENGTH . ' ' . 'caractères.';
        }

        if (strlen($route['finish']) > self::FINISH_MAXLENGTH) {
            $errors[] = 'Le lieu d\'arrivée ne doit pas dépasser' . ' ' . self::FINISH_MAXLENGTH . ' ' . 'caractères.';
        }

        if (strlen($route['ravito']) > self::RAVITO_MAXLENGTH) {
            $errors[] = 'Le lieu du ravito ne doit pas dépasser' . ' ' . self::RAVITO_MAXLENGTH . ' ' . 'caractères.';
        }

        if (strlen($route['gpx']) > self::GPX_MAXLENGTH) {
            $errors[] = 'L\'id ne doit pas dépasser' . ' ' . self::GPX_MAXLENGTH . ' ' . 'caractères.';
        }

        if (strlen($route['description']) > self::DESCRIPTION_MAXLENGTH) {
            $errors[] = 'La description ne doit pas dépasser' . ' ' . self::DESCRIPTION_MAXLENGTH . ' ' . 'caractères.';
        }

        return $errors;
    }
}
