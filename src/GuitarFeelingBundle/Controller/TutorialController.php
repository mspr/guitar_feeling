<?php

namespace GuitarFeelingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TutorialController extends Controller
{
      public function indexAction()
      {
         return $this->render('GuitarFeelingBundle:Tutorial:index.html.twig');
      }

      public function newAction()
      {
         return $this->render('GuitarFeelingBundle:Tutorial:new.html.twig');
      }
}
