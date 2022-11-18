<?php

namespace App\Controller;

use App\Model\PhotoManager;
use App\Model\RouteManager;
use App\Controller\AbstractController;

class AddRouteController extends AbstractController
{
    public const MAX_LENGTH = 255;
    public const UPLOAD_DIR = 'uploads/';
    public const MAX_FILE_SIZE = 1000000;
    public const AUTH_EXTENSION = ['jpg', 'png', 'jpeg'];


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

    public function edit(int $id): ?string
    {
        $errors = [];
        $resultUpload = [];
        $routeManager = new RouteManager();
        $photoManager = new PhotoManager();
        $routeWithPhotos = $photoManager->selectOneByIdWithPhoto($id);
        $route = $routeWithPhotos[0];
        $photos = array_column($routeWithPhotos, 'photo', 'id');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
            $route = array_map('trim', $_POST);

            if (!empty($_FILES)) {
                $resultUpload = $this->uploadPhoto();
                $errors = $resultUpload[0];
                $photoManager->insertPhoto($resultUpload[1], $id);
            }

            $errors = array_merge($this->verifempty($route), $errors);
            $errors = array_merge($this->verifyLength($route), $errors);

            if (empty($errors)) {
                $routeManager->update($route);


                header('location: /admin/modif-route?id=' . $id . '&message=success');
                return null;
            }
        }


        return $this->twig->render(
            'Admin/EditRouteForm.html.twig',
            [
                'route' => $route,
                'errors' => $errors,
                'photos' => $photos
            ]
        );
    }


    private function uploadPhoto()
    {
        $errors = [];
        $files = $_FILES;
        $uploadFile = '';
        $uniqName = '';
        $fileName = [];
        $numberOfPhoto = count($files['photo']['name']);

        for ($i = 0; $i < $numberOfPhoto; $i++) {
            if (!empty($files['photo']['name'][$i])) {
                $errorsUpload = $this->verifUpload($files);

                if (empty($errorsUpload)) {
                    $extension = pathinfo(strtolower($files['photo']['name'][$i]), PATHINFO_EXTENSION);
                    $uniqName = uniqid('', true) . '.' . $extension;
                    $uploadFile = self::UPLOAD_DIR . $uniqName;
                }

                if (!empty($errorsUpload) || !move_uploaded_file($files['photo']['tmp_name'][$i], $uploadFile)) {
                    $errors[] = $files['photo']['name'][$i] . ' n\'a pu être chargé. Veuillez réessayer.';
                } else {
                    $fileName[] = $uniqName;
                }

                $errors = array_merge($errorsUpload, $errors);
            }
        }

        return [$errors, $fileName];
    }


    private function verifUpload(array $files): array
    {
        $errors = [];
        $numberOfPhotos = count($files['photo']['name']);
        for ($i = 0; $i < $numberOfPhotos; $i++) {
            if (
                file_exists($files['photo']['tmp_name'][$i]) &&
                filesize($files['photo']['tmp_name'][$i]) > self::MAX_FILE_SIZE
            ) {
                $errors[] = 'Votre fichier doit être inférieur à ' . self::MAX_FILE_SIZE / 1000000 . 'Mo.';
            }

            $ext = pathinfo(strtolower($files['photo']['name'][$i]), PATHINFO_EXTENSION);
            if ((!in_array($ext, self::AUTH_EXTENSION))) {
                $extString = implode(', ', self::AUTH_EXTENSION);
                $errors[] = 'Veuillez sélectionner une image de type ' . $extString . '.';
            }

            if (!empty($files['error'])) {
                $errors[] = 'Erreur d \'upload : ' . $files['error'] . '.';
            }
        }

        return $errors;
    }
}
