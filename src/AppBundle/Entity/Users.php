<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 2019-04-26
 * Time: 11:05
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */

class Users
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $firstNameUsers;

    /**
     * @ORM\Column(type="string")
     */
    private $lastNameUsers;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstNameUsers()
    {
        return $this->firstNameUsers;
    }

    /**
     * @param mixed $firstNameUsers
     */
    public function setFirstNameUsers($firstNameUsers)
    {
        $this->firstNameUsers = $firstNameUsers;
    }

    /**
     * @return mixed
     */
    public function getLastNameUsers()
    {
        return $this->lastNameUsers;
    }

    /**
     * @param mixed $lastNameUsers
     */
    public function setLastNameUsers($lastNameUsers)
    {
        $this->lastNameUsers = $lastNameUsers;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

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

}