<?php

namespace Administration\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\Annotations\AnnotationReader;
use Zend\Http\PhpEnvironment;

abstract class BaseModel {
    /* Status */

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     *
     * @var string
     */
    protected $alias;

    /**
     *
     * @var string
     */
    protected $entity;

    /**
     *
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    public function __construct(EntityManager $entityManager, $entity) {
        $this->entityManager = $entityManager;
        $this->entity = $entity;
    }

    /**
     *
     * @param array $criteria
     * @param array $orderBy
     * @param int $limit
     * @param int $offset
     */
    public function getAll($criteria = array('status' => \Administration\Model\BaseModel::STATUS_ACTIVE), $orderBy = array('sortOrder' => 'desc'), $limit = null, $offset = null) {
        /*
          $this->entityManager->getConnection()
          ->getConfiguration()
          ->setSQLLogger(new \Doctrine\DBAL\Logging\EchoSQLLogger());
         */
        return $this->entityManager->getRepository($this->entity)->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     *
     * @param array $criteria
     * @param array $orderBy
     * @param int $limit
     * @param int $offset
     */
    public function getAllWhereLike($criteria = array('status' => \Administration\Model\BaseModel::STATUS_ACTIVE), $orderBy = array('sortOrder' => 'desc'), $limit = null, $offset = null) {
        $qb = $this->entityManager->createQueryBuilder();
        $expr = $this->entityManager->getExpressionBuilder();
        $qb->select('entity')->from($this->entity, 'entity');

        foreach ($criteria as $field => $value) {
            $qb->orWhere($expr->like('entity.' . $field, ':' . $field))
                    ->setParameter(':' . $field, '%' . $value . '%');
        }

        if ($orderBy) {
            foreach ($orderBy as $field => $order) {
                $qb->addOrderBy('entity.' . $field, $order);
            }
        }

        if ($limit) {
            $qb->setMaxResults($limit);
        }

        if ($offset) {
            $qb->setFirstResult($offset);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     *
     * @param int $id
     */
    public function get($id) {
        if (!is_numeric($id)) {
            throw new \Exception('Invalid parameter passed is ' . __FUNCTION__);
        }
        return $this->entityManager->getRepository($this->entity)->find($id);
    }

    /**
     *
     * @param Administration\Model\entity $object
     */
    public function add($object) {
        if (!$object instanceof $this->entity) {
            throw new \Exception('Invalid parameter passed is ' . __FUNCTION__);
        }

        $this->entityManager->persist($object);
        $this->entityManager->flush();
    }

    /**
     *
     * @param Administration\Model\entity $object
     */
    public function edit($object) {
        if (!$object instanceof $this->entity) {
            throw new \Exception('Invalid parameter passed is ' . __FUNCTION__);
        }

        $id = $object->getId();

        if (!is_int($id) || $id < 0) {
            throw new \Exception('Invalid parameter passed is ' . __FUNCTION__);
        }

        $entity = $this->entityManager->getRepository($this->entity)->find($id);
        if ($entity === null) {
            throw new \Exception('Not found in ' . __FUNCTION__);
        }

        $this->entityManager->persist($object);
        $this->entityManager->flush();
    }

    /**
     *
     * @param int $id
     */
    public function delete($id) {
        if (!is_numeric($id)) {
            throw new \Exception('Invalid parameter passed is ' . __FUNCTION__);
        }

        $entity = $this->entityManager->getRepository($this->entity)->find($id);
        if ($entity === null) {
            throw new \Exception('Not found in ' . __FUNCTION__);
        }

        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    /**
     *
     * @param array $criteria
     * @return object|null
     * @throws \Exception
     */
    public function findOneBy($criteria) {
        if (!is_array($criteria)) {
            throw new \Exception('Invalid parameter passed is ' . __FUNCTION__);
        }
        return $this->entityManager->getRepository($this->entity)->findOneBy($criteria);
    }

    /**
     *
     * @return array
     */
    public function getClassMetadata($skip = array()) {
        return array_diff($this->entityManager->getClassMetadata($this->entity)->getFieldNames(), $skip);
    }

    /**
     *
     * @return \Administration\Model\entity
     */
    public function getEntity() {
        return new $this->entity;
    }

    /**
     *
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository() {
        return $this->entityManager->getRepository($this->entity);
    }

    /**
     *
     * @return string
     */
    public static function getRemoteAddress() {
        $remote = new PhpEnvironment\RemoteAddress;
        return $remote->getIpAddress();
    }

    /**
     * @return array
     */
    public static function getStatusList() {
        return array(
            self::STATUS_ACTIVE => 'active',
            self::STATUS_INACTIVE => 'inactive',
        );
    }

    /**
     * @return string
     */
    public static function getStatusByKey($key) {
        $list = self::getStatusList();
        return isset($list[$key]) ? $list[$key] : self::STATUS_INACTIVE;
    }

    /**
     * @return string|false
     */
    public function getStatusByValue($value) {
        $list = self::getStatusList();
        if (in_array($value, array_values($list))) {
            return array_search($value, $list);
        }
    }

    /**
     *
     * @return array
     */
    /*   public function getClassMetadataByType() {
      $annotationReader = new AnnotationReader();
      $reflection = new \ReflectionClass($this->entity);

      $result = array();
      $classMetadata = $this->getClassMetadata();
      foreach ($classMetadata as $field) {
      if ($reflection->hasProperty($field)) {
      $fieldInfo = $annotationReader->getPropertyAnnotations($reflection->getProperty($field));
      if ($fieldInfo[0]->type !== 'datetime') { // to do
      $result[] = $field;
      }
      }
      }
      return $result;
      } */
}
