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
      $em = $this->getDoctrine()->getEntityManager();
      $tutorials = $em->getRepository('GuitarFeelingBundle:Tutorial')->findAll();
      
      return $this->render('GuitarFeelingBundle:Tutorial:index.html.twig', array('tutorials' => $tutorials));
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

   public function showAction($id)
   {
      $em = $this->getDoctrine()->getEntityManager();
      $tutorial = $em->getRepository('GuitarFeelingBundle:Tutorial')->find($id);
      if (!$tutorial)
         $this->createNotFoundException('Unable to find Tutorial entity.');
      
      return $this->render('GuitarFeelingBundle:Tutorial:show.html.twig', array('tutorial' => $tutorial));
   }
}
