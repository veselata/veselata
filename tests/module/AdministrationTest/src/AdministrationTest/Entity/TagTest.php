<?php

namespace AdministrationTest\Entity;

class TagTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     * @var Administration\Entity\Tag
     */
    public $entity;

    /**
     *
     * @var PHPUnit_Framework_TestCase
     */
    public $entityMock;

    public function setUp() {
        $this->entityMock = $this->getMock('Administration\Entity\Tag');
        $this->entity = new \Administration\Entity\Tag;
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

    public function testGetAddRemoveProject() {
        $collection = new \Doctrine\Common\Collections\ArrayCollection;
        $project = new \Administration\Entity\Project;
        $this->entity->addProject($project);

        $collection->add($project);
        $this->assertEquals($collection, $this->entity->getProjects());

        $this->entity->removeProject($project);
        $collection->removeElement($project);
        $this->assertEquals($collection, $this->entity->getProjects());
    }

    public function testGetProjectIds() {
        $this->assertInternalType('array', $this->entity->getProjectIds());
    }

    public function testSetGetTitle() {
        $title = 'title';
        $this->entity->setTitle($title);

        $this->entityMock->expects($this->once())
                ->method('getTitle')
                ->will($this->returnValue($title));
        $this->assertEquals($this->entity->getTitle(), $this->entityMock->getTitle());
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
