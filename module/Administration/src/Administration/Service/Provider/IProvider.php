<?php

namespace Administration\Service\Provider;

interface IProvider {

    public function getEndpoint();

    public function setEndpoint($endpoint);

    public function setAuthorization($authorization = array());

    public function getParameters();

    public function setParameters($parameters = array());
}
