<?php

return array(
    'di' => array(
        'allowed_controllers' => array(
            'Administration\Controller\IndexController',
            'Administration\Controller\DashboardController',
            'Administration\Controller\PagesController',
            'Administration\Controller\BoxesController',
            'Administration\Controller\ProjectsController',
            'Administration\Controller\FilesController',
            'Administration\Controller\ContactsController',
            'Administration\Controller\UsersController',
            'Administration\Controller\RestController',
        ),
        'instance' => array(
            'preference' => array(
                'Zend\EventManager\EventManagerInterface' => 'EventManager',
                'Zend\ServiceManager\ServiceLocatorInterface' => 'ServiceManager',
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
        //'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'front-navigation' => 'Administration\Factory\NavigationFactory',
            'log' => 'Zend\Log\LoggerServiceFactory',
        ),
        'invokables' => array(
        ),
    ),
    'controllers' => array(
        'invokables' => array(
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/administration.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'admin_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Administration/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Administration\Entity' => 'admin_entities'
                )
            ),
        ),
        'authentication' => array(
            'orm_default' => array(
                'objectManager' => 'Doctrine\ORM\EntityManager',
                'identityClass' => 'Administration\Entity\User',
                'identityProperty' => 'username',
                'credentialProperty' => 'password',
                'credentialCallable' => function(\Administration\Entity\User $identity, $password) {
                    return \Administration\Entity\User::verifyPassword($password, $identity->getPassword());
                }
            ),
        ),
    ),
    'validators' => array(
        'invokables' => array(
        ),
    ),
    'log' => array(
        'exceptionhandler' => true,
        'errorhandler' => true,
        'writers' => array(
            'stream' => array(
                'name' => 'stream',
                'priority' => 1,
                'options' => array(
                    'stream' => './data/log/error.log',
                    'formatter' => array(
                        'name' => 'simple',
                        'options' => array(
                            'dateTimeFormat' => 'Y-m-d H:i:s'
                        )
                    )
                ),
            ),
        )
    ),
);
