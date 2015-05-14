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
        $list = self::getTypeList();
        return isset($list[$key]) ? $list[$key] : self::TYPE_GUEST;
    }

    /**
     * @return string|false
     */
    public function getTypeByValue($value) {
        $list = self::getTypeList();
        if (in_array($value, array_values($list))) {
            return array_search($value, $list);
        }
    }

}
