<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 2019-05-23
 * Time: 13:46
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class AuthorRepository extends EntityRepository
{
    public function searchName($name)
    {

//        QueryBuilder est un outil qui permet de faire des requêtes SQL mais en Objet
        $qb = $this->createQueryBuilder('a');

        $query = $qb->select('a') //je prend tous les éléments de la table(entity) 'a' (donc Author)
        ->where('a.name = :name') //je sélectionne la colonne name de la table Author qui sera égale au paramètre name
        ->setParameter('name', $name) //je lui dire de remplacer name par $name (bindparam)
        ->orderBy('a.name', 'ASC' )
        ->getQuery();

        $name = $query->getArrayResult();

        var_dump($name); die;
    }

}