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
    'admin/membres/edit' => ['AdminMemberController', 'edit', ['id', 'message']],
    'admin/membres' => ['AdminMemberController', 'index', ['message']],
    'admin/membres/delete' => ['AdminMemberController', 'delete'],
    'admin/login' => ['AdminLoginController', 'login',],
    'admin/logout' => ['AdminLoginController', 'logout',],
    'admin/membres/add' => ['AdminMemberController', 'add', ['message']],
    'membres' => ['MemberController', 'index'],
    'items' => ['ItemController', 'index',],
    'list-route' => ['RouteController', 'index',],
    'detail-route' => ['RouteController', 'showRoute', ['routeid']],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'admin/actualites' => ['AdminActuController', 'index'],
    'admin/actualites/editer' => ['AdminActuController', 'update', ['id', 'message']],
    'admin/actualites/ajouter' => ['AdminActuController', 'add', ['message']],
    'admin/actualites/supprimer' => ['AdminActuController', 'delete'],
    'admin/route' => ['AdminRouteController', 'index'],
    'admin/deleteRoute' => ['AdminRouteController', 'delete'],
    'admin/add-route' => ['AddRouteController', 'add', ['message']],
    'admin/modif-route' => ['AddRouteController', 'edit', ['id', 'message']],
    'admin/inscription' => ['AdminRegistrationController', 'index', ['id']],
    'admin/photo/delete' => ['PhotoController', 'delete', ['id', 'routeId']],
    'admin/inscription/supprimer' => ['AdminRegistrationController', 'delete', ['idRoute']],
    'admin/inscription/ajouter' => ['AdminRegistrationController', 'add', ['id']],
    'error' => ['HomeController', 'error'],
];
