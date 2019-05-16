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

    public function searchByCategory($type_id)
{
    //        QueryBuilder est un outil qui permet de faire des requêtes SQL mais en Objet
    $qb = $this->createQueryBuilder('b');

    $query = $qb->select('b') //je prend tous les éléments de la table(entity) 'b' (donc Book)
    ->where('b.type_id = :id') //je sélectionne la colonne type_id de la table Book qui sera égale au paramètre id
    ->setParameter('type_id', $type_id) //je lui dire de remplacer lastName par $lastName (bindparam)
    ->getQuery();
d
    $results = $query->getArrayResult();

    var_dump($results); die;

}

}