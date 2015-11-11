<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Administration\Model\Contacts;
use Administration\Service\NotificationService;
use Application\Form\Contact as ContactForm;

class ContactController extends AbstractActionController {

    /**
     *
     * @var Administration\Model\Contacts
     */
    protected $contactModel;

    /**
     *
     * @var Administration\Service\NotificationService
     */
    protected $notificationService;

    /**
     *
     * @var Application\Form\Contact
     */
    protected $form;

    public function __construct(Contacts $contactModel, NotificationService $notificationService, ContactForm $form) {
        $this->contactModel = $contactModel;
        $this->notificationService = $notificationService;
        $this->form = $form;
    }

    public function indexAction() {
        $object = $this->contactModel->getEntity();
        $this->form->bind($object);

        if ($this->getRequest()->isPost()) {
            $this->form->setData($this->getRequest()->getPost());

            if ($this->form->isValid()) {
                $this->contactModel->add($object);
                $this->flashMessenger()->addMessage('Your message was sent successfully.');

                // send notification
                $this->notificationService->notify($object);
                $this->redirect()->toRoute('contact');
            } else {
                $this->flashMessenger()->addMessage('Please fill in all fields marked with an asterisk (*)');
            }
        }

        return new ViewModel(array('form' => $this->form,));
    }

}
