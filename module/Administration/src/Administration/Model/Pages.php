<?php

namespace Administration\Model;

use Doctrine\ORM\EntityManager;

class Pages extends BaseModel {

    /**
     *
     * @var string
     */
    protected $alias = 'Pages';

    const DEFAULT_MENU = 0;
    const TOP_MENU = 1;
    const BOTTOM_MENU = 2;

    public function __construct(EntityManager $entityManager, $entity = 'Administration\Entity\Page') {
        parent::__construct($entityManager, $entity);
    }

    /**
     *
     * @return array
     */
    public function getData() {
        $response = array();
        $data = $this->getAll(array('status' => \Administration\Model\BaseModel::STATUS_ACTIVE));

        foreach ($data as $page) {
            if ($page->getParentId()) {
                $response[$page->getParentId()]['pages'][] = $page->getNavigation();
            } else {
                $response[$page->getId()] = $page->getNavigation();
            }
        }
        return $response;
    }

    /**
     *
     * @param array $criteria
     */
    public function findOneBy($criteria) {
        $data = parent::findOneBy($criteria);
        return array(
            'title' => ($data) ? $data->getTitle() : '',
            'description' => ($data) ? $data->getDescription() : '',
        );
    }

}
