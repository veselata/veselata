<?php

namespace AdministrationTest\Service;

class AuthServiceTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var PHPUnit_Framework_TestCase
     */
    public $authenticationServiceMock;

    /**
     *
     * @var PHPUnit_Framework_TestCase
     */
    public $serviceMock;

    /**
     * @var Administration\Service\AuthService
     */
    public $service;

    /**
     *
     * @var string
     */
    public $serviceName = 'Administration\Service\AuthService';

    /**
     *
     * @var Administration\Entity\User
     */
    public $identityMock;

    public function setUp() {
        $this->authenticationServiceMock = $this->getMockBuilder('Zend\Authentication\AuthenticationService')
                ->disableOriginalConstructor()
                ->getMock();

        $this->serviceMock = $this->getMockBuilder($this->serviceName)
                ->setConstructorArgs(array($this->authenticationServiceMock))
                ->getMock();

        $this->service = new $this->serviceName($this->authenticationServiceMock);

        $this->identityMock = $this->getMock('Administration\Entity\User');
    }

    public function testIsValid() {
        $identity = array('username' => 'username', 'password' => 'password');

        $adapter = $this->getMockBuilder('DoctrineModule\Authentication\Adapter\ObjectRepository')
                ->disableOriginalConstructor()
                ->getMock();

        $this->authenticationServiceMock->expects($this->once())
                ->method('getAdapter')
                ->will($this->returnValue($adapter));

        $adapter->expects($this->once())
                ->method('setIdentityValue')
                ->with($identity['username']);

        $adapter->expects($this->once())
                ->method('setCredentialValue')
                ->with($identity['password']);

        $result = $this->getMockBuilder('Zend\Authentication\Result')
                ->disableOriginalConstructor()
                ->getMock();

        $this->authenticationServiceMock->expects($this->once())
                ->method('authenticate')
                ->with($this->equalTo($adapter))
                ->will($this->returnValue($result));

        $result->expects($this->once())
                ->method('isValid')
                ->will($this->returnValue(true));

        $result->expects($this->once())
                ->method('getIdentity')
                ->will($this->returnValue($this->identityMock));

        $this->identityMock->expects($this->once())
                ->method('getStatus')
                ->will($this->returnValue(\Administration\Model\BaseModel::STATUS_ACTIVE));

        $storage = $this->getMockBuilder('DoctrineModule\Authentication\Storage\ObjectRepository')
                ->disableOriginalConstructor()
                ->getMock();

        $this->authenticationServiceMock->expects($this->once())
                ->method('getStorage')
                ->will($this->returnValue($storage));

        $storage->expects($this->once())
                ->method('write');

        $this->assertTrue($this->service->isValid($identity));
    }

    public function testIsValidNotAllowed() {
        $identity = array('username' => 'username', 'password' => 'password');

        $adapter = $this->getMockBuilder('DoctrineModule\Authentication\Adapter\ObjectRepository')
                ->disableOriginalConstructor()
                ->getMock();

        $this->authenticationServiceMock->expects($this->once())
                ->method('getAdapter')
                ->will($this->returnValue($adapter));

        $adapter->expects($this->once())
                ->method('setIdentityValue')
                ->with($identity['username']);

        $adapter->expects($this->once())
                ->method('setCredentialValue')
                ->with($identity['password']);

        $result = $this->getMockBuilder('Zend\Authentication\Result')
                ->disableOriginalConstructor()
                ->getMock();

        $this->authenticationServiceMock->expects($this->once())
                ->method('authenticate')
                ->with($this->equalTo($adapter))
                ->will($this->returnValue($result));

        $result->expects($this->once())
                ->method('isValid')
                ->will($this->returnValue(true));

        $result->expects($this->once())
                ->method('getIdentity')
                ->will($this->returnValue($this->identityMock));

        $this->identityMock->expects($this->once())
                ->method('getStatus')
                ->will($this->returnValue(\Administration\Model\BaseModel::STATUS_INACTIVE));

        $this->assertFalse($this->service->isValid($identity));
    }

    public function testIsValidNotFound() {
        $identity = array('username' => 'username', 'password' => 'password');

        $adapter = $this->getMockBuilder('DoctrineModule\Authentication\Adapter\ObjectRepository')
                ->disableOriginalConstructor()
                ->getMock();

        $this->authenticationServiceMock->expects($this->once())
                ->method('getAdapter')
                ->will($this->returnValue($adapter));

        $adapter->expects($this->once())
                ->method('setIdentityValue')
                ->with($identity['username']);

        $adapter->expects($this->once())
                ->method('setCredentialValue')
                ->with($identity['password']);

        $result = $this->getMockBuilder('Zend\Authentication\Result')
                ->disableOriginalConstructor()
                ->getMock();

        $this->authenticationServiceMock->expects($this->once())
                ->method('authenticate')
                ->with($this->equalTo($adapter))
                ->will($this->returnValue($result));

        $result->expects($this->once())
                ->method('isValid')
                ->will($this->returnValue(false));

        $this->assertFalse($this->service->isValid($identity));
    }

    public function testIsValidInvalidParameter() {
        $identity = array();
        $this->setExpectedException('Exception');
        $this->service->isValid($identity);
    }

    public function testGetIdentity() {
        $this->authenticationServiceMock->expects($this->any())
                ->method('getIdentity');
        $this->assertSame($this->service->getIdentity(), $this->authenticationServiceMock->getIdentity());
    }

    public function testClearIdentity() {
        $this->authenticationServiceMock->expects($this->any())
                ->method('clearIdentity');
        $this->assertSame($this->service->clearIdentity(), $this->authenticationServiceMock->clearIdentity());
    }

    public function testHasAdminAccess() {
        $this->authenticationServiceMock->expects($this->any())
                ->method('hasAdminAccess');
        $this->assertSame($this->service->hasAdminAccess(), $this->authenticationServiceMock->hasIdentity());
    }

    public function testGetUserIdentity() {
        $this->authenticationServiceMock->expects($this->any())
                ->method('hasIdentity')
                ->will($this->returnValue(true));

        $storage = $this->getMockBuilder('DoctrineModule\Authentication\Storage\ObjectRepository')
                ->disableOriginalConstructor()
                ->getMock();

        $this->authenticationServiceMock->expects($this->once())
                ->method('getStorage')
                ->will($this->returnValue($storage));

        $storage->expects($this->once())
                ->method('read')
                ->will($this->returnValue($this->identityMock));

        $this->identityMock->expects($this->once())
                ->method('getName');

        $this->identityMock->expects($this->once())
                ->method('getType');

        $this->identityMock->expects($this->once())
                ->method('getUsername');

        $this->assertInternalType('array', $this->service->getUserIdentity());
    }

    public function testGetUserIdentityNotFound() {
        $this->authenticationServiceMock->expects($this->any())
                ->method('hasIdentity')
                ->will($this->returnValue(false));

        $this->assertInternalType('array', $this->service->getUserIdentity());
        $this->assertTrue(array_key_exists('role', $this->service->getUserIdentity()));
    }

}
