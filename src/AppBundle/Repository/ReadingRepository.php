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

    public function searchMaxReading($limit)
    {
        $qb = $this->createQueryBuilder('r');

        $qb->select('b.title, b.cover, COUNT(r.users) AS count')
            ->innerJoin('r.book', 'b')
            ->where('r.statusRead = 1')
            ->groupBy('r.book')
            ->orderBy('COUNT(r.users)', 'DESC')
            ->setMaxResults($limit);


        return $qb->getQuery()->getResult();


//        SELECT book_id, COUNT(user_id)
//                FROM reading
//                WHERE status_read_id = 1
//                GROUP BY book_id
//                ORDER BY COUNT(user_id) DESC);


    }
}