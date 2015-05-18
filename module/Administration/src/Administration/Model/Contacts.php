<?php

namespace Administration\Model;

use Doctrine\ORM\EntityManager;

class Contacts extends BaseModel implements IBaseModel {

    /**
     *
     * @var string
     */
    protected $alias = 'Contact';

    public function __construct(EntityManager $entityManager, $entity = 'Administration\Entity\Contact') {
        parent::__construct($entityManager, $entity);
    }

}
