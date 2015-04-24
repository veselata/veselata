<?php

namespace AdministrationTest\Entity;

class ContactTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     * @var Administration\Entity\Contact
     */
    public $entity;

    /**
     *
     * @var PHPUnit_Framework_TestCase
     */
    public $entityMock;

    public function setUp() {
        $this->entityMock = $this->getMock('Administration\Entity\Contact');
        $this->entity = new \Administration\Entity\Contact;
    }

    public function testOnPrePersist() {
        $this->entityMock->expects($this->once())
            ->method('onPrePersist');

        $this->assertEquals($this->entity->onPrePersist(), $this->entityMock->onPrePersist());
    }

    public function testExchangeArray() {
        $data = array('name' => 'name');
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

    public function testSetGetName() {
        $name = 'name';
        $this->entity->setName($name);

        $this->entityMock->expects($this->once())
            ->method('getName')
            ->will($this->returnValue($name));
        $this->assertEquals($this->entity->getName(), $this->entityMock->getName());
    }

    public function testSetGetEmail() {
        $email = 'email';
        $this->entity->setEmail($email);

        $this->entityMock->expects($this->once())
            ->method('getEmail')
            ->will($this->returnValue($email));
        $this->assertEquals($this->entity->getEmail(), $this->entityMock->getEmail());
    }

    public function testSetGetSubject() {
        $subject = 'subject';
        $this->entity->setSubject($subject);

        $this->entityMock->expects($this->once())
            ->method('getSubject')
            ->will($this->returnValue($subject));
        $this->assertEquals($this->entity->getSubject(), $this->entityMock->getSubject());
    }

    public function testSetGetMessage() {
        $message = 'message';
        $this->entity->setMessage($message);

        $this->entityMock->expects($this->once())
            ->method('getMessage')
            ->will($this->returnValue($message));
        $this->assertEquals($this->entity->getMessage(), $this->entityMock->getMessage());
    }

    public function testSetGetIp() {
        $ip = 'ip';
        $this->entity->setIp($ip);

        $this->entityMock->expects($this->once())
            ->method('getIp')
            ->will($this->returnValue($ip));
        $this->assertEquals($this->entity->getIp(), $this->entityMock->getIp());
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
