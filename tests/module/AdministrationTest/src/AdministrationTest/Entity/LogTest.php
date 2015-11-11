<?php

namespace AdministrationTest\Entity;

class LogTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     * @var Administration\Entity\Log
     */
    public $entity;

    /**
     *
     * @var PHPUnit_Framework_TestCase
     */
    public $entityMock;

    public function setUp() {
        $this->entityMock = $this->getMock('Administration\Entity\Log');
        $this->entity = new \Administration\Entity\Log;
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

    public function testSetGetIp() {
        $ip = 'ip';
        $this->entity->setIp($ip);

        $this->entityMock->expects($this->once())
                ->method('getIp')
                ->will($this->returnValue($ip));
        $this->assertEquals($this->entity->getIp(), $this->entityMock->getIp());
    }

    public function testSetGetExtra() {
        $extra = 'extra';
        $this->entity->setExtra($extra);

        $this->entityMock->expects($this->once())
                ->method('getExtra')
                ->will($this->returnValue($extra));
        $this->assertEquals($this->entity->getExtra(), $this->entityMock->getExtra());
    }

    public function testSetGetIsBlocked() {
        $isBlocked = true;
        $this->entity->setIsBlocked($isBlocked);

        $this->entityMock->expects($this->once())
                ->method('getIsBlocked')
                ->will($this->returnValue($isBlocked));
        $this->assertEquals($this->entity->getIsBlocked(), $this->entityMock->getIsBlocked());
    }

    public function testGetIsBlockedReturnBoolean() {
        $this->entityMock->expects($this->once())
                ->method('getIsBlocked')
                ->will($this->returnValue(true));
        $this->assertInternalType('boolean', $this->entityMock->getIsBlocked());
    }

    public function testSetGetIsTrack() {
        $isTrack = true;
        $this->entity->setIsTrack($isTrack);

        $this->entityMock->expects($this->once())
                ->method('getIsTrack')
                ->will($this->returnValue($isTrack));
        $this->assertEquals($this->entity->getIsTrack(), $this->entityMock->getIsTrack());
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

    public function testAddGetProject() {
        $project = new \Administration\Entity\Project;
        $this->entity->addProject($project);
        $this->entityMock->expects($this->once())
                ->method('getProject')
                ->will($this->returnValue($project));

        $this->assertEquals($this->entity->getProject(), $this->entityMock->getProject());
    }

}
