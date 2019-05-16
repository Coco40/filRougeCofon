<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use AppBundle\Entity\BookType;
use AppBundle\Entity\Reading;
use AppBundle\Entity\StatusType;
use AppBundle\Form\ContactType;
use AppBundle\Form\ReadingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use OC\PlatformBundle\Form\AdvertType;
use Symfony\Component\HttpFoundation\Response;

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

//        $post = $request->request;
//
//        dump($post); die;

        $reading = new Reading();

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($reading);
        $entityManager->flush();

        if(!empty($_POST['statusChoice']))
        {
            if($this->getUser())
            {
                $user = $this->getUser();
                $bookId = $request->request->get('submit');
                $statusChoice = $request->request->get('statusChoice');

            }

            $reading->getId();
            $user->getId();

            return new Response('livre enregistré ');

        }

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


//*****   RECUPERATION DES LIVRES /STATUS / USER POUR LA BDD  *****//



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


//*****   ROUTE POUR UNE CATEGORIES  *****//
    /**
     * @Route("/cofon/category/{id}", name="category")
     */
    public function cofonCategory($id)
    {
        $oneCategory = $this->getDoctrine()
        ->getRepository(BookType::class)
        ->find($id);

        $allBooks = $this->getDoctrine()
            ->getRepository(Book::class)
            ->findBy(array('id'));


        $viewAllCategory = $this->getDoctrine()
            ->getRepository(BookType::class)
            ->findAll();



        dump($allBooks); die;

//        return $this->render('cofon/oneCategory.html.twig',
//       [
//           'oneCategory' => $oneCategory,
//           'viewAllCategory' => $viewAllCategory,
//           'booksByCategory' => $booksByCategory,
//           'id' => $id,
//        ]
//            );
    }


}
