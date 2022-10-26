<?php

namespace App\Controller;

class FormController extends AbstractController
{
    /**
     * Display home page
     */
    public function form(): string
    {
        return $this->twig->render('Form/form.html.twig');
    }
}
