<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 2019-04-26
 * Time: 11:11
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReadingRepository")
 * @ORM\Table(name="reading")
 */


class Reading
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateComment;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="read")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="comment")
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity="StatusType", inversedBy="status")
     */
    private $statusRead;

//    /**
//     * @ORM\OneToOne(targetEntity="StatusType")
//     */
//    private $statusReading;


    public function __construct()
    {
        $this->reading = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->book = new ArrayCollection();
        $this->dateComment = new \DateTime();
    }




    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateComment.
     *
     * @param \DateTime|null $dateComment
     *
     * @return Reading
     */
    public function setDateComment($dateComment = null)
    {
        $this->dateComment = $dateComment;

        return $this;
    }

    /**
     * Get dateComment.
     *
     * @return \DateTime|null
     */
    public function getDateComment()
    {
        return $this->dateComment;
    }

    /**
     * Set users.
     *
     * @param \AppBundle\Entity\User|null $users
     *
     * @return Reading
     */
    public function setUsers(\AppBundle\Entity\User $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users.
     *
     * @return \AppBundle\Entity\User|null
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set book.
     *
     * @param \AppBundle\Entity\Book|null $book
     *
     * @return Reading
     */
    public function setBook(\AppBundle\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book.
     *
     * @return \AppBundle\Entity\Book|null
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set statusRead.
     *
     * @param \AppBundle\Entity\StatusType|null $statusRead
     *
     * @return Reading
     */
    public function setStatusRead(\AppBundle\Entity\StatusType $statusRead = null)
    {
        $this->statusRead = $statusRead;

        return $this;
    }

    /**
     * Get statusRead.
     *
     * @return \AppBundle\Entity\StatusType|null
     */
    public function getStatusRead()
    {
        return $this->statusRead;
    }
}
