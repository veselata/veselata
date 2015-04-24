<?php

namespace Administration\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Box
 *
 * @ORM\Table(name="boxes")})
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class Box {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var smallint
     *
     * @ORM\Column(name="position", type="smallint", nullable=false)
     */
    private $position = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="sort_order", type="integer", nullable=false)
     */
    private $sortOrder;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @ORM\PrePersist
     */
    function onPrePersist() {
        $this->createdAt = new \DateTime('now');
    }

    /**
     *
     * @param array
     */
    public function exchangeArray(array $data) {
        $this->title = isset($data['title']) ? $data['title'] : null;
        $this->description = isset($data['description']) ? $data['description'] : null;
        $this->position = isset($data['position']) ? $data['position'] : null;
        $this->isActive = isset($data['isActive']) ? $data['isActive'] : 0;
        $this->sortOrder = isset($data['sortOrder']) ? $data['sortOrder'] : 0;
    }

    /**
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     *
     * @param string $title
     * @return Box
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     *
     * @param string $description
     * @return Box
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     *
     * @param integer $position
     * @return Box
     */
    public function setPosition($position) {
        $this->position = $position;

        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getSortOrder() {
        return $this->sortOrder;
    }

    /**
     *
     * @param integer $sortOrder
     * @return Box
     */
    public function setSortOrder($sortOrder) {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function getIsActive() {
        return $this->isActive;
    }

    /**
     *
     * @param boolean $isActive
     * @return Box
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     *
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     *
     * @param \DateTime $createdAt
     * @return Box
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

}
