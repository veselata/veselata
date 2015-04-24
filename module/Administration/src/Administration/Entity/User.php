<?php

namespace Administration\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Crypt\Password\Bcrypt;

/**
 * User
 *
 * @ORM\Table(name="users", indexes={@ORM\Index(name="is_active", columns={"is_active"}),
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
     * @ORM\Column(name="account_type", type="integer", nullable=false)
     */
    private $accountType = '0';

    /**
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive = '0';

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
     * @param array
     */
    public function exchangeArray(array $data) {
        $this->name = isset($data['name']) ? $data['name'] : null;
        $this->username = isset($data['username']) ? $data['username'] : null;
        $this->accountType = isset($data['accountType']) ? $data['accountType'] : 0;
        $this->isActive = isset($data['isActive']) ? $data['isActive'] : 0;
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
     * @param integer $accountType
     * @return User
     */
    public function setAccountType($accountType) {
        $this->accountType = $accountType;

        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getAccountType() {
        return $this->accountType;
    }

    /**
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive) {
        $this->isActive = (boolean) $isActive;

        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function getIsActive() {
        return $this->isActive;
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

}
