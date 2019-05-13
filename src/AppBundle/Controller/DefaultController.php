<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use AppBundle\Entity\BookType;
use AppBundle\Entity\Reading;
use AppBundle\Entity\StatusType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller

{
//*****   ROUTE POUR LA PAGE D'ACCUEIL   *****//
    /**
     * @Route("/cofon", name="cofon")
     */
    public function cofonAction()
    {
        return $this->render('cofon/home.html.twig');
    }

    /**
     * @Route("/cofon/connexion", name="cofonCnx")
     */
    public function cofonConnexion()
    {
        return $this->render('cofon/cnx.html.twig');

    }

//*****   ROUTE POUR LA PAGE LORSQUE L'ON VIENT DE SE CONNECTER  *****//
    /**
     * @Route("/cofon/personal", name="personal")
     */
    public function cofonPersonal()
    {
        $viewAllCategory = $this->getDoctrine()
            ->getRepository(BookType::class)
            ->findAll();
        $allBooks = $this->getDoctrine()
            ->getRepository(Book::class)
            ->findAll();
        $allAuthors = $this->getDoctrine()
            ->getRepository(Author::class)
            ->findAll();
        $allStatus = $this->getDoctrine()
            ->getRepository(StatusType::class)
            ->findAll();
        $allReading = $this->getDoctrine()
            ->getRepository(Reading::class)
            ->findAll();

//        dump($allBooks, $allReading); die;

        return $this->render('cofon/firstCnx.html.twig',
            [
                'viewAllCategory' => $viewAllCategory,
                'allBooks' => $allBooks,
                'allAuthor' => $allAuthors,
                'allStatus' => $allStatus,
                'allReading' => $allReading,
            ]
        );
    }

    //*****   ROUTE POUR TOUS LES STATUS  *****//
//    /**
//     * @Route("/cofon/status", name="status")
//     */
//    public function cofonStatus()
//    {
//        $allStatus = $this->getDoctrine()
//        ->getRepository(StatusType::class)
//        ->findAll();
//
//        return $this->render('cofon/allStatus.html.twig',
//       [
//           'allStatus' => $allStatus,
//        ]
//            );
//    }

//*****   ROUTE POUR TOUTES LES CATEGORIES   *****//
//    /**
//     * @Route("/cofon/category", name="category")
//     */
//    public function cofonCategory()
//    {
//        $allCategory = $this->getDoctrine()
//        ->getRepository(BookType::class)
//        ->findAll();
//
//        return $this->render('cofon/allCategory.html.twig',
//       [
//           'allCategory' => $allCategory,
//        ]
//            );
//    }
//
//*****   ROUTE POUR TOUS LES LIVRES   *****//
//    /**
//     * @Route("/cofon/books", name="books")
//     */
//    public function cofonBooks()
//    {
//        $allBooks = $this->getDoctrine()
//            ->getRepository(Book::class)
//            ->findAll();
//
//        return $this->render('cofon/allBooks.html.twig',
//        [
//            'allBooks' => $allBooks,
//        ]
//             );
//    }

//*****   ROUTE POUR TOUS LES AUTEURS   *****//
//    /**
//     * @Route("/cofon/authors", name="authors")
//     */
//    public function cofonAuthors()
//    {
//        $allBooks = $this->getDoctrine()
//            ->getRepository(Author::class)
//            ->findAll();
//
//        return $this->render('cofon/allAuthors.html.twig',
//        [
//            'allAuthors' => $allAuthors,
//        ]
//             );
//    }

//*****   ROUTE POUR TOUS LES COMMENTAIRES NOTES (READING)  *****//
    /**
     * @Route("/cofon/reading", name="reading")
     */
    public function cofonReading()
    {
        $allReading = $this->getDoctrine()
            ->getRepository(Reading::class)
            ->findAll();

//        dump($allReading); die;

        return $this->render('cofon/allReading.html.twig',
        [
            'allReading' => $allReading,
        ]
             );
    }


//*****   ROUTE POUR UN LIVRE   *****//
    /**
     * @Route("/cofon/book/{id}", name="oneBook")
     */
    public function cofonOneBook($id)
    {
        $oneBook = $this->getDoctrine()
            ->getRepository(Book::class)
            ->find($id);

        return $this->render('cofon/firstCnx.html.twig',
            [
                'oneBook' => $oneBook,
                'id' => $id,

            ]);
    }

//*****   ROUTE POUR UN AUTEUR   *****//
    /**
     * @Route("/cofon/author/{id}", name="oneAuthor")
     */
    public function cofonOneAuthor($id)
    {
        $oneAuthor = $this->getDoctrine()
            ->getRepository(Author::class)
            ->find($id);

        return $this->render('cofon/firstCnx.html.twig',
            [
                'oneAuthor' => $oneAuthor,
                'id' => $id,
            ]
        );
    }

//*****   ROUTE MES LIVRES POUR UN UTILISATEUR CONNECTE  *****//

    /**
     * @Route("/cofon/myBooks", name="myBooks")
     */

    public function cofonMyBooks()
    {
        return $this->render('cofon/myBooks.html.twig');
    }

}
