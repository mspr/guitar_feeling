<?php

namespace GuitarFeelingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GuitarFeelingBundle\Entity\Tutorial;
use GuitarFeelingBundle\Form\TutorialType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;

class TutorialController extends Controller
{
   public function indexAction()
   {
      $em = $this->getDoctrine()->getEntityManager();
      $tutorials = $em->getRepository('GuitarFeelingBundle:Tutorial')->findAll();
      $levels = $em->getRepository('GuitarFeelingBundle:TutorialLevel')->findAll();
      
      foreach ($tutorials as $tutorial)
      {
         $delete_forms[$tutorial->getId()] = $this->createDeleteForm($tutorial->getId())->createView();
      }
      
      return $this->render('GuitarFeelingBundle:Tutorial:index.html.twig', array('tutorials' => $tutorials, 'levels' => $levels, 'delete_forms' => $delete_forms));
   }

   public function newAction()
   {
      $tutorial = new Tutorial();
      
      $em = $this->getDoctrine()->getEntityManager();
      $levels = $em->getRepository('GuitarFeelingBundle:TutorialLevel')->findAll();
      
      $form = $this->createForm(TutorialType::class, $tutorial, array('action' => $this->generateUrl('guitar_feeling_tutorials_create')));
      
      return $this->render('GuitarFeelingBundle:Tutorial:new.html.twig', array('tutorial' => $tutorial, 'levels' => $levels, 'form' => $form->createView()));
   }

   public function createAction(Request $request)
   {
      $tutorial = new Tutorial();
      
      $form = $this->createForm(TutorialType::class, $tutorial, array('action' => $this->generateUrl('guitar_feeling_tutorials_create')));
      $form->handleRequest($request);
      
      if ($form->isValid())
      {
         $em = $this->getDoctrine()->getManager();
         
         $picture = $tutorial->getPicture();
         $fileName = md5(uniqid()).'.'.$picture->guessExtension();
         $picture->move($this->getParameter('tutorials_pictures_directory'), $fileName);
         $tutorial->setPicture($fileName);
         
         $em->persist($tutorial);
         $em->flush();
         
         $request->getSession()->getFlashBag()->add('notice', 'Tutorial created.');
         
         return $this->redirect($this->generateUrl('guitar_feeling_tutorials_show', array('id' => $tutorial->getId())));
      }
      
      return $this->render('GuitarFeelingBundle:Tutorial:new.html.twig', array('tutorial' => $tutorial, 'form' => $form->createView()));
   }
   
   public function showAction($id)
   {
      $em = $this->getDoctrine()->getEntityManager();
      $tutorial = $em->getRepository('GuitarFeelingBundle:Tutorial')->find($id);
      if (!$tutorial)
         $this->createNotFoundException('Unable to find Tutorial entity.');
      
      return $this->render('GuitarFeelingBundle:Tutorial:show.html.twig', array('tutorial' => $tutorial));
   }
   
   public function editAction($id)
   {
      $em = $this->getDoctrine()->getEntityManager();
      $tutorial = $em->getRepository('GuitarFeelingBundle:Tutorial')->find($id);
      if (!$tutorial)
         $this->createNotFoundException('Unable to find Tutorial entity.');
      
      $levels = $em->getRepository('GuitarFeelingBundle:TutorialLevel')->findAll();
      
      $form = $this->createForm(TutorialType::class, $tutorial, array('action' => $this->generateUrl('guitar_feeling_tutorials_update', array('id' => $id))));
      
      return $this->render('GuitarFeelingBundle:Tutorial:edit.html.twig', array('tutorial' => $tutorial, 'levels' => $levels, 'form' => $form->createView()));
   }
   
   public function updateAction($id, Request $request)
   {
      $em = $this->getDoctrine()->getEntityManager();
      $tutorial = $em->getRepository('GuitarFeelingBundle:Tutorial')->find($id);
      if (!$tutorial)
         $this->createNotFoundException('Unable to find Tutorial entity.');
      
      $form = $this->createForm(TutorialType::class, $tutorial, array('action' => $this->generateUrl('guitar_feeling_tutorials_update', array('id' => $id))));
      $form->handleRequest($request);
      
      if ($form->isValid())
      {
         $em->persist($tutorial);
         $em->flush();
         
         return $this->redirect($this->generateUrl('guitar_feeling_tutorials_show', array('id' => $id)));
      }
      
      return $this->render('GuitarFeelingBundle:Tutorial:edit.html.twig', array('tutorial' => $tutorial, 'form' => $form->createView()));
   }
   
   public function deleteAction($id, Request $request)
   {
      $form = $this->createDeleteForm($id);
      $form->handleRequest($request);
      
      if ($form->isValid())
      {
         $em = $this->getDoctrine()->getEntityManager();
         $tutorial = $em->getRepository('GuitarFeelingBundle:Tutorial')->find($id);
         if (!$tutorial)
            $this->createNotFoundException('Unable to find Tutorial entity.');
         
         $em->remove($tutorial);
         $em->flush();
         
         $request->getSession()->getFlashBag()->add('info', 'Tutorial deleted.');
         
         return $this->redirect($this->generateUrl('guitar_feeling_tutorials'));
      }
   }
   
   private function createDeleteForm($id)
   {
      return $this->createFormBuilder()
         ->setAction($this->generateUrl('guitar_feeling_tutorials_delete', array('id' => $id)))
         ->setMethod('DELETE')
         ->add('Delete', SubmitType::class)
         ->getForm();
   }
}
