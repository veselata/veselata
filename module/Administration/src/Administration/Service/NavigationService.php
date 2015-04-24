<?php

namespace Administration\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Navigation\Service\DefaultNavigationFactory;
use Administration\Model\Pages;

class NavigationService extends DefaultNavigationFactory {

    /**
     *
     * @var Administration\Model\Pages
     */
    protected $pagesModel;

    public function __construct(Pages $pagesModel) {
        $this->pagesModel = $pagesModel;
    }

    protected function getPages(ServiceLocatorInterface $serviceLocator) {
        if (null === $this->pages) {
            $configuration = array();
            $configuration['navigation'][$this->getName()] = $this->pagesModel->getData();

            if (!isset($configuration['navigation'][$this->getName()])) {
                throw new \Exception(sprintf(
                        'Failed to find a navigation container by the name "%s"', $this->getName()
                ));
            }

            $application = $serviceLocator->get('Application');
            $routeMatch = $application->getMvcEvent()->getRouteMatch();
            $router = $application->getMvcEvent()->getRouter();

            $this->pages = $this->injectComponents($configuration['navigation'][$this->getName()], $routeMatch, $router);
        }

        return $this->pages;
    }

}
