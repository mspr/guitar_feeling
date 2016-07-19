<?php

namespace GuitarFeelingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GuitarFeelingBundle\Entity\Tutorial;
use GuitarFeelingBundle\Form\TutorialType;
use Symfony\Component\HttpFoundation\Request;

class TutorialController extends Controller
{
      public function indexAction()
      {
         return $this->render('GuitarFeelingBundle:Tutorial:index.html.twig');
      }

      public function newAction(Request $request)
      {
         $tutorial = new Tutorial();
         
         $form = $this->createForm(TutorialType::class, $tutorial);
         
         $form->handleRequest($request);
         if ($form->isValid())
         {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tutorial);
            $em->flush();
            
            $request->getSession()->getFlashBag()->add('notice', 'Tutorial created.');
         
            return $this->redirect($this->generateUrl('guitar_feeling_tutorials_show', array('id' => $tutorial->getId())));
         }
         
         return $this->render('GuitarFeelingBundle:Tutorial:new.html.twig', array('form' => $form->createView()));
      }

      public function showAction()
      {
         return $this->render('GuitarFeelingBundle:Tutorial:show.html.twig');
      }
}
