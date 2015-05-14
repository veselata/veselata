<?php

namespace AdministrationTest\Model;

class BaseModelTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     * @var PHPUnit_Framework_TestCase
     */
    public $entityManagerMock;

    /**
     *
     * @var PHPUnit_Framework_TestCase
     */
    public $repositoryMock;

    /**
     *
     * @var Administration\Entity\User
     */
    public $testRepo;

    /**
     *
     * @var PHPUnit_Framework_TestCase
     */
    public $testRepoMock;

    /**
     *
     * @var PHPUnit_Framework_TestCase
     */
    public $baseModelMock;

    public function setUp() {
        $this->entityManagerMock = $this->getMockBuilder('Doctrine\ORM\EntityManager')
                ->disableOriginalConstructor()
                ->getMock();

        $this->repositoryMock = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                ->disableOriginalConstructor()
                ->getMock();

        $this->testRepo = new \Administration\Entity\User;

        $this->testRepoMock = $this->getMock(get_class($this->testRepo));

        $this->baseModelMock = $this->getMockBuilder('Administration\Model\BaseModel')
                ->setConstructorArgs(array($this->entityManagerMock, $this->testRepo))
                ->getMockForAbstractClass();
    }

    public function testGetAll() {
        $criteria = array('status' => \Administration\Model\BaseModel::STATUS_ACTIVE);
        $this->entityManagerMock->expects($this->once())
                ->method('getRepository')
                ->will($this->returnValue($this->repositoryMock));

        $this->repositoryMock->expects($this->once())
                ->method('findBy')
                ->with($criteria)
                ->will($this->returnValue($this->testRepo));

        $this->baseModelMock->getAll();
    }

    public function testGetId() {
        $id = 1;

        $this->entityManagerMock->expects($this->once())
                ->method('getRepository')
                ->will($this->returnValue($this->repositoryMock));

        $this->repositoryMock->expects($this->once())
                ->method('find')
                ->with($this->equalTo($id));

        $this->baseModelMock->get($id);
    }

    public function testGetIdInvalidArgument() {
        $id = 'text';
        $this->setExpectedException('Exception');
        $this->baseModelMock->get($id);
    }

    public function testAdd() {
        $this->entityManagerMock->expects($this->once())
                ->method('persist')
                ->with($this->equalTo($this->testRepo));

        $this->entityManagerMock->expects($this->once())
                ->method('flush');

        $this->baseModelMock->add($this->testRepo);
    }

    public function testAddInvalidArgument() {
        $object = 'text';
        $this->setExpectedException('Exception');
        $this->baseModelMock->add($object);
    }

    public function testEdit() {
        $id = 1;

        $this->testRepoMock->expects($this->once())
                ->method('getId')
                ->will($this->returnValue($id));

        $this->entityManagerMock->expects($this->once())
                ->method('getRepository')
                ->will($this->returnValue($this->repositoryMock));

        $this->repositoryMock->expects($this->once())
                ->method('find')
                ->will($this->returnValue($this->testRepoMock));

        $this->entityManagerMock->expects($this->once())
                ->method('persist')
                ->with($this->equalTo($this->testRepoMock));

        $this->entityManagerMock->expects($this->once())
                ->method('flush');

        $this->baseModelMock->edit($this->testRepoMock);
    }

    public function testEditInvalidId() {
        $this->setExpectedException('Exception');

        $id = -1;
        $this->testRepoMock->expects($this->once())
                ->method('getId')
                ->will($this->returnValue($id));

        $this->baseModelMock->edit($this->testRepoMock);
    }

    public function testEditInvalidObject() {
        $this->setExpectedException('Exception');

        $object = new \stdClass();
        $this->baseModelMock->edit($object);
    }

    public function testEditEntityNotFound() {
        $this->setExpectedException('Exception');

        $id = 1;
        $this->testRepoMock->expects($this->once())
                ->method('getId')
                ->will($this->returnValue($id));

        $this->entityManagerMock->expects($this->once())
                ->method('getRepository')
                ->will($this->returnValue($this->repositoryMock));

        $this->repositoryMock->expects($this->once())
                ->method('find')
                ->with($this->equalTo($id))
                ->will($this->returnValue(null));

        $this->baseModelMock->edit($this->testRepoMock);
    }

    public function testDelete() {
        $id = 1;

        $this->entityManagerMock->expects($this->once())
                ->method('getRepository')
                ->will($this->returnValue($this->repositoryMock));

        $this->repositoryMock->expects($this->once())
                ->method('find')
                ->with($this->equalTo($id))
                ->will($this->returnValue($this->testRepo));

        $this->entityManagerMock->expects($this->once())
                ->method('remove')
                ->with($this->equalTo($this->testRepo));

        $this->entityManagerMock->expects($this->once())
                ->method('flush');

        $this->baseModelMock->delete($id);
    }

    public function testDeleteInvalidParameter() {
        $id = 'text';
        $this->setExpectedException('Exception');
        $this->baseModelMock->delete($id);
    }

    public function testDeleteEntityNotFound() {
        $id = 1;
        $this->setExpectedException('Exception');

        $this->entityManagerMock->expects($this->once())
                ->method('getRepository')
                ->will($this->returnValue($this->repositoryMock));

        $this->repositoryMock->expects($this->once())
                ->method('find')
                ->with($this->equalTo($id));

        $this->entityManagerMock->expects($this->never())
                ->method('remove');

        $this->entityManagerMock->expects($this->never())
                ->method('flush');

        $this->baseModelMock->delete($id);
    }

    public function testFindOneBy() {
        $criteria = array('some');
        $this->entityManagerMock->expects($this->once())
                ->method('getRepository')
                ->will($this->returnValue($this->repositoryMock));

        $this->repositoryMock->expects($this->once())
                ->method('findOneBy')
                ->with($criteria)
                ->will($this->returnValue($this->testRepo));

        $this->baseModelMock->findOneBy($criteria);
    }

    public function testFindOneByInvalidParameter() {
        $criteria = 'criteria';
        $this->setExpectedException('Exception');
        $this->baseModelMock->findOneBy($criteria);
    }

}
