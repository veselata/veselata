<?php

namespace Administration\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class NavigationFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $navigation = $serviceLocator->get('Administration\Service\NavigationService');
        return $navigation->createService($serviceLocator);
    }

}
