<?php

namespace AdministrationTest\Model;

class PagesTest extends \PHPUnit_Framework_TestCase {

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
     * @var Administration\Entity\Page
     */
    public $entity = 'Administration\Entity\Page';

    /**
     *
     * @var Administration\Model\Pages
     */
    public $model = 'Administration\Model\Pages';

    /**
     *
     * @var PHPUnit_Framework_TestCase
     */
    public $baseModelMock;

    /**
     *
     * @var PHPUnit_Framework_TestCase
     */
    public $entityMock;

    /**
     *
     * @var PHPUnit_Framework_TestCase
     */
    public $entityModelMock;

    /**
     *
     * @var Administration\Model\Files
     */
    public $entityModel;

    public function setUp() {
        $this->entityManagerMock = $this->getMockBuilder('Doctrine\ORM\EntityManager')
                ->disableOriginalConstructor()
                ->getMock();

        $this->repositoryMock = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                ->disableOriginalConstructor()
                ->getMock();

        $this->entityMock = $this->getMock($this->entity);

        $this->baseModelMock = $this->getMockBuilder('Administration\Model\BaseModel')
                ->setConstructorArgs(array($this->entityManagerMock, $this->entityMock))
                ->getMockForAbstractClass();

        $this->entityModelMock = $this->getMockBuilder($this->model)
                ->setConstructorArgs(array($this->entityManagerMock, $this->entityMock))
                ->getMockForAbstractClass();

        $this->entityModel = new $this->model($this->entityManagerMock, $this->entityMock);
    }

    public function testGetAll() {
        $criteria = array('status' => \Administration\Model\BaseModel::STATUS_INACTIVE);
        $this->entityManagerMock->expects($this->any())
                ->method('getRepository')
                ->will($this->returnValue($this->repositoryMock));

        $this->repositoryMock->expects($this->any())
                ->method('findBy')
                ->with($criteria)
                ->will($this->returnValue($this->entityModelMock));

        $this->assertSame($this->entityModel->getAll($criteria), $this->baseModelMock->getAll($criteria));
    }

    public function testGet() {
        $id = 1;

        $this->entityManagerMock->expects($this->any())
                ->method('getRepository')
                ->will($this->returnValue($this->repositoryMock));

        $this->repositoryMock->expects($this->any())
                ->method('find')
                ->with($this->equalTo($id));

        $this->assertSame($this->entityModel->get($id), $this->baseModelMock->get($id));
    }

    public function testAdd() {
        $this->entityManagerMock->expects($this->any())
                ->method('persist')
                ->with($this->equalTo($this->entityMock));

        $this->entityManagerMock->expects($this->any())
                ->method('flush');

        $this->assertSame($this->entityModel->add($this->entityMock), $this->baseModelMock->add($this->entityMock));
    }

    public function testEdit() {
        $id = 1;

        $this->entityMock->expects($this->any())
                ->method('getId')
                ->will($this->returnValue($id));

        $this->entityManagerMock->expects($this->any())
                ->method('getRepository')
                ->will($this->returnValue($this->repositoryMock));

        $this->repositoryMock->expects($this->any())
                ->method('find')
                ->with($this->equalTo($id))
                ->will($this->returnValue($this->entityMock));

        $this->entityManagerMock->expects($this->any())
                ->method('persist')
                ->with($this->equalTo($this->entityMock));

        $this->entityManagerMock->expects($this->any())
                ->method('flush');

        $this->assertSame($this->entityModel->edit($this->entityMock), $this->baseModelMock->edit($this->entityMock));
    }

    public function testDelete() {
        $id = 1;

        $this->entityManagerMock->expects($this->any())
                ->method('getRepository')
                ->will($this->returnValue($this->repositoryMock));

        $this->repositoryMock->expects($this->any())
                ->method('find')
                ->with($this->equalTo($id))
                ->will($this->returnValue($this->entityModelMock));

        $this->entityManagerMock->expects($this->any())
                ->method('remove')
                ->with($this->equalTo($this->entityModelMock));

        $this->entityManagerMock->expects($this->any())
                ->method('flush');

        $this->assertSame($this->entityModel->delete($id), $this->baseModelMock->delete($id));
    }

    public function testGetData() {
        $criteria = array('status' => \Administration\Model\BaseModel::STATUS_ACTIVE);
        $this->entityManagerMock->expects($this->any())
                ->method('getRepository')
                ->will($this->returnValue($this->repositoryMock));

        $this->repositoryMock->expects($this->any())
                ->method('findBy')
                ->with($criteria)
                ->will($this->returnValue(array($this->entityMock)));

        $this->entityMock->expects($this->any())
                ->method('getParentId');

        $this->assertInternalType('array', $this->entityModel->getData());
    }

    public function testGetDataWithParentId() {
        $criteria = array('status' => \Administration\Model\BaseModel::STATUS_ACTIVE);
        $this->entityManagerMock->expects($this->any())
                ->method('getRepository')
                ->will($this->returnValue($this->repositoryMock));

        $this->repositoryMock->expects($this->any())
                ->method('findBy')
                ->with($criteria)
                ->will($this->returnValue(array($this->entityMock)));

        $this->entityMock->expects($this->any())
                ->method('getParentId')
                ->will($this->returnValue(1));

        $this->entityMock->expects($this->any())
                ->method('getId');

        $this->assertInternalType('array', $this->entityModel->getData());
    }

    public function testFindOneBy() {
        $criteria = array();
        $this->entityManagerMock->expects($this->any())
                ->method('getRepository')
                ->will($this->returnValue($this->repositoryMock));

        $this->repositoryMock->expects($this->any())
                ->method('findOneBy')
                ->with($criteria)
                ->will($this->returnValue($this->entityMock));

        $this->entityMock->expects($this->any())
                ->method('getTitle');

        $this->entityMock->expects($this->any())
                ->method('getDescription');

        $this->assertInternalType('array', $this->entityModel->findOneBy($criteria));
    }

}
