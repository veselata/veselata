<?php

// 0 == all
return array(
    'acl' => array(
        'roles' => array(
            'guest' => null,
            'user' => 'guest',
            'administrator' => 'user',
        ),
        'resources' => array(
            'deny' => array(
                'Administration\Controller\UsersController' => array(
                    'edit' => array('user'),
                    'delete' => array('user'),
                ),
            ),
            'allow' => array(
                'Application\Controller\IndexController' => array(
                    0 => null,
                ),
                'Application\Controller\ContactController' => array(
                    0 => null
                ),
                'Application\Controller\ProjectController' => array(
                    0 => array('guest'),
                ),
                'Application\Controller\ErrorController' => array(
                    0 => array('guest'),
                ),
                'Application\Controller\WeatherController' => array(
                    0 => array('guest'),
                ),
                'Administration\Controller\IndexController' => array(
                    'login' => null,
                ),
                'Administration\Controller\DashboardController' => array(
                    0 => array('user'),
                ),
                'Administration\Controller\PagesController' => array(
                    0 => array('administrator'),
                ),
                'Administration\Controller\BoxesController' => array(
                    0 => array('user'),
                ),
                'Administration\Controller\ProjectsController' => array(
                    0 => array('administrator'),
                ),
                'Administration\Controller\FilesController' => array(
                    0 => array('administrator'),
                ),
                'Administration\Controller\ContactsController' => array(
                    0 => array('administrator'),
                ),
                'Administration\Controller\UsersController' => array(
                    0 => array('administrator'),
                ),
                'Administration\Controller\RestController' => array(
                    0 => array('administrator', 'user'),
                ),
            ),
        ),
    ),
);
