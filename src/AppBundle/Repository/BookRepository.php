<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 2019-05-16
 * Time: 17:10
 */

namespace AppBundle\Repository;


class BookRepository extends \Doctrine\ORM\EntityRepository
{
    // création d'une nouvelle méthode du repository de Book
    // pour récupérer un ou plusieurs livres
    // en fonction de la category
    // quand je créé une méthode dans cette classe,
    // je peux l'appeler depuis mon controleur, en
    // utilisant $this->getDoctrine()->getRepository(Book::Class)

    public function findByType($type_id)
{
    $query = $this->getEntityManager()
        ->createQuery(
            'SELECT b, t FROM AppBundle:Book b
            JOIN b.BookType t
            WHERE b.id = :id'
        ) ->setParameter('id', $type_id);

    return $query->getResult();

}

}