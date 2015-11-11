<?php

namespace Administration\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Administration\Model\Contacts;

class ContactsController extends AbstractActionController {

    /**
     *
     * @var Administration\Model\Contacts
     */
    protected $model;

    public function __construct(Contacts $model) {
        $this->model = $model;
    }

    public function indexAction() {
        return new ViewModel(array());
    }

    public function editAction() {
        try {
            $object = $this->model->get($this->params()->fromRoute('id'));
        } catch (Exception $ex) {
            // log error
            $this->flashMessenger()->addMessage('Unable to find record');
        }
        return new ViewModel(array('object' => $object));
    }

    public function deleteAction() {
        $id = $this->params()->fromRoute('id');
        try {
            $this->model->delete($id);
            $this->flashMessenger()->addMessage('Item was removed successfully');
        } catch (Exception $ex) {
            // log error
            $this->flashMessenger()->addMessage('Unable to remove item');
        }

        $this->redirect()->toRoute('contacts');
    }

}
