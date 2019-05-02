<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller

{
    /**
     * @Route("/cofon", name="cofon")
     */
    public function cofonAction()
    {
        return $this->render('cofon/home.html.twig');
    }

//    /**
//     * @Route("/cofon/connexion", name="cofonCnx")
//     */
//
//    public function cofonConnexion()
//    {
//        return $this->render('../FOSUserBundle/views/layout.html.twig');
//
//    }


}
