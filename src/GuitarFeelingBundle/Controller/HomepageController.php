<?php

namespace GuitarFeelingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
   public function indexAction()
   {
      $em = $this->getDoctrine()->getEntityManager();
      
      $mostRecentTutorials = $this->getMostRecentTutorials(3);
      $levels = $em->getRepository('GuitarFeelingBundle:TutorialLevel')->findAll();
      
      return $this->render('GuitarFeelingBundle:Homepage:index.html.twig', array('mostRecentTutorials' => $mostRecentTutorials, 'levels' => $levels));
   }
    
   private function getMostRecentTutorials($tutorialCount)
   {
      $em = $this->getDoctrine()->getEntityManager();
      $repository = $em->getRepository('GuitarFeelingBundle:Tutorial');
      
      $query = $repository->createQueryBuilder('t')
         ->orderBy('t.createdAt', 'DESC')
         ->setMaxResults($tutorialCount)
         ->getQuery();
      
      return $query->getResult();
   }
}
