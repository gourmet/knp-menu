<?php
use Cake\Routing\Router;

Router::scope('/', function ($routes) {
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    $routes->connect('/some_alias', ['controller' => 'tests_apps', 'action' => 'some_method'], ['_name' => 'some']);
});
