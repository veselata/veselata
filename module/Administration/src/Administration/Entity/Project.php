<?php

namespace Administration\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Project
 *
 * @ORM\Table(name="projects")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class Project {

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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=100, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="thumb", type="string", length=255, nullable=false)
     */
    private $thumb;

    /**
     * @var integer
     *
     * @ORM\Column(name="likes", type="integer", nullable=false)
     */
    private $likes = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="sort_order", type="integer", nullable=false)
     */
    private $sortOrder;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="File", mappedBy="project")
     * */
    private $files;

    /**
     * @ORM\OneToMany(targetEntity="Log", mappedBy="project")
     * */
    private $logs;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Tag")
     * @ORM\JoinTable(name="project_tags",
     *      joinColumns={@ORM\JoinColumn(name="project_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     */
    private $tags;

    public function __construct() {
        $this->files = new ArrayCollection();
        $this->logs = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     */
    function onPrePersist() {
        $this->createdAt = new \DateTime('now');
    }

    /**
     *
     * @param \Administration\Entity\Tag $tag
     */
    public function addTag(\Administration\Entity\Tag $tag) {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    /**
     *
     * @param \Administration\Entity\Tag $tag
     */
    public function removeTag(\Administration\Entity\Tag $tag) {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }

    /**
     *
     * @return ArrayCollection
     */
    public function getTags() {
        return $this->tags;
    }

    /**
     *
     * @return array
     */
    public function getTagIds() {
        $ids = array();
        $this->tags->filter(function($tag) use (&$ids) {
            array_push($ids, $tag->getId());
        });

        return $ids;
    }

    /**
     *
     * @param \Administration\Entity\File $file
     */
    public function addFile(\Administration\Entity\File $file) {
        if (!$this->files->contains($file)) {
            $this->files->add($file);
        }

        return $this;
    }

    /**
     *
     * @param \Administration\Entity\File $file
     */
    public function removeFile(\Administration\Entity\File $file) {
        if ($this->files->contains($file)) {
            $this->files->removeElement($file);
        }

        return $this;
    }

    /**
     *
     * @return ArrayCollection
     */
    public function getFiles() {
        return $this->files;
    }

    /**
     *
     * @param \Administration\Entity\Log $log
     */
    public function addLog(\Administration\Entity\Log $log) {
        if (!$this->logs->contains($log)) {
            $this->logs->add($log);
        }

        return $this;
    }

    /**
     *
     * @param \Administration\Entity\Log $log
     */
    public function removeLog(\Administration\Entity\Log $log) {
        if ($this->logs->contains($log)) {
            $this->logs->removeElement($log);
        }

        return $this;
    }

    /**
     *
     * @return ArrayCollection
     */
    public function getLogs() {
        return $this->logs;
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
     * @param string $name
     * @return Project
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     *
     * @param string $description
     * @return Project
     */
    public function setDescription($description) {
        $this->description = $description;

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
     * @param string $url
     * @return Project
     */
    public function setUrl($url) {
        $this->url = $url;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     *
     * @return string
     */
    public function getThumb() {
        return $this->thumb;
    }

    /**
     *
     * @param string $thumb
     * @return Project
     */
    public function setThumb($thumb) {
        $this->thumb = $thumb;

        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getLikes() {
        return $this->likes;
    }

    /**
     *
     * @param integer $likes
     * @return Project
     */
    public function setLikes($likes) {
        $this->likes = $likes;

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
     * @return Project
     */
    public function setSortOrder($sortOrder) {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     *
     * @param integer
     * @return Project
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     *
     * @param \DateTime $createdAt
     * @return Project
     */
    public function setCreatedAt(\DateTime $createdAt) {
        $this->createdAt = $createdAt;

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
     * @return array
     */
    public function getData() {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
        );
    }

}
