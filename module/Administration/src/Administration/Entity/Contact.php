<?php

namespace Administration\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contacts", indexes={@ORM\Index(name="email", columns={"email"})})
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class Contact {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255, nullable=false)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=32, nullable=false)
     */
    private $ip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
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
        $this->email = isset($data['email']) ? $data['email'] : null;
        $this->subject = isset($data['subject']) ? $data['subject'] : null;
        $this->message = isset($data['message']) ? $data['message'] : null;
        $remote = new \Zend\Http\PhpEnvironment\RemoteAddress;
        $this->ip = $remote->getIpAddress();
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
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     *
     * @param string $name
     * @return Contact
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     *
     * @param string $email
     * @return Contact
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getSubject() {
        return $this->subject;
    }

    /**
     *
     * @param string $subject
     * @return Contact
     */
    public function setSubject($subject) {
        $this->subject = $subject;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     *
     * @param string $message
     * @return Contact
     */
    public function setMessage($message) {
        $this->message = $message;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getIp() {
        return $this->ip;
    }

    /**
     *
     * @param string $ip
     * @return Contact
     */
    public function setIp($ip) {
        $this->ip = $ip;

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
     * @param \DateTime $createdAt
     * @return Contact
     */
    public function setCreatedAt(\DateTime $createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

}
