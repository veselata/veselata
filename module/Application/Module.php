<?php

namespace Application;

use Zend\Mvc\MvcEvent;
use Zend\Session\Config\SessionConfig;
use Zend\Session\SessionManager;

class Module {

    public function onBootstrap(MvcEvent $event) {
        $eventManager = $event->getApplication()->getEventManager();
        /*   $eventManager->attach(array(MvcEvent::EVENT_DISPATCH_ERROR,
          MvcEvent::EVENT_RENDER_ERROR,
          ), array($this, 'handleException')); */
        $eventManager->attach(MvcEvent::EVENT_RENDER, array($this, 'setViewRenderes'));
        $this->initSession(array(
            'remember_me_seconds' => 60 * 60 * 24,
            'use_cookies' => true,
            'cookie_httponly' => true,
        ));
    }

    public function handleException(MvcEvent $event) {
        if ($event->isError()) {
            $log = array(
                'type' => $event->getParam('error'),
                'ip' => \Administration\Model\Logs::getRemoteAddress(),
            );
            $event->getApplication()->getServiceManager()->get('log')->crit($log);

            $viewModel = $event->getViewModel();
            $viewModel->setTerminal(true);
            $viewModel->setTemplate('error/404');

            $event->setViewModel($viewModel);
            $response = $event->getResponse();
            $response->setStatusCode(404);

            $event->setResponse($response);
            $event->setResult($viewModel);
            return $response;
        }
    }

    public function setViewRenderes(MvcEvent $event) {
        if ($event->isError()) {
            return;
        }

        $matches = $event->getRouteMatch();

        if (false !== strpos($matches->getParam('controller'), __NAMESPACE__)) {
            $viewModel = $event->getViewModel();
            if ($viewModel instanceof \Zend\View\Model\ModelInterface && !$viewModel->terminate()) {
                $viewModel->setTemplate('layout/' . strtolower(__NAMESPACE__));

                $serviceManager = $event->getApplication()->getServiceManager();

                $boxesModel = $serviceManager->get('Administration\Model\Boxes');
                $viewModel->setVariable('boxes', $boxesModel->getData());

                $tagsModel = $serviceManager->get('Administration\Model\Tags');
                $viewModel->setVariable('tags', $tagsModel->getData($matches->getMatchedRouteName()));

                $pagesModel = $serviceManager->get('Administration\Model\Pages');
                $viewModel->setVariable('page', $pagesModel->findOneBy(array(
                            'route' => $matches->getMatchedRouteName(),
                            'action' => $matches->getParam('action'),
                )));
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
            ),
        );
    }

    public function initSession($config) {
        $sessionConfig = new SessionConfig();
        $sessionConfig->setOptions($config);
        $sessionManager = new SessionManager($sessionConfig);
        $sessionManager->start();
        \Zend\Session\Container::setDefaultManager($sessionManager);
    }

}
