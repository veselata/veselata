<?php

namespace AdministrationTest\Service;

class NotificationServiceTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     * @var PHPUnit_Framework_TestCase
     */
    public $serviceMock;

    /**
     * @var Administration\Service\NotificationService
     */
    public $service;

    /**
     *
     * @var string
     */
    public $serviceName = 'Administration\Service\NotificationService';

    public function setUp() {
        $this->serviceMock = $this->getMock($this->serviceName);
        $this->service = new $this->serviceName();
    }

    public function testSubjectLists() {
        $this->assertInternalType('array', $this->service->subjectLists());
    }

    public function testSetGetAdminMail() {
        $mail = 'mail';
        $this->service->setAdminMail($mail);
        $this->serviceMock->expects($this->once())
                ->method('getAdminMail')
                ->will($this->returnValue($mail));
        $this->assertSame($this->service->getAdminMail(), $this->serviceMock->getAdminMail());
    }

    public function testgetSubjectByType() {
        $type = 'type';
        $this->serviceMock->expects($this->once())
                ->method('getSubjectByType')
                ->with($this->equalTo($type))
                ->will($this->returnValue(\Administration\Service\NotificationService::DEFAULT_NAME));
        $this->assertSame($this->service->getSubjectByType($type), $this->serviceMock->getSubjectByType($type));
    }

}
