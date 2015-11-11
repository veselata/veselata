<?php

namespace Administration\Model;

use Doctrine\ORM\EntityManager;

class Files extends BaseModel {

    /**
     *
     * @var string
     */
    protected $alias = 'Files';

    const TYPE_IMAGE = 1;
    const TYPE_FILE = 2;

    public function __construct(EntityManager $entityManager, $entity = 'Administration\Entity\File') {
        parent::__construct($entityManager, $entity);
    }

}
