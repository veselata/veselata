<?php

namespace AdministrationTest\Entity;

class UserTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     * @var Administration\Entity\User
     */
    public $entity;

    /**
     *
     * @var PHPUnit_Framework_TestCase
     */
    public $entityMock;

    public function setUp() {
        $this->entityMock = $this->getMock('Administration\Entity\User');
        $this->entity = new \Administration\Entity\User;
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

    public function testSetGetName() {
        $name = 'name';
        $this->entity->setName($name);

        $this->entityMock->expects($this->once())
                ->method('getName')
                ->will($this->returnValue($name));
        $this->assertEquals($this->entity->getName(), $this->entityMock->getName());
    }

    public function testSetGetUsername() {
        $username = 'username';
        $this->entity->setUsername($username);

        $this->entityMock->expects($this->once())
                ->method('getUsername')
                ->will($this->returnValue($username));
        $this->assertEquals($this->entity->getUsername(), $this->entityMock->getUsername());
    }

    public function testSetGetPassword() {
        $password = 'password';
        $this->entity->setPassword($password);

        $this->assertInternalType('string', $this->entity->getPassword());
    }

    public function testVerifyPassword() {
        $password = 'password';
        $bcrypt = new \Zend\Crypt\Password\Bcrypt;
        $hash = $bcrypt->create($password);

        $this->assertTrue($this->entity->verifyPassword($password, $hash));
    }

    public function testSetGetType() {
        $type = 1;
        $this->entity->setType($type);

        $this->entityMock->expects($this->once())
                ->method('getType')
                ->will($this->returnValue($type));
        $this->assertEquals($this->entity->getType(), $this->entityMock->getType());
    }

    public function testSetGetStatus() {
        $status = \Administration\Model\BaseModel::STATUS_ACTIVE;
        $this->entity->setStatus($status);

        $this->entityMock->expects($this->once())
                ->method('getStatus')
                ->will($this->returnValue($status));
        $this->assertEquals($this->entity->getStatus(), $this->entityMock->getStatus());
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
