<?php

namespace Administration\Model;

use Doctrine\ORM\EntityManager;

class Users extends BaseModel {

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
    public static function getUserRoleList() {
        return array(
            self::TYPE_GUEST => 'guest',
            self::TYPE_USER => 'user',
            self::TYPE_ADMINISTRATOR => 'administrator',
        );
    }

    /**
     * @return string
     */
    public static function getUserRoleByKey($key) {
        $roleList = self::getUserRoleList();
        return isset($roleList[$key]) ? $roleList[$key] : self::TYPE_GUEST;
    }

}
