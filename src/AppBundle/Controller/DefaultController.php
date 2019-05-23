<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use AppBundle\Entity\BookType;
use AppBundle\Entity\Reading;
use AppBundle\Entity\StatusType;
use AppBundle\Form\AuthorType;
use AppBundle\Form\BookFormType;
use AppBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use OC\PlatformBundle\Form\AdvertType;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller

{
//*****   ROUTE POUR LA PAGE D'ACCUEIL   *****//
    /**
     * @Route("/", name="cofon")
     */
    public function cofonAction()
    {
        $allReading = $this->getDoctrine()
            ->getRepository(Reading::class)
            ->findBy(
                array('statusRead' => '1'),
                array('dateComment' => 'desc'),
                6,
                0
            );

        $maxReading = $this->getDoctrine()
            ->getRepository(Reading::class)
            ->searchMaxReading(
                [],
                [],
                6,
                0
            );

        $idLivreMax1 = $maxReading[0][1];
        $idLivreMax2 = $maxReading[1][1];
        $idLivreMax3 = $maxReading[2][1];
        $idLivreMax4 = $maxReading[3][1];
        $idLivreMax5 = $maxReading[4][1];
        $idLivreMax6 = $maxReading[5][1];

        $bookRepository = $this->getDoctrine()->getRepository(Book::class);

        $maxBook1 = $bookRepository->find($idLivreMax1);
        $maxBook2 = $bookRepository->find($idLivreMax2);
        $maxBook3 = $bookRepository->find($idLivreMax3);
        $maxBook4 = $bookRepository->find($idLivreMax4);
        $maxBook5 = $bookRepository->find($idLivreMax5);
        $maxBook6 = $bookRepository->find($idLivreMax6);


        return $this->render('cofon/home.html.twig',
            [
                'maxBook1' => $maxBook1,
                'maxBook2' => $maxBook2,
                'maxBook3' => $maxBook3,
                'maxBook4' => $maxBook4,
                'maxBook5' => $maxBook5,
                'maxBook6' => $maxBook6,
//                'maxReadind' => $maxReading,
                'allReading' => $allReading,
            ]
        );
    }

    /**
     * @Route("/cofon/connexion", name="cofonCnx")
     */
    public function cofonConnexion()
    {
        return $this->render('cofon/cnx.html.twig');

    }

//*****   ROUTE POUR LA PAGE LORSQUE L'ON VIENT DE SE CONNECTER SUR SON ESPACE PERSONNEL (MES LVRES) *****//
    /**
     * @Route("/cofon/personal", name="personal")
     */
    public function cofonPersonal(Request $request)
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

//        $allReading = $this->getDoctrine()
//            ->getRepository(Reading::class)
//            ->findAll();

//        dump($allBooks, $allReading); die;

        return $this->render('cofon/firstCnx.html.twig',
            [
                'viewAllCategory' => $viewAllCategory,
                'allBooks' => $allBooks,
                'allAuthor' => $allAuthors,
                'allStatus' => StatusType::READ_STATUS,
//                'allReading' => $allReading,
            ]
        );
    }


    /**
     * @Route("/cofon/status/reading", name="cofon_status_reading")
     */
    public function cofonStatusReadingAction(Request $request)
    {

        $bookId = $request->request->get('submit');

        $user = $this->getUser();
        $userId = $user->getId();

        $readingRepository = $this->getDoctrine()->getRepository(Reading::class);
        $reading = $readingRepository->findBy(['book' => $bookId, 'users' => $userId]);

        if(empty($reading))
        {
            $reading = new Reading();

        }
        else{
            $reading = $reading['0'];
        }


        $statusChoice = $request->request->get('statusChoice');

        $bookRepository = $this->getDoctrine()->getRepository(Book::class);
        $book = $bookRepository->find($bookId);

        $statusRepository = $this->getDoctrine()->getRepository(StatusType::class);
        $status = $statusRepository->find($statusChoice);

//        dump($status);die;

        $reading->setUsers($user);
        $reading->setStatusRead($status);
        $reading->setBook($book);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($reading);
        $entityManager->flush();


//        return new Response('livre enregistré ');

        return $this->redirectToRoute('personal');


    }



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
        $user = $this->getUser();
        $userId = $user->getId();

        $lastASReadUser = $this->getDoctrine()
            ->getRepository(Reading::class)
            ->findBy(
                array('statusRead' => '1', 'users' => $userId),
                array('dateComment' => 'desc'),
                1,
                0
            );

        $lastReadingUser = $this->getDoctrine()
            ->getRepository(Reading::class)
            ->findBy(
                array('statusRead' => '2' , 'users' => $userId),
                array('dateComment' => 'desc'),
                1,
                0
            );

        $lastToReadUser = $this->getDoctrine()
            ->getRepository(Reading::class)
            ->findBy(
                array('statusRead' => '3', 'users' => $userId),
                array('dateComment' => 'desc'),
                1,
                0
            );

