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

class adminUserController extends Controller
{

    //*****   ROUTE POUR RENVOYER UN UTILISATEUR QUI VIENT DE S'INSCRIRE  *****//

    /**
     * @Route("/register/confirmed", name="confirmed")
     */
    public function cofonConfirmed()
    {
        return $this ->redirectToRoute('personal');
    }

    //*****   ROUTE POUR RENVOYER L'ADMIN SUR SON BACK OFFICE   *****//

//    /**
//     * @Route("/login/{id}", name="adminBO")
//     */
//    public function cofonAdminBO($id)
//    {
//        $user = $this->getUser();
//        $userRole = $user->getRole();
//
//        if ($userRole = 'ADMIN'){
//
//        return $this ->redirectToRoute('addBook');
//
//        }
//    }

}