<?php

namespace AdministrationTest\Model;

class UsersTest extends \PHPUnit_Framework_TestCase {

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
    public $entity = 'Administration\Entity\User';

    /**
     *
     * @var Administration\Model\Users
     */
    public $model = 'Administration\Model\Users';

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
        $criteria = array('isActive' => true);
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
        $data = array('title' => 'title');

        $this->entityMock->expects($this->any())
            ->method('exchangeArray')
            ->with($this->equalTo($data));

        $this->entityManagerMock->expects($this->any())
            ->method('persist')
            ->with($this->equalTo($this->entityMock));

        $this->entityManagerMock->expects($this->any())
            ->method('flush');

        $this->assertSame($this->entityModel->add($data), $this->baseModelMock->add($data));
    }

    public function testEdit() {
        $data = array('id' => 1);

        $this->entityManagerMock->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($this->repositoryMock));

        $this->repositoryMock->expects($this->any())
            ->method('find')
            ->with($this->equalTo($data['id']))
            ->will($this->returnValue($this->entityMock));

        $this->entityMock->expects($this->any())
            ->method('exchangeArray')
            ->with($this->equalTo($data));

        $this->entityManagerMock->expects($this->any())
            ->method('persist')
            ->with($this->equalTo($this->entityMock));

        $this->entityManagerMock->expects($this->any())
            ->method('flush');

        $this->assertSame($this->entityModel->edit($data), $this->baseModelMock->edit($data));
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

}