//        dump($lastASReadUser); die;

        return $this->render('cofon/myBooks.html.twig',
            [
                'lastASReadUser' => $lastASReadUser,
                'lastReadingUser' => $lastReadingUser,
                'lastToReadUser' => $lastToReadUser,
                'user' => $user,

            ]);
    }

//*****   ROUTE MES LIVRES LUS POUR UN UTILISATEUR CONNECTE  *****//

    /**
     * @Route("/cofon/myBooksAsRead", name="myBooksAsRead")
     */

    public function cofonMyBooksAsRead(){

        $user = $this->getUser();
        $userId = $user->getId();

        $allASReadUser = $this->getDoctrine()
            ->getRepository(Reading::class)
            ->findBy(
                array('statusRead' => '1', 'users' => $userId),
                array('dateComment' => 'desc')
            );

//        dump($allASReadUser);die;

        return $this->render('cofon/myBooksAsRead.html.twig',
            [
                'allASReadUser' => $allASReadUser,
            ]);
    }

//*****   ROUTE MES LIVRES EN COURS POUR UN UTILISATEUR CONNECTE  *****//

    /**
     * @Route("/cofon/myBooksReading", name="myBooksReading")
     */

    public function cofonMyBooksReading(){

        $user = $this->getUser();
        $userId = $user->getId();

        $allReadingUser = $this->getDoctrine()
            ->getRepository(Reading::class)
            ->findBy(
                array('statusRead' => '2', 'users' => $userId),
                array('dateComment' => 'desc')
            );

        return $this->render('cofon/myBooksReading.html.twig',
            [
                'allReadingUser' => $allReadingUser,
            ]);
    }


//*****   ROUTE MES LIVRES A LIRE POUR UN UTILISATEUR CONNECTE  *****//

    /**
     * @Route("/cofon/myBooksToRead", name="myBooksToRead")
     */

    public function cofonMyBooksToRead(){

        $user = $this->getUser();
        $userId = $user->getId();

        $allToReadUser = $this->getDoctrine()
            ->getRepository(Reading::class)
            ->findBy(
                array('statusRead' => '3', 'users' => $userId),
                array('dateComment' => 'desc')
            );


        return $this->render('cofon/myBooksToRead.html.twig',
            [
                'allToReadUser' => $allToReadUser,
            ]);
    }

//*****   ROUTE POUR SUPPRIMER UN LIVRE POUR UN UTILISATEUR CONNECTE  *****//

    /**
     * @Route("/cofon/myBooksAsRead/{id}", name="readingDelete")
     */
    public function bookDeleteAction($id)
    {

        $deleteReading = $this->getDoctrine()
            ->getRepository(Reading::class)
            ->find($id);

//        dump($deleteReading); die;

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($deleteReading);
        $entityManager->flush();

        return $this->render('cofon/book_delete.html.twig');
    }

