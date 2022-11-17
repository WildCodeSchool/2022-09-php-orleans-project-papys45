<?php

namespace App\Controller;

use App\Model\PhotoManager;

class PhotoController extends AbstractController
{
    public function delete(int $id, int $routeId): void
    {
        $photoManager = new PhotoManager();
        $photoManager->delete((int)$id);

        header('Location: /admin/modif-route?id=' . $routeId);
    }
}
