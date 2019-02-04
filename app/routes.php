<?php
$routes = [
    '/page/about-us' => ['controller' => 'PageController', 'action' => 'aboutUsAction'],
    '/user/{id}' => ['controller' => 'UserController', 'action' => 'showAction'],
    '/user/edit/{id}' => ['controller' => 'UserController', 'action' => 'showAction', 'guard' => 'Authenticated'],
    '/login' => ['controller' => 'LoginController', 'action' => 'loginAction'],
    '/mechanic' => ['controller' => 'MechanicController', 'action' => 'mechanicAction'],
    '/signup' => ['controller' => 'SignupController', 'action' => 'signupAction'],





    '/' => ['controller' => 'LoginController', 'action' => 'loginAction'],
    '*' => ['controller' => 'LoginController', 'action' => 'loginAction']
];
