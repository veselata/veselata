<?php

namespace Administration\Model;

use Zend\Http\PhpEnvironment;
use Zend\Json\Json;
use Doctrine\ORM\EntityManager;

class Logs extends BaseModel {

    /**
     *
     * @var string
     */
    protected $alias = 'Logs';

    const MAX_MINUTES = 15;
    const MAX_ATTEMPT = 3;

    public function __construct(EntityManager $entityManager, $entity = 'Administration\Entity\Log') {
        parent::__construct($entityManager, $entity);
    }

    /**
     *
     * @param boolean $block
     */
    public function log($block = false) {
        $entity = new $this->entity;
        $entity->setIp(\Administration\Model\BaseModel::getRemoteAddress());
        $request = new PhpEnvironment\Request();
        $serverParams = $request->getServer();
        $entity->setExtra(Json::encode($serverParams));
        if ($block) {
            $entity->setIsBlocked(true);
        }

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    /**
     *
     * @return boolean
     */
    public function isMax() {
        $queryBuilder = $this->entityManager->getRepository($this->entity)->createQueryBuilder($this->alias);
        $queryBuilder
                ->select('count(' . $this->alias . ')')
                ->where($this->alias . '.ip = :ip')
                ->andWhere($this->alias . '.createdAt > DATESUB(CURRENT_TIMESTAMP(), INTERVAL ' . self::MAX_MINUTES . ' MINUTE)')
                ->setParameter(':ip', $this->getRemoteAddress());

        if ($queryBuilder->getQuery()->getSingleScalarResult() > self::MAX_ATTEMPT) {
            return true;
        }

        return false;
    }

    /**
     *
     */
    public function unblock() {
        $entities = $this->entityManager->getRepository($this->entity)->findBy(
                array(
                    'ip' => $this->getRemoteAddress(),
                    'isBlocked' => true,
                )
        );
        foreach ($entities as $entity) {
            $entity->setIsBlocked(false);
            $this->entityManager->persist($entity);
        }
        $this->entityManager->flush();
    }

    /**
     *
     * @return boolean
     */
    public function isBlocked() {
        $queryBuilder = $this->entityManager->getRepository($this->entity)->createQueryBuilder($this->alias);
        $queryBuilder
                ->select('count(' . $this->alias . ')')
                ->where($this->alias . '.ip = :ip')
                ->andWhere($this->alias . '.isBlocked = :isBlocked')
                ->andWhere($this->alias . '.createdAt > DATESUB(CURRENT_TIMESTAMP(), INTERVAL ' . self::MAX_MINUTES . ' MINUTE)')
                ->setParameter(':ip', $this->getRemoteAddress())
                ->setParameter(':isBlocked', true);

        return ($queryBuilder->getQuery()->getSingleScalarResult()) ? true : false;
    }

    /**
     *
     */
    public function track($itemId) {
        $entity = new $this->entity;
        $entity->setIp($this->getRemoteAddress());
        $entity->setIsTrack(true);
        $entity->setExtra('extra');
        $entity->addProject($itemId);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    /**
     *
     */
    public function validateTrack($itemId) {
        if ($this->getAll(array(
                    'ip' => $this->getRemoteAddress(),
                    'isTrack' => true,
                    'itemId' => $itemId
                        ), array())
        ) {
            return true;
        }
        return false;
    }

}
