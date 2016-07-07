<?php

namespace GuitarFeelingBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GuitarFeelingBundle\Entity\TutorialCategory;

class PopulateTutorialCategory implements FixtureInterface
{
   public function load(ObjectManager $manager)
   {
      $category = new TutorialCategory();
      $category->setName('Finger Picking');
      
      $manager->persist($category);
      $manager->flush();
   }
}
