<?php

namespace Administration\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * File
 *
 * @ORM\Table(name="files", indexes={@ORM\Index(name="item_id", columns={"item_id"})})
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class File {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_id", type="integer", nullable=false)
     */
    private $itemId = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=255, nullable=false)
     */
    private $file;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="sort_order", type="integer", nullable=false)
     */
    private $sortOrder;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="id")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     * */
    private $project;

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
        $this->type = isset($data['type']) ? $data['type'] : \Administration\Model\Files::TYPE_IMAGE;
        $this->itemId = isset($data['itemId']) ? $data['itemId'] : 0;
        $this->title = isset($data['title']) ? $data['title'] : null;
        $this->file = isset($data['file']) ? $data['file'] : 'default.png';
        $this->isActive = isset($data['isActive']) ? $data['isActive'] : 0;
        $this->sortOrder = 0;
    }

    public function addProject(\Administration\Entity\Project $project) {
        $this->project = $project;

        return $this;
    }

    /**
     *
     * @return Administration\Entity\Project
     */
    public function getProject() {
        return $this->project;
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
     * @return integer
     */
    public function getType() {
        return $this->type;
    }

    /**
     *
     * @param integer $type
     * @return File
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
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
     * @return File
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getFile() {
        return $this->file;
    }

    /**
     *
     * @param string $file
     * @return File
     */
    public function setFile($file) {
        $this->file = $file;

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
     * @return File
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;

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
     * @return File
     */
    public function setSortOrder($sortOrder) {
        $this->sortOrder = $sortOrder;

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
     * @return File
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

}
