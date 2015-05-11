<?php

namespace AdministrationTest\Service;

class AclServiceTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     * @var array
     */
    public $config;

    /**
     *
     * @var PHPUnit_Framework_TestCase
     */
    public $aclServiceMock;

    /**
     *
     * @var PHPUnit_Framework_TestCase
     */
    public $serviceMock;

    /**
     *
     * @var Administration\Service\AclService
     */
    public $service;

    /**
     *
     * @var string
     */
    public $serviceName = 'Administration\Service\AclService';

    public function setUp() {
        $this->config = array(
            'roles' => array(\Administration\Model\Users::getTypeByKey(\Administration\Model\Users::TYPE_GUEST) => null,),
            'resources' => array(
                'allow' => array(
                    'Application\Controller\IndexController' => array(
                        null => array('guest'),
                    ),
                ),
                'deny' => array(
                    'Administration\Controller\IndexController' => array(
                        null => array('guest'),
                    ),
                ),
            ),
        );

        $this->aclServiceMock = $this->getMock('Zend\Permissions\Acl\Acl');

        $this->serviceMock = $this->getMockBuilder($this->serviceName)
                ->setConstructorArgs(array($this->aclServiceMock, $this->config))
                ->getMock();

        $this->service = new $this->serviceName($this->aclServiceMock, $this->config);
    }

    public function testInvalidConfig() {
        $config = array();
        $this->setExpectedException('Exception');
        $service = new \Administration\Service\AclService($this->aclServiceMock, $config);
    }

    public function testAddRolesInvalidConfig() {
        $config = array(
            'roles' => array('name' => 'parent'),
            'resources' => array(),
        );
        $this->setExpectedException('Exception');
        $service = new \Administration\Service\AclService($this->aclServiceMock, $config);
        $service->addRoles();
    }

    public function testAddResourcesInvalidConfig() {
        $this->config['resources']['invalid'] = array(
            'Application\Controller\IndexController' => array(
                null => array('guest'),
        ));
        $this->setExpectedException('Exception');
        $service = new \Administration\Service\AclService($this->aclServiceMock, $this->config);
        $service->addResources();
    }

    public function testIsAllowed() {
        $param = null;
        $this->serviceMock->expects($this->any())
                ->method('isAllowed')
                ->with($param, $param, $param);

        $this->assertSame($this->service->isAllowed($param, $param, $param), $this->serviceMock->isAllowed($param, $param, $param));
    }

    public function testHasResource() {
        $resource = $this->getMockBuilder('Zend\Permissions\Acl\Resource\GenericResource')
                ->disableOriginalConstructor()
                ->getMock();
        $this->serviceMock->expects($this->any())
                ->method('hasResource')
                ->with($this->equalTo($resource));

        $this->assertSame($this->service->hasResource($resource), $this->serviceMock->hasResource($resource));
    }

}
