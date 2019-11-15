<?php

namespace App\Form;

use App\Entity\Activities;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AddActivitiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('required' => true, 'attr' => array('class' => 'form-group')))
            ->add('description', TextType::class, array('required' => true, 'attr' => array('class' => 'form-group')))
            ->add('date', DateType::class, array('required' => true, 'attr' => array('class' => 'form-group')))
            ->add('image', TextType::class, array('required' => true, 'attr' => array('class' => 'form-group')))
            ->add('submit', SubmitType::class, array( 'attr' => array('class' => 'form-group', 'placeholder' => 'Ajouter')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Activities::class,
        ]);
    }
}
