<?php

namespace GuitarFeelingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GuitarFeelingBundle\Entity\Concert;
use GuitarFeelingBundle\Form\ConcertType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ConcertController extends Controller
{
   public function indexAction()
   {
      $em = $this->getDoctrine()->getEntityManager();
      $concerts = $em->getRepository('GuitarFeelingBundle:Concert')->findAll();
      
      foreach ($concerts as $concert)
      {
         $delete_forms[$concert->getId()] = $this->createDeleteForm($concert->getId())->createView();
      }
      
      return $this->render('GuitarFeelingBundle:Concert:index.html.twig', array('concerts' => $concerts, 'delete_forms' => $delete_forms));
   }
   
   public function newAction()
   {
      $concert = new Concert();
      
      $em = $this->getDoctrine()->getEntityManager();
      
      $form = $this->createForm(ConcertType::class, $concert, array('action' => $this->generateUrl('guitar_feeling_concerts_create')));
      
      return $this->render('GuitarFeelingBundle:Concert:new.html.twig', array('concert' => $concert, 'form' => $form->createView()));
   }
   
   public function createAction(Request $request)
   {
      $concert = new Concert();
      
      $form = $this->createForm(ConcertType::class, $concert, array('action' => $this->generateUrl('guitar_feeling_concerts_create')));
      $form->handleRequest($request);
      
      if ($form->isValid())
      {
         $em = $this->getDoctrine()->getManager();
         
         $picture = $concert->getPicture();
         $fileName = md5(uniqid()).'.'.$picture->guessExtension();
         $picture->move($this->getParameter('concerts_pictures_directory'), $fileName);
         $concert->setPicture($fileName);
         
         $em->persist($concert);
         $em->flush();
         
         $request->getSession()->getFlashBag()->add('notice', 'Concert created.');
         
         return $this->redirect($this->generateUrl('guitar_feeling_concerts_show', array('id' => $concert->getId())));
      }
      
      return $this->render('GuitarFeelingBundle:Concert:new.html.twig', array('concert' => $concert, 'form' => $form->createView()));
   }
   
   public function showAction($id)
   {
      $em = $this->getDoctrine()->getEntityManager();
      $concert = $em->getRepository('GuitarFeelingBundle:Concert')->find($id);
      if (!$concert)
         $this->createNotFoundException('Unable to find Concert entity.');
      
      return $this->render('GuitarFeelingBundle:Concert:show.html.twig', array('concert' => $concert));
   }
   
   public function editAction($id)
   {
      $em = $this->getDoctrine()->getEntityManager();
      $concert = $em->getRepository('GuitarFeelingBundle:Concert')->find($id);
      if (!$concert)
         $this->createNotFoundException('Unable to find Concert entity.');
      
      $form = $this->createForm(ConcertType::class, $concert, array('action' => $this->generateUrl('guitar_feeling_concerts_update', array('id' => $id))));
      
      return $this->render('GuitarFeelingBundle:Concert:edit.html.twig', array('concert' => $concert, 'form' => $form->createView()));
   }
   
   public function updateAction($id, Request $request)
   {
      $em = $this->getDoctrine()->getEntityManager();
      $concert = $em->getRepository('GuitarFeelingBundle:Concert')->find($id);
      if (!$concert)
         $this->createNotFoundException('Unable to find Concert entity.');
      
      $fileName = $concert->getPicture();
      
      $form = $this->createForm(ConcertType::class, $concert, array('action' => $this->generateUrl('guitar_feeling_concerts_update', array('id' => $id))));
      $form->handleRequest($request);
      
      if ($form->isValid())
      {
         $picture = $concert->getPicture();
         if ($picture)
         {
            $fileName = md5(uniqid()).'.'.$picture->guessExtension();
            $picture->move($this->getParameter('concerts_pictures_directory'), $fileName);
         }
         
         $concert->setPicture($fileName);
         
         $em->persist($concert);
         $em->flush();
         
         return $this->redirect($this->generateUrl('guitar_feeling_concerts_show', array('id' => $id)));
      }
      
      return $this->render('GuitarFeelingBundle:Concert:edit.html.twig', array('concert' => $concert, 'form' => $form->createView()));
   }
   
   public function publishAction($id, Request $request)
   {
      $em = $this->getDoctrine()->getEntityManager();
      $concert = $em->getRepository('GuitarFeelingBundle:Concert')->find($id);
      if (!$concert)
         $this->createNotFoundException('Unable to find Concert entity.');
      
      $concert->setPublished(!$concert->getPublished());
      
      $em->persist($concert);
      $em->flush();
      
      return $this->indexAction();
   }
   
   public function deleteAction($id, Request $request)
   {
      $form = $this->createDeleteForm($id);
      $form->handleRequest($request);
      
      if ($form->isValid())
      {
         $em = $this->getDoctrine()->getEntityManager();
         $concert = $em->getRepository('GuitarFeelingBundle:Concert')->find($id);
         if (!$concert)
            $this->createNotFoundException('Unable to find Concert entity.');
         
         $em->remove($concert);
         $em->flush();
         
         $request->getSession()->getFlashBag()->add('info', 'Concert deleted.');
         
         return $this->redirect($this->generateUrl('guitar_feeling_concerts'));
      }
   }
   
   private function createDeleteForm($id)
   {
      return $this->createFormBuilder()
         ->setAction($this->generateUrl('guitar_feeling_concerts_delete', array('id' => $id)))
         ->setMethod('DELETE')
         ->add('Delete', SubmitType::class)
         ->getForm();
   }
}
