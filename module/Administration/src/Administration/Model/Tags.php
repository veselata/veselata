<?php

namespace Administration\Model;

use Doctrine\ORM\EntityManager;

class Tags extends BaseModel {

    /**
     *
     * @var string
     */
    protected $alias = 'Tags';

    public function __construct(EntityManager $entityManager, $entity = 'Administration\Entity\Tag') {
        parent::__construct($entityManager, $entity);
    }

    /**
     *
     * @param string $route
     * @return array
     */
    public function getData($route) {
        $result = array();
        $data = $this->getAll();

        $userSession = new \Zend\Session\Container('userSession');
        $categoryId = $userSession->offsetGet('categoryId');
        if ($route !== 'project') {
            $userSession->getManager()->destroy();
        }

        foreach ($data as $item) {
            $result[$item->getId()] = array(
                'title' => $item->getTitle(),
                'active' => ( ($categoryId == $item->getId()) ? true : false ),
            );
        }
        return $result;
    }

}
