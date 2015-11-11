<?php

namespace Administration\Service;

use Zend\Cache\Storage\Adapter\Filesystem;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\Mvc\MvcEvent;

class CacheService extends AbstractListenerAggregate {

    protected $cacheService;
    protected $listeners = array();

    public function __construct(Filesystem $cacheService) {
        $this->cacheService = $cacheService;
        $this->cacheService->setOptions(array(
            'cache_dir' => 'data/cache/',
            'ttl' => 60,
        ));
        $this->cacheService->clearExpired();
    }

    public function attach(\Zend\EventManager\EventManagerInterface $eventManager) {
        $this->listeners[] = $eventManager->attach(MvcEvent::EVENT_ROUTE, array($this, 'get'));
        $this->listeners[] = $eventManager->attach(MvcEvent::EVENT_FINISH, array($this, 'save'));
    }

    public function save(MvcEvent $event) {
        $match = $event->getRouteMatch();

        if ($match->getParam('cache')) {
            $cacheKey = $this->cacheName($match);
            $response = $event->getResponse();
            $result = $response->getContent();
            $this->cacheService->setItem($cacheKey, $result);
        }
    }

    public function get(MvcEvent $event) {
        $match = $event->getRouteMatch();

        if ($match->getParam('cache')) {
            $cacheKey = $this->cacheName($match);
            if ($this->cacheService->hasItem($cacheKey)) {
                $response = $event->getResponse();
                // $response->getHeaders()->addHeaderLine('Content-Type', 'application/json; charset=utf-8');
                $response->setContent($this->cacheService->getItem($cacheKey));
                return $response;
            }
        }
    }

    protected function cacheName($match) {
        if ($match instanceof \Zend\Mvc\Router\Http\RouteInterface) {
            throw new \Exception('Invalid parameter passed in ' . __FUNCTION__);
        }
        return 'page_' . str_replace('/', '-', $match->getMatchedRouteName());
    }

    public function flush() {
        $this->cacheService->flush();
    }

}
