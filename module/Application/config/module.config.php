<?php

return array(
    'di' => array(
        'allowed_controllers' => array(
            'Application\Controller\IndexController',
            'Application\Controller\ContactController',
            'Application\Controller\ProjectController',
            'Application\Controller\WeatherController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\IndexController',
                        'action' => 'index',
                    ),
                ),
            ),
            'sitemap' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/sitemap',
                    'defaults' => array(
                        'controller' => 'Application\Controller\IndexController',
                        'action' => 'sitemap',
                    ),
                ),
            ),
            'download' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/download[/][:slug]',
                    'constraints' => array(
                        'slug' => '[a-zA-Z0-9_-]+\.[a-zA-Z]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\IndexController',
                        'action' => 'download',
                    ),
                ),
            ),
            'contact' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/contact[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\ContactController',
                        'action' => 'index',
                    ),
                ),
            ),
            'project' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/project[/][:action[/:id]][/:category]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'category' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\ProjectController',
                        'action' => 'index',
                    ),
                ),
            ),
            'error' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/error[/][:code]',
                    'constraints' => array(
                        'code' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\ErrorController',
                        'action' => 'index',
                    ),
                ),
            ),
            'weather' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/weather',
                    'defaults' => array(
                        'controller' => 'Application\Controller\WeatherController',
                        'action' => 'index',
                        'cache' => true,
                    ),
                ),
            ),
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/application.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'formCollection' => 'Administration\View\Helper\FormUICollection',
            'formRow' => 'Administration\View\Helper\FormUIRow',
            'formElement' => 'Administration\View\Helper\FormUIElement',
            'alerts' => 'Administration\View\Helper\Alerts',
        ),
    ),
    'view_helper_config' => array(
        'flashmessenger' => array(
            'message_open_format' => '<div class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><ul><li>',
            'message_close_string' => '</li></ul></div>',
            'message_separator_string' => '</li><li>'
        )
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(),
        ),
    ),
);
