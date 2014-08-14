<?php

namespace Analatica\UserAgentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserAgent
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class UserAgent
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Analatica\UserBundle\Entity\User")
     * @@ORM\JoinColumn
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="user_agent", type="string", length=255)
     */
    private $userAgent;



    /**
     * @var date
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;


    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255)
     */
    private $ip;

    /**
     * @param \Analatica\UserAgentBundle\Entity\date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return \Analatica\UserAgentBundle\Entity\date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }





}