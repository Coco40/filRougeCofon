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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}
