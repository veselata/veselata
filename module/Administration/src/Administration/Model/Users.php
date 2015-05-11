<?php

namespace Administration\Model;

use Doctrine\ORM\EntityManager;

class Users extends BaseModel implements IBaseModel {

    /**
     *
     * @var string
     */
    protected $alias = 'Users';

    /* User types */

    const TYPE_GUEST = 0;
    const TYPE_USER = 1;
    const TYPE_ADMINISTRATOR = 2;

    public function __construct(EntityManager $entityManager, $entity = 'Administration\Entity\User') {
        parent::__construct($entityManager, $entity);
    }

    /**
     *
     * @param type $criteria
     * @param type $orderBy
     */
    public function getAllWhereLike($criteria = array(), $orderBy = array('id' => 'desc'), $limit = null, $offset = null) {
        return parent::getAllWhereLike($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @return array
     */
    public static function getTypeList() {
        return array(
            self::TYPE_GUEST => 'guest',
            self::TYPE_USER => 'user',
            self::TYPE_ADMINISTRATOR => 'administrator',
        );
    }

    /**
     * @return string
     */
    public static function getTypeByKey($key) {
        $listTypes = self::getTypeList();
        return isset($listTypes[$key]) ? $listTypes[$key] : self::TYPE_GUEST;
    }

    /**
     * @return string|false
     */
    public function getTypeByValue($value) {
        $listTypes = self::getTypeList();
        if (in_array($value, array_values($listTypes))) {
            return array_search($value, $listTypes);
        }
    }

}
