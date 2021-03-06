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
    protected $model;

    /**
     *
     * @var Administration\Form\User
     */
    protected $form;

    public function __construct(Users $model, UserForm $form) {
        $this->model = $model;
        $this->form = $form;
    }

    public function indexAction() {
        return new ViewModel(array());
    }

    public function addAction() {
        $object = $this->model->getEntity();
        $this->form->bind($object);

        if ($this->getRequest()->isPost()) {
            $this->form->setData($this->getRequest()->getPost());

            if ($this->form->isValid()) {
                $this->model->add($object);
                $this->flashMessenger()->addMessage('Your data was saved successfully.');
                $this->redirect()->toRoute('users');
            } else {
                $this->flashMessenger()->addMessage('Please fill in all fields marked with an asterisk (*)');
            }
        }

        return new ViewModel(array('form' => $this->form));
    }

    public function editAction() {
        $id = $this->params()->fromRoute('id');
        try {
            $object = $this->model->get($id);
            $this->form->get('user-fieldset')->remove('password');
            $this->form->get('user-fieldset')->get('username')->setAttribute('readonly', true);
            $this->form->setOption('is_edit', 1);
            $this->form->bind($object);

            if ($this->getRequest()->isPost()) {
                $this->form->setData($this->getRequest()->getPost());

                if ($this->form->isValid()) {
                    $this->model->edit($object);
                    $this->flashMessenger()->addMessage('Your data was saved successfully.');
                    $this->redirect()->toRoute('users');
                } else {
                    $this->flashMessenger()->addMessage('Please fill in all fields marked with an asterisk (*)');
                }
            }

            return new ViewModel(array('form' => $this->form, 'id' => $id));
        } catch (\Exception $ex) {
            // log error
            $this->notFoundAction();
        }
    }

    public function deleteAction() {
        $id = $this->params()->fromRoute('id');
        try {
            $this->model->delete($id);
            $this->flashMessenger()->addMessage('Item was removed successfully');
        } catch (\Exception $ex) {
            // log error
            $this->flashMessenger()->addMessage('Unable to remove item');
        }

        $this->redirect()->toRoute('users');
    }

    public function passwordAction() {
        return new ViewModel(array());
    }

}
