<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 2019-05-14
 * Time: 13:34
 */

namespace AppBundle\Controller\Admin;



use AppBundle\Entity\Reading;
use AppBundle\Form\ReadingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminReadingController extends Controller
{
    /**
     * @Route("cofon/reading/formSend", name="readingSend")
     */

    public function cofonReadingSend(Request $request){

//        $reading = new Reading();
//
////        méthode createForm pour prendre les informations de notre entity Reading
//        $readingform = $this->createForm(ReadingType::class, $reading);
//
////        j'utilise la méthode creatView pour faire le gabarit du formulaire HTML
//        $formCreateReading = $readingform->createView();
//
//        $readingform->handleRequest($request);
//
//
//        if ($readingform->isSubmitted() && $readingform->isValid()){
//
//            $reading = $readingform->getData();
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($reading);
//            $entityManager->flush();
//
//            var_dump('livre ajouté à votre bibliothèque');
//
//        }
////      je renvoi dans le fichier formulaire les éléments ainsi
//        return $this->render('cofon/form_create_reading.html.twig',
//            [
//                'formCreateReading' => $formCreateReading
//            ]
//        );
    }

}