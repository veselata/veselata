<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Administration\Model\Projects;
use Administration\Model\Tags;
use Administration\Model\Logs;
use Zend\Session\Container;

class ProjectController extends AbstractActionController {

    /**
     *
     * @var Administration\Model\Projects
     */
    protected $projectsModel;

    /**
     *
     * @var Administration\Model\Tags
     */
    protected $tagsModel;

    /**
     *
     * @var Administration\Model\Logs
     */
    protected $logsModel;

    /**
     *
     * @var Zend\Session\Container
     */
    protected $userSession;

    public function __construct(Projects $projectsModel, Tags $tagsModel, Logs $logsModel) {
        $this->projectsModel = $projectsModel;
        $this->tagsModel = $tagsModel;
        $this->logsModel = $logsModel;
        $this->userSession = new Container('userSession');
    }

    public function indexAction() {
        $tagId = $this->params()->fromRoute('id');
        $this->userSession->offsetSet('categoryId', $tagId);
        $this->userSession->offsetSet('categoryTitle', null);
        $criteria = array();

        if (isset($tagId)) {
            if (!is_numeric($tagId)) {
                throw new \Exception('Invalid parameter passed in ' . __FUNCTION__);
            } else {
                $this->userSession->offsetSet('categoryId', $tagId);
                $criteria = $this->getCriteria();
            }
        }

        $projects = $this->projectsModel->getAll($criteria);

        return new ViewModel(array(
            'projects' => $projects,
            'categoryTitle' => $this->userSession->offsetGet('categoryTitle'),
        ));
    }

    public function viewAction() {
        $id = $this->params()->fromRoute('id');
        $navigation = array();

        if (!is_numeric($id)) {
            throw new \Exception('Invalid parameter passed in ' . __FUNCTION__);
        }

        $project = $this->projectsModel->get($id);
        if ($project) {
            $navigation = $this->getNavigation($project->getId());
        }

        if (!$this->logsModel->validateTrack($project->getId())) {
            $this->logsModel->track($project);
        }

        return new ViewModel(array(
            'project' => $project,
            'categoryTitle' => $this->userSession->offsetGet('categoryTitle'),
            'navigation' => $navigation,
        ));
    }

    public function likeAction() {
        $projectId = $this->params()->fromPost('projectId');
        $project = $this->projectsModel->like($projectId);
        $viewModel = new JsonModel(array('likes' => $project->getLikes(), 'projectId' => $project->getId()));
        $viewModel->setTerminal(true);
        return $viewModel;
    }

    protected function getCriteria() {
        $criteria = array();
        if ($this->userSession->offsetExists('categoryId')) {
            $tagEntity = $this->tagsModel->get($this->userSession->offsetGet('categoryId'));
            $this->userSession->offsetSet('categoryTitle', $tagEntity->getTitle());

            $criteria = array('id' => $tagEntity->getProjectIds());
        }

        return $criteria;
    }

    protected function getNavigation($id) {
        $navigation = array();

        $projects = $this->projectsModel->getAll($this->getCriteria());

        foreach ($projects as $key => $value) {
            if ($value->getId() == $id) {
                if ($key != 0) {
                    $navigation['prev']['id'] = $projects[$key - 1]->getId();
                    $navigation['prev']['title'] = $projects[$key - 1]->getName();
                }
                if ($key != count($projects) - 1) {
                    $navigation['next']['id'] = $projects[$key + 1]->getId();
                    $navigation['next']['title'] = $projects[$key + 1]->getName();
                }
                break;
            }
        }

        return $navigation;
    }

}
