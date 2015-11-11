<?php

namespace Administration\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class RestController extends AbstractRestfulController {

    protected $model;

    public function __construct() {
        $this->addHttpMethodHandler('POST', array($this, 'getList'));
    }

    public function getList() {
        if (!method_exists($this->model, 'getAll')) {
            throw new \Exception('Invalid method call in ' . __FUNCTION__);
        }

        $data['current'] = $this->params()->fromPost('current', 1);
        if ($data['current'] < 1) {
            throw new \Exception('Invalid parameter passed is ' . __FUNCTION__);
        }
        $data['rowCount'] = $this->params()->fromPost('rowCount', 10);
        $data['sort'] = $this->params()->fromPost('sort', array('id' => 'desc'));

        $criteria = array();
        $data['searchPhrase'] = $this->params()->fromPost('searchPhrase');
        if (strlen($data['searchPhrase']) > 0) {
            $fields = $this->model->getClassMetadata(array('id', 'createdAt'));
            foreach ($fields as $field) {
                if (in_array($field, array('type', 'status', 'position'))) {
                    $this->searchFieldByType($field, $data['searchPhrase'], $criteria);
                } else {
                    $criteria[$field] = $data['searchPhrase'];
                }
            }
        }

        $result = $this->model->getAllWhereLike($criteria, $data['sort'], $data['rowCount'], (($data['current'] - 1) * $data['rowCount']));
        $data['total'] = count($this->model->getAllWhereLike($criteria, $data['sort']));
        $data['rows'] = array();
        foreach ($result as $row) {
            $data['rows'][] = $row->getData();
        }

        return new JsonModel($data);
    }

    public function get($id) {
        $data['current'] = 1;
        $data['rowCount'] = 10;
        $data['total'] = 50;
        $data['rows'] = array(
            array('id' => 5, 'sender' => '123@test.de', 'received' => '2014-05-30T22:15:00'),
        );
        return new JsonModel(array('data' => $data));
    }

    public function update($id, $data) {

    }

    public function delete($id) {

    }

    protected function attachDefaultListeners() {
        parent::attachDefaultListeners();

        $events = $this->getEventManager();
        $events->attach(\Zend\Mvc\MvcEvent::EVENT_DISPATCH, array($this, 'checkModel'), 100);
    }

    public function checkModel() {
        $model = $this->params('model');
        if (!strlen($model) > 0) {
            throw new \Exception('Invalid parameter passed is ' . __FUNCTION__);
        }

        $currentModel = 'Administration\Model\\' . ucfirst($model);
        if (!class_exists($currentModel)) {
            throw new \Exception('Error while resolving current model');
        }

        $this->model = $this->getServiceLocator()->get($currentModel);
        if (!$this->model instanceof \Administration\Model\IBaseModel) {
            throw new \Exception('Current model in not allowed');
        }
    }

    /**
     *
     * @param string $field
     * @param string $searchPhrase
     * @return array
     */
    protected function searchFieldByType($field, $searchPhrase, &$criteria = array()) {
        if (method_exists($this->model, 'get' . ucfirst($field) . 'ByValue')) {
            $typeId = $this->model->{'get' . ucfirst($field) . 'ByValue'}($searchPhrase);
            if (!is_null($typeId)) {
                $criteria[$field] = $typeId;
            }
        }
    }

}
