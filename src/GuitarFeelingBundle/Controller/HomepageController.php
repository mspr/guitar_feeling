<?php

namespace GuitarFeelingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
   public function indexAction()
   {
      $em = $this->getDoctrine()->getEntityManager();
      
      $mostRecentTutorials = $this->getMostRecentTutorials(3);
      $closestConcerts = $this->getClosestConcerts(3);
      $levels = $em->getRepository('GuitarFeelingBundle:TutorialLevel')->findAll();
      
      return $this->render('GuitarFeelingBundle:Homepage:index.html.twig', array('mostRecentTutorials' => $mostRecentTutorials, 'closestConcerts' => $closestConcerts, 'levels' => $levels));
   }
   
   private function getMostRecentTutorials($tutorialCount)
   {
      $em = $this->getDoctrine()->getEntityManager();
      $repository = $em->getRepository('GuitarFeelingBundle:Tutorial');
      
      $query = $repository->createQueryBuilder('t')
         ->where('t.published = TRUE')
         ->orderBy('t.createdAt', 'DESC')
         ->setMaxResults($tutorialCount)
         ->getQuery();
      
      return $query->getResult();
   }
   
   private function getClosestConcerts($concertCount)
   {
      $em = $this->getDoctrine()->getEntityManager();
      $repository = $em->getRepository('GuitarFeelingBundle:Concert');
      
      $query = $repository->createQueryBuilder('c')
         ->where('c.published = TRUE')
         ->orderBy('c.date', 'DESC')
         ->setMaxResults($concertCount)
         ->getQuery();
      
      return $query->getResult();
   }
}
