<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Administration\Model\Contacts;
use Administration\Service\NotificationService;

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

    public function __construct(Contacts $contactModel, NotificationService $notificationService) {
        $this->contactModel = $contactModel;
        $this->notificationService = $notificationService;
    }

    public function indexAction() {
        return $this->notFoundAction();
        $form = new \Application\Form\Contact();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $formData = $form->getData();
                unset($formData['csrf'], $formData['submit']);
                $this->contactModel->add($formData);
                $this->flashMessenger()->addMessage('Your message was sent successfully.');

                // send notification
                $this->notificationService->notify($formData);
                $this->redirect()->toRoute('contact');
            } else {
                $this->flashMessenger()->addMessage('Please fill in all fields marked with an asterisk (*)');
            }
        }

        return new ViewModel(array('form' => $form,));
    }

}
