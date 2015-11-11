<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Administration\Service\Provider\Weather;
use Administration\Service\ApiService;

class WeatherController extends AbstractActionController {

    public $weatherService;

    public function __construct(Weather $weatherService) {
        $this->weatherService = $weatherService;
    }

    public function indexAction() {
        $searchString = 'Sliven';
        $this->weatherService->findBy($searchString);

        try {
            $data = ApiService::call($this->weatherService);
            return new JsonModel(array($data));
        } catch (\Exception $ex) {
            $this->notFoundAction();
        }
    }

}
