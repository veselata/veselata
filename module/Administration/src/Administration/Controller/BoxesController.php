<?php

namespace Administration\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Administration\Model\Boxes;
use Administration\Form\Box as BoxForm;

class BoxesController extends AbstractActionController {

    /**
     *
     * @var Administration\Model\Boxes
     */
    protected $model;

    /**
     *
     * @var Administration\Form\Box
     */
    protected $form;

    public function __construct(Boxes $model, BoxForm $form) {
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
                $this->redirect()->toRoute('boxes');
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
            $this->form->bind($object);

            if ($this->getRequest()->isPost()) {
                $this->form->setData($this->getRequest()->getPost());
                if ($this->form->isValid()) {
                    $this->model->edit($object);
                    $this->flashMessenger()->addMessage('Your data was saved successfully.');
                    $this->redirect()->toRoute('boxes');
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

        $this->redirect()->toRoute('boxes');
    }

}
