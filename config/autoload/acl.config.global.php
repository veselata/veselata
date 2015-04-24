<?php

// null == all
return array(
    'acl' => array(
        'roles' => array(
            'guest' => null,
            'user' => 'guest',
            'administrator' => null,
        ),
        'resources' => array(
            'allow' => array(
                'Application\Controller\IndexController' => array(
                    null => array('guest'),
                ),
                'Application\Controller\ContactController' => array(
                    null => array('guest'),
                ),
                'Application\Controller\ProjectController' => array(
                    null => array('guest'),
                ),
                'Application\Controller\ErrorController' => array(
                    null => array('guest'),
                ),
                'Administration\Controller\IndexController' => array(
                    'login' => null,
                ),
                'Administration\Controller\DashboardController' => array(
                    null => array('administrator'),
                ),
                'Administration\Controller\PagesController' => array(
                    null => 'administrator',
                ),
                'Administration\Controller\BoxesController' => array(
                    null => array('administrator'),
                ),
                'Administration\Controller\ProjectsController' => array(
                    null => array('administrator'),
                ),
                'Administration\Controller\FilesController' => array(
                    null => array('administrator'),
                ),
                'Administration\Controller\ContactsController' => array(
                    null => array('administrator'),
                ),
                'Administration\Controller\UsersController' => array(
                    null => array('administrator'),
                ),
            ),
            'deny' => array(
            ),
        ),
    ),
);
