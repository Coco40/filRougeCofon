<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 2019-05-30
 * Time: 15:30
 */

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use AppBundle\Entity\BookType;
use AppBundle\Entity\Reading;
use AppBundle\Entity\StatusType;
use AppBundle\Form\AuthorType;
use AppBundle\Form\BookFormType;
use AppBundle\Form\ContactType;
use AppBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use OC\PlatformBundle\Form\AdvertType;
use Symfony\Component\HttpFoundation\Response;

class adminAuthorController extends Controller
{
    //*****   ROUTE POUR RAJOUTER UN AUTEUR  *****//
    /**
     * @Route("/admin/addAuthor", name="addAuthor")
     */
    public function formAddAuthor(Request $request)
    {
        $author = new Author();

//        méthode createForm pour prendre les informations de notre entity Author
        $authorform = $this->createForm(AuthorType::class, $author);

//        j'utilise la méthode creatView pour faire le gabarit du formulaire HTML
        $formAddAuthor = $authorform->createView();

        $authorform->handleRequest($request);

//        dump('coucou'); die;

        if ($authorform->isSubmitted() && $authorform->isValid()){

            $author = $authorform->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($author);
            $entityManager->flush();

            var_dump('auteur enregistré');
        }

//      je renvoi dans le fichier formulaire les éléments ainsi
        return $this->render('cofon/form_add_author.html.twig',
            [
                'formAddAuthor' => $formAddAuthor
            ]
        );
    }


}