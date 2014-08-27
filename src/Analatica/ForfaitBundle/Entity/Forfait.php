<?php

namespace Analatica\ForfaitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Forfait
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Forfait
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", length=255)
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="nbruseragent", type="integer")
     */
    private $nbruseragent;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var date
     *
     * @ORM\Column(name="date_b", type="date",nullable=true)
     */
    private $dateB;

    /**
     * @var date
     *
     * @ORM\Column(name="date_f", type="date")
     */
    private $dateF;

    /**
     * @var text
     *
     * @ORM\Column(name="image", type="text")
     */
    private $image;

    /**
     * @param \Analatica\ForfaitBundle\Entity\date $dateB
     */
    public function setDateB($dateB)
    {
        $this->dateB = $dateB;
    }

    /**
     * @return \Analatica\ForfaitBundle\Entity\date
     */
    public function getDateB()
    {
        return $this->dateB;
    }

    /**
     * @param \Analatica\ForfaitBundle\Entity\date $dateF
     */
    public function setDateF($dateF)
    {
        $this->dateF = $dateF;
    }

    /**
     * @return \Analatica\ForfaitBundle\Entity\date
     */
    public function getDateF()
    {
        return $this->dateF;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * @param \Analatica\ForfaitBundle\Entity\text $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return \Analatica\ForfaitBundle\Entity\text
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param float $nbruseragent
     */
    public function setNbruseragent($nbruseragent)
    {
        $this->nbruseragent = $nbruseragent;
    }

    /**
     * @return float
     */
    public function getNbruseragent()
    {
        return $this->nbruseragent;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }


}
