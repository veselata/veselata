<?php

namespace AdministrationTest\Service;

class NavigationServiceTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var PHPUnit_Framework_TestCase
     */
    public $serviceLocatorMock;

    /**
     * @var PHPUnit_Framework_TestCase
     */
    public $pagesModelMock;

    /**
     * @var Administration\Service\NavigationService
     */
    public $service;

    /**
     *
     * @var string
     */
    public $serviceName = 'Administration\Service\NavigationService';

    public function setUp() {
        $this->serviceLocatorMock = $this->getMockBuilder('Zend\ServiceManager\ServiceLocatorInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $this->pagesModelMock = $this->getMockBuilder('Administration\Model\Pages')
            ->disableOriginalConstructor()
            ->getMock();

        $this->service = new $this->serviceName($this->pagesModelMock);
    }

    public function testGetPages() {
        $this->pagesModelMock->expects($this->once())
            ->method('getData')
            ->will($this->returnValue(array()));

        $application = $this->getMockBuilder('Zend\Mvc\Application')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceLocatorMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo('Application'))
            ->will($this->returnValue($application));

        $mvcEvent = $this->getMock('Zend\Mvc\MvcEvent');

        $application->expects($this->any())
            ->method('getMvcEvent')
            ->will($this->returnValue($mvcEvent));

        $mvcEvent->expects($this->once())
            ->method('getRouteMatch');

        $mvcEvent->expects($this->once())
            ->method('getRouter');

        $class = new \ReflectionClass($this->serviceName);
        $method = $class->getMethod('getPages');
        $method->setAccessible(true);
        $method->invokeArgs($this->service, array($this->serviceLocatorMock));
    }

    public function testGetPagesInvalidContainer() {
        $this->pagesModelMock->expects($this->once())
            ->method('getData');

        $this->setExpectedException('Exception');

        $class = new \ReflectionClass($this->serviceName);
        $method = $class->getMethod('getPages');
        $method->setAccessible(true);
        $method->invokeArgs($this->service, array($this->serviceLocatorMock));
    }

}