//*****   ROUTE POUR FAIRE UNE RECHERCHE PAR NOM D'AUTEUR  *****//
    /**
     * Je crée une route pour faire une recherche sur le nom d'un auteur avec la wild Card name
     * @Route("/author_search/{name}", name="authorSearch")
     */
//    Je crée l'action authorSearchByName avec la variable $name qui récupère l'information de la wildCard
    public function authorSearchByName($name)
    {
//        je récupère Doctrine avec la méthode getDoctrine, puis je récupère le repository avec la méthode get Repository
//        Je lui donne le chemin pour l'entity author via la methode class
//        Je le stocke dans la variable $nameAuthor
        $nameAuthor = $this->getDoctrine()
            ->getRepository(Author::class);

//        J'utilise la méthode authorSearchByName créé depuis le repository author avec $name récupéré de la wildCard
        $result = $nameAuthor->authorSearchByName($name);

        dump($result); die;

    }

//*****   ROUTE POUR LES MENTIONS LEGALES  *****//

    /**
     * @Route("/cofon/mentionsLegales", name="mentionsLegales")
     */

    public function cofonMentionsLegales()
    {
        return $this->render('cofon/mentionsLegales.html.twig');
    }

    //*****   ROUTE POUR CONTACT *****//
    /**
     * @Route("/cofon/contact", name="contact")
     */

    public function contactAction(Request $request)
    {
        // Create the form according to the FormType created previously.
        // And give the proper parameters
        $form = $this->createForm(ContactType::class,null,array(
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $this->generateUrl('myapplication_contact'),
            'method' => 'POST'
        ));

        if ($request->isMethod('POST')) {
            // Refill the fields in case the form is not valid.
            $form->handleRequest($request);

            if($form->isValid()){
                // Send mail
                if($this->sendEmail($form->getData())){

                    // Everything OK, redirect to wherever you want ! :

                    return $this->redirectToRoute('redirect_to_somewhere_now');
                }else{
                    // An error ocurred, handle
                    var_dump("Errooooor :(");
                }
            }
        }

        return $this->render('cofon/contact.html.twig', array(
            'form' => $form->createView()
        ));
    }

    private function sendEmail($data){
        $myappContactMail = 'mycontactmail@mymail.com';
        $myappContactPassword = 'yourmailpassword';

        // In this case we'll use the ZOHO mail services.
        // If your service is another, then read the following article to know which smpt code to use and which port
        // http://ourcodeworld.com/articles/read/14/swiftmailer-send-mails-from-php-easily-and-effortlessly
        $transport = \Swift_SmtpTransport::newInstance('smtp.zoho.com', 465,'ssl')
            ->setUsername($myappContactMail)
            ->setPassword($myappContactPassword);

        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance("Our Code World Contact Form ". $data["subject"])
            ->setFrom(array($myappContactMail => "Message by ".$data["name"]))
            ->setTo(array(
                $myappContactMail => $myappContactMail
            ))
            ->setBody($data["message"]."<br>ContactMail :".$data["email"]);

        return $mailer->send($message);
    }


//*****   ROUTE POUR UNE CATEGORIE  *****//
    /**
     * @Route("/cofon/category/{id}", name="category")
     */
    public function cofonCategory($id)
    {
        $booksByCategory = $this->getDoctrine()
            ->getRepository(Book::class)
            ->findBy(array('type' => $id));

        $viewAllCategory = $this->getDoctrine()
            ->getRepository(BookType::class)
            ->findAll();


        return $this->render('cofon/oneCategory.html.twig',
       [
           'viewAllCategory' => $viewAllCategory,
           'booksByCategory' => $booksByCategory,
           'id' => $id,
        ]
            );
    }

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
            ->findAll();


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
//                 ... handle exception if something happens during file upload
                throw new \Exception($e->getMessage());
            }
//            je remet dans mon entite (qui sera sauvegardée en BDD le nom de l'image
            $book->setCover($imageName);
//            $book = $bookForm->getData();
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
