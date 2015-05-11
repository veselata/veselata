<?php

namespace AdministrationTest\Entity;

class PageTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     * @var Administration\Entity\Page
     */
    public $entity;

    /**
     *
     * @var PHPUnit_Framework_TestCase
     */
    public $entityMock;

    public function setUp() {
        $this->entityMock = $this->getMock('Administration\Entity\Page');
        $this->entity = new \Administration\Entity\Page;
    }

    public function testOnPrePersist() {
        $this->entityMock->expects($this->once())
                ->method('onPrePersist');

        $this->assertEquals($this->entity->onPrePersist(), $this->entityMock->onPrePersist());
    }

    public function testGetId() {
        $this->entityMock->expects($this->once())
                ->method('getId');

        $this->assertEquals($this->entity->getId(), $this->entityMock->getId());
    }

    public function testSetGetParentId() {
        $parentId = 1;
        $this->entity->setParentId($parentId);

        $this->entityMock->expects($this->once())
                ->method('getParentId')
                ->will($this->returnValue($parentId));
        $this->assertEquals($this->entity->getParentId(), $this->entityMock->getParentId());
    }

    public function testSetGetMenu() {
        $menu = 1;
        $this->entity->setMenu($menu);

        $this->entityMock->expects($this->once())
                ->method('getMenu')
                ->will($this->returnValue($menu));
        $this->assertEquals($this->entity->getMenu(), $this->entityMock->getMenu());
    }

    public function testSetGetRoute() {
        $route = 'route';
        $this->entity->setRoute($route);

        $this->entityMock->expects($this->once())
                ->method('getRoute')
                ->will($this->returnValue($route));
        $this->assertEquals($this->entity->getRoute(), $this->entityMock->getRoute());
    }

    public function testSetGetController() {
        $controller = 'controller';
        $this->entity->setController($controller);

        $this->entityMock->expects($this->once())
                ->method('getController')
                ->will($this->returnValue($controller));
        $this->assertEquals($this->entity->getController(), $this->entityMock->getController());
    }

    public function testSetGetAction() {
        $action = 'action';
        $this->entity->setAction($action);

        $this->entityMock->expects($this->once())
                ->method('getAction')
                ->will($this->returnValue($action));
        $this->assertEquals($this->entity->getAction(), $this->entityMock->getAction());
    }

    public function testSetetTitle() {
        $title = 'title';
        $this->entity->setTitle($title);

        $this->entityMock->expects($this->once())
                ->method('getTitle')
                ->will($this->returnValue($title));
        $this->assertEquals($this->entity->getTitle(), $this->entityMock->getTitle());
    }

    public function testSetGetDescription() {
        $description = 'description';
        $this->entity->setDescription($description);

        $this->entityMock->expects($this->once())
                ->method('getDescription')
                ->will($this->returnValue($description));
        $this->assertEquals($this->entity->getDescription(), $this->entityMock->getDescription());
    }

    public function testSetGetSortOrder() {
        $sortOrder = 1;
        $this->entity->setSortOrder($sortOrder);

        $this->entityMock->expects($this->once())
                ->method('getSortOrder')
                ->will($this->returnValue($sortOrder));
        $this->assertEquals($this->entity->getSortOrder(), $this->entityMock->getSortOrder());
    }

    public function testSetGetIsActive() {
        $isActive = true;
        $this->entity->setIsActive($isActive);

        $this->entityMock->expects($this->once())
                ->method('getIsActive')
                ->will($this->returnValue($isActive));
        $this->assertEquals($this->entity->getIsActive(), $this->entityMock->getIsActive());
    }

    public function testGetIsActiveReturnBoolean() {
        $this->entityMock->expects($this->once())
                ->method('getIsActive')
                ->will($this->returnValue(true));
        $this->assertInternalType('boolean', $this->entityMock->getIsActive());
    }

    public function testSetGetCreatedAt() {
        $createdAt = new \DateTime();
        $this->entity->setCreatedAt($createdAt);

        $this->entityMock->expects($this->once())
                ->method('getCreatedAt')
                ->will($this->returnValue($createdAt));
        $this->assertEquals($this->entity->getCreatedAt(), $this->entityMock->getCreatedAt());
    }

    public function testGetCreatedAtReturnDateTime() {
        $createdAt = new \DateTime();
        $this->entityMock->expects($this->once())
                ->method('getCreatedAt')
                ->will($this->returnValue($createdAt));
        $this->assertInternalType('object', $this->entityMock->getCreatedAt());
    }

    public function testGetNavigation() {
        $this->assertInternalType('array', $this->entity->getNavigation());
    }

}
