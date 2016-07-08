<?php

namespace GuitarFeelingBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GuitarFeelingBundle\Entity\TutorialLevel;

class PopulateTutorialLevel implements FixtureInterface
{
   public function load(ObjectManager $manager)
   {
      $level1 = new TutorialLevel();
      $level1->setName('Newbie guitarist');
      $level1->setStep(1);
      $manager->persist($level1);

      $level2 = new TutorialLevel();
      $level2->setName('Campfire guitarist');
      $level2->setStep(2);
      $manager->persist($level2);

      $level3 = new TutorialLevel();
      $level3->setName('Advanced guitarist');
      $level3->setStep(3);
      $manager->persist($level3);

      $level4 = new TutorialLevel();
      $level4->setName('Master guitarist');
      $level4->setStep(4);
      $manager->persist($level4);

      $level5 = new TutorialLevel();
      $level5->setName('Tommy Emmanuel');
      $level5->setStep(5);
      $manager->persist($level5);
      
      $manager->flush();
   }
}
