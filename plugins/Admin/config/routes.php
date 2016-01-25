<?php
use Cake\Routing\Router;

Router::plugin(
    'Admin',
    ['path' => '/admin'],
    function ($routes) {
        $routes->connect('/', ['controller' => 'Admins', 'action' => 'index']);

        $routes->connect('/login', ['controller' => 'Admins', 'action' => 'login']);

        $routes->fallbacks('DashedRoute');
    }
);
