<?php

$routes = array();
$pages = array('dashboard', 'pages', 'boxes', 'projects', 'files', 'contacts', 'users',);

$routes['adminarea'] = array(
    'type' => 'Segment',
    'options' => array(
        'route' => '/adminarea[/][:action][/:id]',
        'constraints' => array(
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[0-9]+',
        ),
        'defaults' => array(
            'controller' => 'Administration\Controller\IndexController',
            'action' => 'login',
        ),
    ),
);

foreach ($pages as $page) {
    $routes[$page] = array(
        'type' => 'Segment',
        'options' => array(
            'route' => '/adminarea/' . $page . '[/][:action][/:id]',
            'constraints' => array(
                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                'id' => '[0-9]+',
            ),
            'defaults' => array(
                'controller' => 'Administration\Controller\\' . ucfirst($page) . 'Controller',
                'action' => 'index',
            ),
        ),
    );
}

return array(
    'router' => array(
        'routes' => $routes
    ),
);
