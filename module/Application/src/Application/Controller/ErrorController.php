<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ErrorController extends AbstractActionController {

    public function indexAction() {
        die('1');
        return new ViewModel();
    }

}
