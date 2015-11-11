<?php

namespace Administration\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CacheFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        return $serviceLocator->get('Administration\Service\CacheService');
    }

}
