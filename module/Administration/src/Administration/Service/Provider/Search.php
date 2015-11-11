<?php

namespace Administration\Service\Provider;

use Zend\ServiceManager\ServiceLocatorInterface;

class Search implements IProvider {

    /**
     *
     * @var string
     */
    private $endpoint;

    /**
     *
     * @var array
     */
    private $parameters = array(
        'q' => '',
        'format' => 'json',
        'num_of_results' => 10,
    );

    /**
     *
     * @var array
     */
    protected $validParameters = array(
        'q', // Pass US, UK or Canada Postalcode, IP address, Latitude/Longitude (decimal degree) or city name
        'format',
        'timezone',
        'popular',
        'num_of_results',
        'callback',
        'wct',
    );

    public function __construct(ServiceLocatorInterface $serviceLocator) {
        $className = strtolower((new \ReflectionClass($this))->getShortName());
        $configOptions = $serviceLocator->get('config')['credentials'];
        if (array_key_exists($className, $configOptions)) {
            $this->setEndpoint($configOptions[$className]['endpoint']);
            $this->setAuthorization($configOptions[$className]['authorization']);
        }
    }

    /**
     *
     * @param string $value
     */
    public function findBy($value) {
        $this->parameters['q'] = $value;
    }

    /**
     *
     * @return string
     */
    public function getEndpoint() {
        return $this->endpoint;
    }

    /**
     *
     * @param string $endpoint
     */
    public function setEndpoint($endpoint) {
        $this->endpoint = $endpoint;
    }

    /**
     *
     * @param array $authorization
     */
    public function setAuthorization($authorization = array()) {
        $this->parameters = array_merge($authorization, $this->parameters);
    }

    /**
     *
     * @return array
     */
    public function getParameters() {
        return $this->parameters;
    }

    /**
     *
     * @param array $parameters
     */
    public function setParameters($parameters = array()) {
        $allowed = array_intersect_key($parameters, array_flip($this->validParameters));
        $this->parameters = array_merge($allowed, $this->parameters);
    }

    /**
     *
     * @param string $key
     */
    public function unsetParameter($key) {
        if (array_key_exists($key, array_flip($this->validParameters))) {
            unset($this->parameters[$key]);
        }
    }

}
