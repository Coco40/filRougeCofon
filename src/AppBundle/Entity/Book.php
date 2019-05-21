<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 2019-04-26
 * Time: 10:47
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="book")
 */

class Book
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
    private $title;

    /**
     * @ORM\Column(type="date")
     */
    private $year;

    /**
     * @ORM\Column(type="text")
     */
    private $synopsis;


    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $dateBook;

    /**
     * @ORM\Column(type="string")
     */
    private $cover;

    public function __construct()
    {
        $this->author = new ArrayCollection();
        $this->dateBook = new \DateTime();
    }

    /**
     * @ORM\ManyToOne(targetEntity="Author", inversedBy="books")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="BookType", inversedBy="books")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="Reading", mappedBy="book")
     */
    private $comment;



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
     * Set title.
     *
     * @param string $title
     *
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set year.
     *
     * @param string $year
     *
     * @return Book
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year.
     *
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set synopsis.
     *
     * @param string $synopsis
     *
     * @return Book
     */
    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * Get synopsis.
     *
     * @return string
     */
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * Set dateBook.
     *
     * @param \DateTime $dateBook
     *
     * @return Book
     */
    public function setDateBook($dateBook)
    {
        $this->dateBook = $dateBook;

        return $this;
    }

    /**
     * Get dateBook.
     *
     * @return \DateTime
     */
    public function getDateBook()
    {
        return $this->dateBook;
    }

    /**
     * Set cover.
     *
     * @param string $cover
     *
     * @return Book
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover.
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set author.
     *
     * @param \AppBundle\Entity\Author|null $author
     *
     * @return Book
     */
    public function setAuthor(\AppBundle\Entity\Author $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return \AppBundle\Entity\Author|null
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set type.
     *
     * @param \AppBundle\Entity\BookType|null $type
     *
     * @return Book
     */
    public function setType(\AppBundle\Entity\BookType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return \AppBundle\Entity\BookType|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add comment.
     *
     * @param \AppBundle\Entity\Reading $comment
     *
     * @return Book
     */
    public function addComment(\AppBundle\Entity\Reading $comment)
    {
        $this->comment[] = $comment;

        return $this;
    }

    /**
     * Remove comment.
     *
     * @param \AppBundle\Entity\Reading $comment
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeComment(\AppBundle\Entity\Reading $comment)
    {
        return $this->comment->removeElement($comment);
    }

    /**
     * Get comment.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComment()
    {
        return $this->comment;
    }
}
