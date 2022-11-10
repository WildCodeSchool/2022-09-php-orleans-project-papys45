<?php

namespace App\Controller;

use App\Model\RouteManager;

class AddRouteController extends AbstractController
{
    public const MAX_LENGTH = 255;


    public function add(): ?string
    {
        $errors = [];
        $route = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $route = array_map('trim', $_POST);
            $errors = $this->verifempty($route);
            $errors = $this->verifyLength($route);
            if (empty($errors)) {
                $routeManager = new RouteManager();
                $routeManager->insert($route);
                header('Location: /admin/add-route');
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

        if (strlen($route['start']) > self::MAX_LENGTH) {
            $errors[] = 'Le lieu de départ ne doit pas dépasser' . ' ' . self::MAX_LENGTH . ' ' . 'caractères.';
        }

        if (strlen($route['finish']) > self::MAX_LENGTH) {
            $errors[] = 'Le lieu d\'arrivée ne doit pas dépasser' . ' ' . self::MAX_LENGTH . ' ' . 'caractères.';
        }

        if (strlen($route['ravito']) > self::MAX_LENGTH) {
            $errors[] = 'Le lieu du ravito ne doit pas dépasser' . ' ' . self::MAX_LENGTH . ' ' . 'caractères.';
        }

        if (strlen($route['gpx']) > self::MAX_LENGTH) {
            $errors[] = 'L\'id ne doit pas dépasser' . ' ' . self::MAX_LENGTH . ' ' . 'caractères.';
        }

        if (strlen($route['description']) > self::MAX_LENGTH) {
            $errors[] = 'La description ne doit pas dépasser' . ' ' . self::MAX_LENGTH . ' ' . 'caractères.';
        }

        return $errors;
    }
}
