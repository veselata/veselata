<?php

namespace AdministrationTest\Entity;

class BoxTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     * @var Administration\Entity\Box
     */
    public $entity;

    /**
     *
     * @var PHPUnit_Framework_TestCase
     */
    public $entityMock;

    public function setUp() {
        $this->entityMock = $this->getMock('Administration\Entity\Box');
        $this->entity = new \Administration\Entity\Box;
    }

    public function testOnPrePersist() {
        $this->entityMock->expects($this->once())
            ->method('onPrePersist');

        $this->assertEquals($this->entity->onPrePersist(), $this->entityMock->onPrePersist());
    }

    public function testExchangeArray() {
        $data = array('title' => 'title');
        $this->entityMock->expects($this->once())
            ->method('exchangeArray')
            ->with($this->equalTo($data));

        $this->assertEquals($this->entity->exchangeArray($data), $this->entityMock->exchangeArray($data));
    }

    public function testGetId() {
        $this->entityMock->expects($this->once())
            ->method('getId');

        $this->assertEquals($this->entity->getId(), $this->entityMock->getId());
    }

    public function testSetGetTitle() {
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

    public function testSetGetPosition() {
        $position = 1;
        $this->entity->setPosition($position);

        $this->entityMock->expects($this->once())
            ->method('getPosition')
            ->will($this->returnValue($position));
        $this->assertEquals($this->entity->getPosition(), $this->entityMock->getPosition());
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

}