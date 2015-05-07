<?php

namespace Administration\Model;

use Doctrine\ORM\EntityManager;

class Projects extends BaseModel implements IBaseModel {

    /**
     *
     * @var string
     */
    protected $alias = 'Projects';

    public function __construct(EntityManager $entityManager, $entity = 'Administration\Entity\Project') {
        parent::__construct($entityManager, $entity);
    }

    public function getAllWhereLike($criteria = array(), $orderBy = array(), $limit = null, $offset = null) {
        return parent::getAllWhereLike($criteria, $orderBy, $limit, $offset);
    }

    public function like($id) {
        $entity = parent::get($id);
        $entity->setLikes($entity->getLikes() + 1);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

}
