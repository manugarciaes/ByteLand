<?php

namespace ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ApiBundle\Entity\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\ManyToOne(targetEntity="Restaurant", inversedBy="reservations")
     * @ORM\JoinColumn(name="restaurantId", referencedColumnName="id")
     */
    private $restaurants;

    /**
     * @ORM\ManyToMany(targetEntity="Customer", inversedBy="reservations")
     * @ORM\JoinColumn(name="customerId", referencedColumnName="id")
     */
    private $customers;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="customerId", type="integer")
     */
    private $customerId;

    /**
     * @var integer
     *
     * @ORM\Column(name="restaurantId", type="integer")
     */
    private $restaurantId;

    /***/

    public function __construct () {

        $this->customers = new ArrayCollection();
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
     * Set date
     *
     * @param \DateTime $date
     * @return Reservation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set customerId
     *
     * @param integer $customerId
     * @return Reservation
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return integer 
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set restaurantId
     *
     * @param integer $restaurantId
     * @return Reservation
     */
    public function setRestaurantId($restaurantId)
    {
        $this->restaurantId = $restaurantId;

        return $this;
    }

    /**
     * Get restaurantId
     *
     * @return integer 
     */
    public function getRestaurantId()
    {
        return $this->restaurantId;
    }

    /**
     * Set restaurants
     *
     * @param \ApiBundle\Entity\Restaurant $restaurants
     * @return Reservation
     */
    public function setRestaurants(\ApiBundle\Entity\Restaurant $restaurants = null)
    {
        $this->restaurants = $restaurants;

        return $this;
    }

    /**
     * Get restaurants
     *
     * @return \ApiBundle\Entity\Restaurant
     */
    public function getRestaurants()
    {
        return $this->restaurants;
    }


    /**
     * Add customers
     *
     * @param \ApiBundle\Entity\Customer $customers
     * @return Reservation
     */
    public function addCustomer(\ApiBundle\Entity\Customer $customers)
    {
        $this->customers[] = $customers;

        return $this;
    }

    /**
     * Remove customers
     *
     * @param \ApiBundle\Entity\Customer $customers
     */
    public function removeCustomer(\ApiBundle\Entity\Customer $customers)
    {
        $this->customers->removeElement($customers);
    }

    /**
     * Get customers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCustomers()
    {
        return $this->customers;
    }
}
