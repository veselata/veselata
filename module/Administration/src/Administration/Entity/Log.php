<?php

namespace Administration\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Log
 *
 * @ORM\Table(name="logs", indexes={
 * @ORM\Index(name="ip", columns={"ip"}),
 * @ORM\Index(name="is_blocked", columns={"is_blocked"}),
 * @ORM\Index(name="is_track", columns={"is_track"}),
 * @ORM\Index(name="item_id", columns={"item_id"}),
 * })
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class Log {

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
     * @ORM\Column(name="ip", type="string", length=32, nullable=false)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="extra", type="text")
     */
    private $extra;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_blocked", type="boolean")
     */
    private $isBlocked = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_track", type="boolean")
     */
    private $isTrack = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="item_id", type="integer")
     */
    private $itemId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="id")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     * */
    private $project;

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
        $this->ip = isset($data['ip']) ? $data['ip'] : null;
        $this->extra = isset($data['extra']) ? $data['extra'] : null;
        $this->isBlocked = isset($data['isBlocked']) ? $data['isBlocked'] : 0;
        $this->isTrack = isset($data['isTrack']) ? $data['isTrack'] : 0;
    }

    public function addProject(\Administration\Entity\Project $project) {
        $this->project = $project;

        return $this;
    }

    /**
     *
     * @return Administration\Entity\Project
     */
    public function getProject() {
        return $this->project;
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
    public function getIp() {
        return $this->ip;
    }

    /**
     *
     * @param string $ip
     * @return Log
     */
    public function setIp($ip) {
        $this->ip = $ip;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getExtra() {
        return $this->extra;
    }

    /**
     *
     * @param string $extra
     * @return Log
     */
    public function setExtra($extra) {
        $this->extra = $extra;

        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function getIsBlocked() {
        return $this->isBlocked;
    }

    /**
     *
     * @param boolean $isBlocked
     * @return Log
     */
    public function setIsBlocked($isBlocked) {
        $this->isBlocked = $isBlocked;

        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function getIsTrack() {
        return $this->isTrack;
    }

    /**
     *
     * @param boolean $isTrack
     * @return Log
     */
    public function setIsTrack($isTrack) {
        $this->isTrack = $isTrack;

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
     * @return Log
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

}
