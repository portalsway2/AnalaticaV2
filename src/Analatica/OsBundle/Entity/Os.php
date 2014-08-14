<?php

namespace Analatica\OsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Os
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Os
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
     * @ORM\ManyToOne(targetEntity="Analatica\UserAgentBundle\Entity\UserAgent")
     * @@ORM\JoinColumn
     */
    private $idUserAgent;

    /**
     * @param int $idUserAgent
     */
    public function setIdUserAgent($idUserAgent)
    {
        $this->idUserAgent = $idUserAgent;
    }

    /**
     * @return int
     */
    public function getIdUserAgent()
    {
        return $this->idUserAgent;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="system", type="string", length=255)
     */
    private $system;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255)
     */
    private $version;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Set system
     *
     * @param string $system
     * @return Os
     */
    public function setSystem($system)
    {
        $this->system = $system;

        return $this;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * Get system
     *
     * @return string
     */
    public function getSystem()
    {
        return $this->system;
    }

    /**
     * Set version
     *
     * @param string $version
     * @return Os
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }
}