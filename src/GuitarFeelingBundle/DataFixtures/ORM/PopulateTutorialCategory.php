<?php

namespace GuitarFeelingBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GuitarFeelingBundle\Entity\TutorialCategory;

class PopulateTutorialCategory implements FixtureInterface
{
   public function load(ObjectManager $manager)
   {
      $categoryFP = new TutorialCategory();
      $categoryFP->setName('Finger Picking');
      $manager->persist($categoryFP);
      
      $categoryTP = new TutorialCategory();
      $categoryTP->setName('Tapping');
      $manager->persist($categoryTP);

      $categorySL = new TutorialCategory();
      $categorySL->setName('Solo');
      $manager->persist($categorySL);

      $categoryHY = new TutorialCategory();
      $categoryHY->setName('Harmony');
      $manager->persist($categoryHY);
      
      $manager->flush();
   }
}
