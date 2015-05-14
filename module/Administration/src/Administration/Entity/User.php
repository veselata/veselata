<?php

namespace Administration\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Crypt\Password\Bcrypt;

/**
 * User
 *
 * @ORM\Table(name="users", indexes={@ORM\Index(name="status", columns={"status"}),
 * @ORM\Index(name="username", columns={"username"})})
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class User {

    /**
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type = '0';

    /**
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status = '0';

    /**
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\PrePersist
     */
    function onPrePersist() {
        $this->createdAt = new \DateTime('now');
    }

    /**
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     *
     * @param string $name
     * @return User
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password) {
        $bcrypt = new Bcrypt();
        $this->password = $bcrypt->create($password);

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     *
     * @return boolean
     */
    public static function verifyPassword($password, $hash) {
        $bcrypt = new Bcrypt();
        return $bcrypt->verify($password, $hash);
    }

    /**
     *
     * @param integer $type
     * @return User
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getType() {
        return $this->type;
    }

    /**
     *
     * @param integer $status
     * @return User
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt(\DateTime $createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     *
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     *
     * @return array
     */
    public function getData() {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'username' => $this->getUsername(),
            'type' => \Administration\Model\Users::getTypeByKey($this->getType()),
            'status' => \Administration\Model\BaseModel::getStatusByKey($this->getStatus()),
        );
    }

}
