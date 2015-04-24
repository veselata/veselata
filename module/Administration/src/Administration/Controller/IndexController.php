<?php

namespace Administration\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Administration\Model\Users;
use Administration\Model\Logs;
use Administration\Service\AuthService;

class IndexController extends AbstractActionController {

    /**
     *
     * @var \Administration\Model\Users
     */
    protected $usersModel;

    /**
     *
     * @var \Administration\Model\Logs
     */
    protected $logsModel;

    /**
     *
     * @var \Administration\Service\AuthService
     */
    protected $authService;

    public function __construct(Users $usersModel, Logs $logsModel, AuthService $authService) {
        $this->usersModel = $usersModel;
        $this->logsModel = $logsModel;

        $this->authService = $authService;
        //    $this->authService->clearIdentity();
    }

    public function loginAction() {
        $form = new \Administration\Form\Login();
        $isHidden = ($this->logsModel->isBlocked()) ? true : false;

        $request = $this->getRequest();
        if ($request->isPost()) {

            $filter = new \Administration\InputFilter\Login();
            $form->setInputFilter($filter->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                if ($this->authService->isValid($form->getData())) {
                    $this->logsModel->unblock();
                    return $this->redirect()->toRoute('dashboard', array('action' => 'index'));
                } else {
                    if ($this->logsModel->isMax()) {
                        $this->logsModel->log(true);
                        return $this->redirect()->toRoute('adminarea');
                    } else {
                        $this->logsModel->log();
                    }
                }

                $this->flashMessenger()->addMessage($this->authService->getMessages());
            }
        }

        $viewModel = new ViewModel(array(
            'form' => $form,
            'isHidden' => $isHidden,
        ));
        $viewModel->setTerminal(true);
        return $viewModel;
    }

}
