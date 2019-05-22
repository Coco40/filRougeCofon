<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 2019-05-07
 * Time: 15:32
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="statusType")
 */

class StatusType
{
    const AS_READ = 1;
    const READING = 2;
    const TO_READ = 3;
    const READ_STATUS =
        [
            self::AS_READ => 'Lu',
            self::READING => 'En cours',
            self::TO_READ => 'A lire'
        ];

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
     * @ORM\OneToMany(targetEntity="Reading", mappedBy="statusRead")
     */
    private $status;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->status = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return StatusType
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
     * Set status.
     *
     * @param \AppBundle\Entity\Reading|null $status
     *
     * @return StatusType
     */
    public function setStatus(\AppBundle\Entity\Reading $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return \AppBundle\Entity\Reading|null
     */
    public function getStatus()
    {
        return $this->status;
    }
}
