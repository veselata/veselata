<?php

namespace Administration\Model;

use Doctrine\ORM\EntityManager;

class Boxes extends BaseModel {

    /**
     *
     * @var string
     */
    protected $alias = 'Boxes';

    const POSITION_TOP = 1;
    const POSITION_LEFT = 2;
    const POSITION_RIGHT = 3;
    const POSITION_BOTTOM = 4;

    public function __construct(EntityManager $entityManager, $entity = 'Administration\Entity\Box') {
        parent::__construct($entityManager, $entity);
    }

    public function getData() {
        $response = array();
        $positions = $this->getPositions();
        $data = $this->getAll();

        foreach ($data as $item) {
            if (in_array($item->getPosition(), $positions)) {
                $response[$item->getPosition()][] = array(
                    'title' => $item->getTitle(),
                    'description' => $item->getDescription(),
                );
            }
        }
        return $response;
    }

    public function getPositions() {
        return array(
            self::POSITION_TOP,
            self::POSITION_LEFT,
            self::POSITION_RIGHT,
            self::POSITION_BOTTOM,
        );
    }

}
