<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Administration\Model\Pages;

class IndexController extends AbstractActionController {

    /**
     *
     * @var Administration\Model\Pages
     */
    protected $pagesModel;

    public function __construct(Pages $pagesModel) {
        $this->pagesModel = $pagesModel;
    }

    public function indexAction() {
        $page = $this->pagesModel->get(1);
        return new ViewModel(array('page' => $page));
    }

    public function downloadAction() {
        $file = $this->params()->fromRoute('slug');
        $fileName = dirname(__DIR__) . '/../../../../public/documents/' . $file;

        if (file_exists($fileName)) {

            $response = new \Zend\Http\Response\Stream();
            $response->setStream(fopen($fileName, 'r'));
            $response->setStatusCode(200);
            $response->setStreamName($file);

            $headers = new \Zend\Http\Headers();
            $headers->addHeaderLine('Pragma: public')
                    ->addHeaderLine('Content-Type: application/pdf')
                    ->addHeaderLine('Expires: -1')
                    ->addHeaderLine('Cache-Control: must-revalidate, post-check=0, pre-check=0')
                    ->addHeaderLine('Content-Disposition', 'attachment; filename="' . $file . '"')
                    ->addHeaderLine('Content-Length', filesize($fileName));

            $response->setHeaders($headers);
            return $response;
        }
    }

    public function sitemapAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        return $viewModel;
    }

}
