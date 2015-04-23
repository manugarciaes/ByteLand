<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Restaurant
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ApiBundle\Entity\RestaurantsRepository")
 */
class Restaurant
{

    /**
     * @ORM\OneToMany(targetEntity="Reservation", mappedBy="restaurants")
     */
    protected $reservations;

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
     * @var integer
     *
     * @ORM\Column(name="maxPeople", type="integer")
     */
    private $maxPeople;


    public function __construct () {
        $this->reservations = new ArrayCollection();
    }
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
     * Set name
     *
     * @param string $name
     * @return Restaurants
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set maxPeople
     *
     * @param integer $maxPeople
     * @return Restaurants
     */
    public function setMaxPeople($maxPeople)
    {
        $this->maxPeople = $maxPeople;

        return $this;
    }

    /**
     * Get maxPeople
     *
     * @return integer 
     */
    public function getMaxPeople()
    {
        return $this->maxPeople;
    }

    /**
     * Add reservations
     *
     * @param \ApiBundle\Entity\Reservation $reservations
     * @return Restaurant
     */
    public function addReservation(\ApiBundle\Entity\Reservation $reservations)
    {
        $this->reservations[] = $reservations;

        return $this;
    }

    /**
     * Remove reservations
     *
     * @param \ApiBundle\Entity\Reservation $reservations
     */
    public function removeReservation(\ApiBundle\Entity\Reservation $reservations)
    {
        $this->reservations->removeElement($reservations);
    }

    /**
     * Get reservations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReservations()
    {
        return $this->reservations;
    }
}
