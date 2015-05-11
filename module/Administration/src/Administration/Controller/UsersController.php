<?php

namespace Administration\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Administration\Model\Users;
use Administration\Form\User as UserForm;

class UsersController extends AbstractActionController {

    /**
     *
     * @var Administration\Model\Users
     */
    protected $usersModel;

    /**
     *
     * @var Administration\Form\User
     */
    protected $form;

    public function __construct(Users $usersModel, UserForm $form) {
        $this->usersModel = $usersModel;
        $this->form = $form;
    }

    public function indexAction() {
        // return new ViewModel(array('users' => $this->usersModel->getAll()));
        return new ViewModel(array());
    }

    public function addAction() {
        $object = $this->usersModel->getEntity();
        $this->form->bind($object);

        if ($this->getRequest()->isPost()) {
            $this->form->setData($this->getRequest()->getPost());

            if ($this->form->isValid()) {
                $this->usersModel->add($object);
                $this->flashMessenger()->addMessage('Your data was saved successfully.');
                $this->redirect()->toRoute('users');
            } else {
                $this->flashMessenger()->addMessage('Please fill in all fields marked with an asterisk (*)');
            }
        }

        return new ViewModel(array('form' => $this->form));
    }

    public function editAction() {
        $object = $this->usersModel->get($this->params()->fromRoute('id'));
        $this->form->bind($object);

        if ($this->getRequest()->isPost()) {
            $this->form->setData($this->getRequest()->getPost());

            if ($this->form->isValid()) {
                $this->usersModel->persist($object);
                $this->flashMessenger()->addMessage('Your data was saved successfully.');
                $this->redirect()->toRoute('users');
            } else {
                $this->flashMessenger()->addMessage('Please fill in all fields marked with an asterisk (*)');
            }
        }

        return new ViewModel(array('form' => $this->form));
    }

    public function deleteAction() {
        return new ViewModel(array());
    }

}
