<?php

namespace Administration\Service;

use Zend\Http\Client;
use Administration\Service\Provider\IProvider;

class ApiService {

    public function __construct() {

    }

    /**
     *
     * @param IProvider $provider
     * @return string
     */
    public static function call(IProvider $provider) {
        $client = new Client;
        $client->setAdapter('Zend\Http\Client\Adapter\Curl');
        $client->setParameterGet($provider->getParameters());
        $client->setUri($provider->getEndpoint());
        $result = $client->send();

        $response = $client->getResponse();
        if ($response->isOk()) {
            $response->getHeaders()->addHeaderLine('Content-Type', 'application/json; charset=utf-8');
            $response->setContent($result->getBody());
            return $response->getContent();
        }
    }

}
