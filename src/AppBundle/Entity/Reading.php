<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 2019-04-26
 * Time: 11:11
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
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
     * @ORM\Column(type="string")
     */
    private $note;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateComment;

    /**
     * @ORM\OneToOne(targetEntity="StatusType")
     */
    private $statusReading;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="read")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="comment")
     */
    private $book;

    /**
     * ORM\OneToOne(targetEntity="StatusType")
     */
    private $statusType;

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
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getDateComment()
    {
        return $this->dateComment;
    }

    /**
     * @param mixed $dateComment
     */
    public function setDateComment($dateComment)
    {
        $this->dateComment = $dateComment;
    }

    /**
     * @return mixed
     */
    public function getStatusReading()
    {
        return $this->statusReading;
    }

    /**
     * @param mixed $statusReading
     */
    public function setStatusReading($statusReading)
    {
        $this->statusReading = $statusReading;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     * @return mixed
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * @param mixed $book
     */
    public function setBook($book)
    {
        $this->book = $book;
    }

    /**
     * @return mixed
     */
    public function getStatusType()
    {
        return $this->statusType;
    }

    /**
     * @param mixed $statusType
     */
    public function setStatusType($statusType)
    {
        $this->statusType = $statusType;
    }



}