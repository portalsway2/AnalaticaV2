<?php

namespace Analatica\NavigateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Navigateur
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Navigateur
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
     * @var string
     *
     * @ORM\Column(name="navigateur", type="string", length=255)
     */
    private $navigateur;

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
     * Set idUserAgent
     *
     * @param integer $idUserAgent
     * @return Navigateur
     */
    public function setIdUserAgent($idUserAgent)
    {
        $this->idUserAgent = $idUserAgent;

        return $this;
    }

    /**
     * Get idUserAgent
     *
     * @return integer
     */
    public function getIdUserAgent()
    {
        return $this->idUserAgent;
    }

    /**
     * Set navigateur
     *
     * @param string $navigateur
     * @return Navigateur
     */
    public function setNavigateur($navigateur)
    {
        $this->navigateur = $navigateur;

        return $this;
    }

    /**
     * Get navigateur
     *
     * @return string
     */
    public function getNavigateur()
    {
        return $this->navigateur;
    }

    /**
     * Set version
     *
     * @param string $version
     * @return Navigateur
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