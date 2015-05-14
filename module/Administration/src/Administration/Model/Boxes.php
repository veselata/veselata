<?php

namespace Administration\Model;

use Doctrine\ORM\EntityManager;

class Boxes extends BaseModel implements IBaseModel {

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
        $positions = array_keys($this->getPositionList());
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

    /**
     *
     * @return array
     */
    public static function getPositionList() {
        return array(
            self::POSITION_TOP => 'top',
            self::POSITION_LEFT => 'left',
            self::POSITION_RIGHT => 'right',
            self::POSITION_BOTTOM => 'bottom',
        );
    }

    /**
     * @return string
     */
    public static function getPositionByKey($key) {
        $list = self::getPositionList();
        return isset($list[$key]) ? $list[$key] : self::POSITION_TOP;
    }

    /**
     * @return string|false
     */
    public function getPositionByValue($value) {
        $list = self::getPositionList();
        if (in_array($value, array_values($list))) {
            return array_search($value, $list);
        }
    }

}
