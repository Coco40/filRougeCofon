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

class adminBookController extends Controller
{

//*****   ROUTE POUR RAJOUTER UN LIVRE *****//
    /**
     * @Route("/admin/addBook", name="addBook")
     */
    public function formAddBook(Request $request)
    {
        $book = new Book();
        $bookForm = $this->createForm(BookFormType::class, $book);
        $formAddBook = $bookForm->createView();
        $bookForm->handleRequest($request);
        $allAuthors = $this->getDoctrine()
            ->getRepository(Author::class)
//            ->findAll();
        ->findBy(array(), array('name' => 'asc'));

//        dump($allAuthors); die;

        if ($bookForm->isSubmitted() && $bookForm->isValid()){
//            je récupère l'image uploader par l'utilisateur
            $image = $book->getCover();
//             je génère un nom unique suivi de l'extension
            $imageName = md5(uniqid()).'.'.$image->guessExtension();
//            je deplace mon image dans un dossier en lui donnant le nom unique que j'ai créé
            try {
                $image->move(
//                    Autre méthode
//                    $request->getUriForPath('web/upload/images/book')
                    $this->getParameter('upload_images_book'),
                    $imageName
                );
//                si y'a une erreur dans l'upload, j'affiche l'erreur
            } catch (FileException $e) {
//                Je gère une exception s'il se passe quelque chose pendant le téléchargement
                throw new \Exception($e->getMessage());
            }
//            je remet dans mon entite qui sera sauvegardée en BDD le nom de l'image
            $book->setCover($imageName);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();

            var_dump('livre enregistré');
        }

//      je renvoi dans le fichier formulaire les éléments ainsi
        return $this->render('cofon/form_add_book.html.twig',
            [
                'formAddBook' => $formAddBook,
                'allAuthors' => $allAuthors
            ]
        );
    }



}