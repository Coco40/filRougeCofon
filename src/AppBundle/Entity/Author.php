<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 2019-04-26
 * Time: 10:20
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="author")
 */

class Author
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
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $bio;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birthDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deathDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateAuthor;

    /**
     * @ORM\OneToMany(targetEntity="Book", mappedBy="author")
     */
    private $books;

    public function __construct() {
        $this->books = new ArrayCollection();
        $this->dateAuthor = new \DateTime('now');
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
     * Set name.
     *
     * @param string $name
     *
     * @return Author
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set bio.
     *
     * @param string $bio
     *
     * @return Author
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get bio.
     *
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set birthDate.
     *
     * @param \DateTime $birthDate
     *
     * @return Author
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate.
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set deathDate.
     *
     * @param \DateTime|null $deathDate
     *
     * @return Author
     */
    public function setDeathDate($deathDate = null)
    {
        $this->deathDate = $deathDate;

        return $this;
    }

    /**
     * Get deathDate.
     *
     * @return \DateTime|null
     */
    public function getDeathDate()
    {
        return $this->deathDate;
    }

    /**
     * Set dateAuthor.
     *
     * @param \DateTime $dateAuthor
     *
     * @return Author
     */
    public function setDateAuthor($dateAuthor)
    {
        $this->dateAuthor = $dateAuthor;

        return $this;
    }

    /**
     * Get dateAuthor.
     *
     * @return \DateTime
     */
    public function getDateAuthor()
    {
        return $this->dateAuthor;
    }

    /**
     * Add book.
     *
     * @param \AppBundle\Entity\Book $book
     *
     * @return Author
     */
    public function addBook(\AppBundle\Entity\Book $book)
    {
        $this->books[] = $book;

        return $this;
    }

    /**
     * Remove book.
     *
     * @param \AppBundle\Entity\Book $book
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeBook(\AppBundle\Entity\Book $book)
    {
        return $this->books->removeElement($book);
    }

    /**
     * Get books.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooks()
    {
        return $this->books;
    }
}
