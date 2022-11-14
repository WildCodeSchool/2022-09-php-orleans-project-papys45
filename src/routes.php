<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'contact' => ['FormController', 'index', ['message']],
    'membres' => ['MemberController', 'index'],
    'items' => ['ItemController', 'index',],
    'listRoute' => ['RouteController', 'index',],
    'items/editer' => ['ItemController', 'edit', ['id']],
    'items/afficher' => ['ItemController', 'show', ['id']],
    'items/ajouter' => ['ItemController', 'add',],
    'items/supprimer' => ['ItemController', 'delete',],
    'admin/actualites' => ['AdminActuController', 'index'],
    'admin/actualites/editer' => ['AdminActuController', 'edit', ['id']],
    'admin/actualites/ajouter' => ['AdminActuController', 'add'],
    'admin/actualites/supprimer' => ['AdminActuController', 'delete'],
    'admin/route' => ['AdminRouteController', 'index'],
    'admin/supprimerRoute' => ['AdminRouteController', 'delete'],
];
