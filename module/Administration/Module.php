<?php

namespace Administration;

use Zend\Mvc\MvcEvent;

class Module {

    public function onBootstrap(MvcEvent $event) {
        $eventManager = $event->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_ROUTE, array($this, 'setAcl'));
    }

    public function setAcl(MvcEvent $event) {
        $matches = $event->getRouteMatch();
        $controller = $matches->getParam('controller');
        $action = $matches->getParam('action');

        $serviceManager = $event->getApplication()->getServiceManager();
        $authService = $serviceManager->get('Administration\Service\AuthService');
        $acl = new \Zend\Permissions\Acl\Acl;
        $config = $serviceManager->get('Config');
        $aclService = new Service\AclService($acl, $config['acl']);

        if (!$aclService->hasResource($controller)) {
            throw new \Exception('Resource ' . $controller . ' not defined');
        } else {
            $userIdentity = $authService->getUserIdentity();
            $viewModel = $event->getViewModel();
            $viewModel->setVariable('identity', $userIdentity);

            \Zend\View\Helper\Navigation\AbstractHelper::setDefaultAcl($aclService);
            \Zend\View\Helper\Navigation\AbstractHelper::setDefaultRole($userIdentity['role']);

            if (!$aclService->isAllowed($userIdentity['role'], $controller, $action)) {
                $url = $event->getRouter()->assemble(array(), array('name' => 'adminarea'));
                $response = $event->getResponse();
                $response->getHeaders()->addHeaderLine('Location', $url);
                $response->setStatusCode(302);
                $response->sendHeaders();
                return $response;
            }
        }
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Zend\Authentication\AuthenticationService' => function($serviceManager) {
                    return $serviceManager->get('doctrine.authenticationservice.orm_default');
                },
            ),
        );
    }

}
