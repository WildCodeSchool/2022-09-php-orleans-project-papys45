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
    'admin/membres' => ['AdminMemberController', 'index',['message']],
    'admin/membres/delete' => ['AdminMemberController', 'delete'],
    'admin/login' => ['AdminLoginController', 'login',],
    'admin/logout' => ['AdminLoginController', 'logout',],
    'admin/membres/add' => ['AdminMemberController', 'add', ['message']],
    'membres' => ['MemberController', 'index'],
    'items' => ['ItemController', 'index',],
    'listRoute' => ['RouteController', 'index',],
    'DetailRoute' => ['RouteController', 'showRoute', ['routeid']],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'admin/actuality/index' => ['AdminActuController', 'index'],
    'admin/actuality/edit' => ['AdminActuController', 'edit', ['id']],
    'admin/actuality/add' => ['AdminActuController', 'add'],
    'admin/actuality/delete' => ['AdminActuController', 'delete'],
    'admin/route' => ['AdminRouteController', 'index'],
    'admin/deleteRoute' => ['AdminRouteController', 'delete'],
    'admin/add-route' => ['AddRouteController', 'add',],
    'admin/modif-route' => ['AddRouteController', 'edit', ['id']],
];
