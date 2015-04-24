<?php

namespace Administration\Model;

use Doctrine\ORM\EntityManager;

class Projects extends BaseModel {

    /**
     *
     * @var string
     */
    protected $alias = 'Projects';

    public function __construct(EntityManager $entityManager, $entity = 'Administration\Entity\Project') {
        parent::__construct($entityManager, $entity);
    }

    public function like($id) {
        $entity = parent::get($id);
        $entity->setLikes($entity->getLikes() + 1);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

}
