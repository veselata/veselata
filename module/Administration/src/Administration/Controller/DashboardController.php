<?php

namespace Administration\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DashboardController extends AbstractActionController {

    /**
     *
     * @var \Administration\Service\AuthService
     */
    protected $authService;

    public function __construct(\Administration\Service\AuthService $authService) {
        $this->authService = $authService;
    }

    public function indexAction() {
        return new ViewModel();
    }

    public function logoutAction() {
        $this->authService->clearIdentity();
        return $this->redirect()->toRoute('adminarea', array('action' => 'login'));
    }

}
