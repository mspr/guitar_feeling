<?php

namespace GuitarFeelingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
   
   public function contactAction(Request $request)
   {
      $name = $request->request->get('contactname');
      $email = $request->request->get('email');
      $subject = $request->request->get('subject');
      $body = $request->request->get('body');
      
      if ($request->request->get('submit'))
      {
         $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
                      ->setUsername('spriet.maxime.eisti@gmail.com')
                      ->setPassword('cedfcedm');
         $mailer = \Swift_Mailer::newInstance($transport);
         
         $message = \Swift_Message::newInstance()
                    ->setSubject($subject)
                    ->setFrom('spriet.maxime.eisti@gmail.com')
                    ->setTo('spriet.maxime.eisti@gmail.com')
                    ->setBody($body);
         
         if (!$mailer->send($message, $failures))
         {
            echo "Failures:";
            print_r($failures);
         }
         else
            $this->get('session')->getFlashBag()->set('contact-notice', 'Your contact enquiry was successfully sent. Thank you!');
      }
      
      return $this->render('GuitarFeelingBundle:Homepage:contact.html.twig');
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
