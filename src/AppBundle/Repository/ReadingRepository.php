<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 2019-05-19
 * Time: 16:47
 */

namespace AppBundle\Repository;


class ReadingRepository extends \Doctrine\ORM\EntityRepository
{
    public function searchReadingByUser($user)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT r FROM AppBundle:Reading r
            WHERE r.user = :user'
            ) ->setParameter('user', $user);

        return $query->getResult();

    }

}