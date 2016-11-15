<?php

namespace GuitarFeelingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ConcertType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options)
   {
      $builder->add('title');
      $builder->add('picture', FileType::class, array('data_class' => null, 'required' => is_null($builder->getData()->getId())));
      $builder->add('description');
      $builder->add('date', DateTimeType::class, array('widget' => 'single_text', 'format' => 'dd/MM/yyyy hh:mm'));
      $builder->add('venue');
      $builder->add('submit', SubmitType::class);
      
      $builder->setAction($options['action']);
   }
   
   public function setDefaultOptions(OptionsResolverInterface $resolver)
   {
      $resolver->setDefaults(array('data_class' => 'GuitarFeelingBundle\Entity\Concert'));
   }
   
   public function getName()
   {
      return 'concert';
   }
}
