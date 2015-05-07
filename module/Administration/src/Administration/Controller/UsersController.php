<?php

namespace Administration\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Administration\Model\Users;

class UsersController extends AbstractActionController {

    /**
     *
     * @var Administration\Model\Users
     */
    protected $usersModel;

    public function __construct(Users $usersModel) {
        $this->usersModel = $usersModel;
    }

    public function indexAction() {
        // return new ViewModel(array('users' => $this->usersModel->getAll()));
        return new ViewModel(array());
    }

    public function addAction() {
        return new ViewModel(array());
    }

    public function editAction() {
        return new ViewModel(array());
    }

    public function deleteAction() {
        return new ViewModel(array());
    }

}
