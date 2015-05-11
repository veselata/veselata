<?php

namespace Administration\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 *
 * @ORM\Table(name="pages", indexes={@ORM\Index(name="parent_id", columns={"parent_id"})})
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class Page {

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
     * @ORM\Column(name="parent_id", type="integer", nullable=false)
     */
    private $parentId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="menu", type="integer", nullable=false)
     */
    private $menu = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="route", type="string", length=255, nullable=true)
     */
    private $route;

    /**
     * @var string
     *
     * @ORM\Column(name="controller", type="string", length=100, nullable=false)
     */
    private $controller;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=100, nullable=false)
     */
    private $action;

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
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\PrePersist
     */
    function onPrePersist() {
        $this->menu = \Administration\Model\Pages::DEFAULT_MENU;
        $this->createdAt = new \DateTime('now');
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
     * @param integer $parentId
     * @return Page
     */
    public function setParentId($parentId) {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getParentId() {
        return $this->parentId;
    }

    /**
     *
     * @return integer
     */
    public function getMenu() {
        return $this->menu;
    }

    /**
     *
     * @param integer $menu
     * @return Page
     */
    public function setMenu($menu) {
        $this->menu = $menu;

        return $this;
    }

    /**
     *
     * @param string $route
     * @return Page
     */
    public function setRoute($route) {
        $this->route = $route;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getRoute() {
        return $this->route;
    }

    /**
     *
     * @param string $controller
     * @return Page
     */
    public function setController($controller) {
        $this->controller = $controller;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getController() {
        return $this->controller;
    }

    /**
     *
     * @param string $action
     * @return Page
     */
    public function setAction($action) {
        $this->action = $action;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getAction() {
        return $this->action;
    }

    /**
     *
     * @param string $title
     * @return Page
     */
    public function setTitle($title) {
        $this->title = $title;

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
     * @param string $description
     * @return Page
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
     * @return integer
     */
    public function getSortOrder() {
        return $this->sortOrder;
    }

    /**
     *
     * @param integer $sortOrder
     * @return Page
     */
    public function setSortOrder($sortOrder) {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     *
     * @param boolean
     * @return Page
     */
    public function setIsActive($isActive) {
        $this->isActive = (boolean) $isActive;

        return $this;
    }

    /**
     *
     * @return boolen
     */
    public function getIsActive() {
        return $this->isActive;
    }

    /**
     *
     * @param \DateTime $createdAt
     * @return Page
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
    public function getNavigation() {
        return array(
            'label' => $this->getTitle(),
            'route' => $this->getRoute(),
            'controller' => $this->getController(),
            'action' => $this->getAction(),
        );
    }

}
