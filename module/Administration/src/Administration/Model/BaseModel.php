<?php

namespace Administration\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\Annotations\AnnotationReader;

abstract class BaseModel {

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
    public function getAll($criteria = array('isActive' => true), $orderBy = array('sortOrder' => 'desc'), $limit = null, $offset = null) {
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
    public function getAllWhereLike($criteria = array('isActive' => true), $orderBy = array('sortOrder' => 'desc'), $limit = null, $offset = null) {
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
     * @param array $data
     */
    public function add($data) {
        if (!is_array($data)) {
            throw new \Exception('Invalid parameter passed is ' . __FUNCTION__);
        }

        $entity = new $this->entity;
        $entity->exchangeArray($data);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    /**
     *
     * @param array $data
     */
    public function edit($data) {
        if (!is_array($data)) {
            throw new \Exception('Invalid parameter passed is ' . __FUNCTION__);
        }

        if (!isset($data['id'])) {
            throw new \Exception('Invalid parameter passed is ' . __FUNCTION__);
        }

        $entity = $this->entityManager->getRepository($this->entity)->find($data['id']);
        if ($entity === null) {
            throw new \Exception('Not found in ' . __FUNCTION__);
        }

        $entity->exchangeArray($data);
        $this->entityManager->persist($entity);
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
    public function getClassMetadata() {
        return $this->entityManager->getClassMetadata($this->entity)->getFieldNames();
    }

    /**
     *
     * @return array
     */
    public function getClassMetadataByType() {
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
    }

}
