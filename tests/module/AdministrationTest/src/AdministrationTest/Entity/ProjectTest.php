<?php

namespace AdministrationTest\Entity;

class ProjectTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     * @var Administration\Entity\Project
     */
    public $entity;

    /**
     *
     * @var PHPUnit_Framework_TestCase
     */
    public $entityMock;

    public function setUp() {
        $this->entityMock = $this->getMock('Administration\Entity\Project');
        $this->entity = new \Administration\Entity\Project;
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

    public function testGetAddRemoveTag() {
        $collection = new \Doctrine\Common\Collections\ArrayCollection;
        $tag = new \Administration\Entity\Tag;
        $this->entity->addTag($tag);

        $collection->add($tag);
        $this->assertEquals($collection, $this->entity->getTags());

        $this->entity->removeTag($tag);
        $collection->removeElement($tag);
        $this->assertEquals($collection, $this->entity->getTags());
    }

    public function testGetTagIds() {
        $this->assertInternalType('array', $this->entity->getTagIds());
    }

    public function testGetAddRemoveFile() {
        $collection = new \Doctrine\Common\Collections\ArrayCollection;
        $file = new \Administration\Entity\File;
        $this->entity->addFile($file);

        $collection->add($file);
        $this->assertEquals($collection, $this->entity->getFiles());

        $this->entity->removeFile($file);
        $collection->removeElement($file);
        $this->assertEquals($collection, $this->entity->getFiles());
    }

    public function testGetAddRemoveLog() {
        $collection = new \Doctrine\Common\Collections\ArrayCollection;
        $log = new \Administration\Entity\Log;
        $this->entity->addLog($log);

        $collection->add($log);
        $this->assertEquals($collection, $this->entity->getLogs());

        $this->entity->removeLog($log);
        $collection->removeElement($log);
        $this->assertEquals($collection, $this->entity->getLogs());
    }

    public function testSetGetName() {
        $name = 'name';
        $this->entity->setName($name);

        $this->entityMock->expects($this->once())
                ->method('getName')
                ->will($this->returnValue($name));
        $this->assertEquals($this->entity->getName(), $this->entityMock->getName());
    }

    public function testSetGetDescription() {
        $description = 'description';
        $this->entity->setDescription($description);

        $this->entityMock->expects($this->once())
                ->method('getDescription')
                ->will($this->returnValue($description));
        $this->assertEquals($this->entity->getDescription(), $this->entityMock->getDescription());
    }

    public function testSetGetUrl() {
        $url = 'url';
        $this->entity->setUrl($url);

        $this->entityMock->expects($this->once())
                ->method('getUrl')
                ->will($this->returnValue($url));
        $this->assertEquals($this->entity->getUrl(), $this->entityMock->getUrl());
    }

    public function testSetGetThumb() {
        $thumb = 'thumb';
        $this->entity->setThumb($thumb);

        $this->entityMock->expects($this->once())
                ->method('getThumb')
                ->will($this->returnValue($thumb));
        $this->assertEquals($this->entity->getThumb(), $this->entityMock->getThumb());
    }

    public function testSetGetLikes() {
        $likes = 1;
        $this->entity->setLikes($likes);

        $this->entityMock->expects($this->once())
                ->method('getLikes')
                ->will($this->returnValue($likes));
        $this->assertEquals($this->entity->getLikes(), $this->entityMock->getLikes());
    }

    public function testSetGetSortOrder() {
        $sortOrder = 1;
        $this->entity->setSortOrder($sortOrder);

        $this->entityMock->expects($this->once())
                ->method('getSortOrder')
                ->will($this->returnValue($sortOrder));
        $this->assertEquals($this->entity->getSortOrder(), $this->entityMock->getSortOrder());
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
