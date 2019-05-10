<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $first_name;

    /**
     * @ORM\Column(type="string")
     */
    protected $last_name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateUsers;

    /**
     * @ORM\OneToMany(targetEntity="Reading", mappedBy="users")
     */
    private $read;

    /**
     * @return mixed
     */
    public function getDateUsers()
    {
        return $this->dateUsers;
    }

    /**
     * @param mixed $dateUsers
     */
    public function setDateUsers($dateUsers)
    {
        $this->dateUsers = $dateUsers;
    }

    /**
     * @return mixed
     */
    public function getRead()
    {
        return $this->read;
    }

    /**
     * @param mixed $read
     */
    public function setRead($read)
    {
        $this->read = $read;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }



    public function __construct()
    {
        parent::__construct();
        // your own logic
    }


    /**
     * Add read
     *
     * @param \AppBundle\Entity\Reading $read
     *
     * @return User
     */
    public function addRead(\AppBundle\Entity\Reading $read)
    {
        $this->read[] = $read;

        return $this;
    }

    /**
     * Remove read
     *
     * @param \AppBundle\Entity\Reading $read
     */
    public function removeRead(\AppBundle\Entity\Reading $read)
    {
        $this->read->removeElement($read);
    }
}
