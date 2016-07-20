<?php

namespace GuitarFeelingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TutorialType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options)
   {
      $builder->add('title');
      $builder->add('description');
      $builder->add('category', EntityType::class, array(
         'class' => 'GuitarFeelingBundle:TutorialCategory',
         'choice_label' => 'name'
      ));
      $builder->add('level', EntityType::class, array(
         'class' => 'GuitarFeelingBundle:TutorialLevel',
         'choice_label' => 'name'
      ));
      $builder->add('submit', SubmitType::class);
      
      $builder->setAction($options['action']);
   }

   public function setDefaultOptions(OptionsResolverInterface $resolver)
   {
      $resolver->setDefaults(array('data_class' => 'GuitarFeelingBundle\Entity\Tutorial'));
   }
  
   public function getName()
   {
      return 'tutorial';
   }
}
