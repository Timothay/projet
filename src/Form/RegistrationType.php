<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('email', EmailType::class, array('label' => 'Email', 'required' => true, 'attr' => array('class' =>'form-group', 'placeholder' =>'Entrez votre adresse mail')))
            ->add('center', ChoiceType::class, array('label' => 'Centre', 'required' => true, 'choices' => ['Lille' => 'Lille', 'Arras' => 'Arras', 'Rouen' => 'Rouen', 'Triangle des Bermudes' => 'Triangle des Bermudes', 'Diagonale du vide' => 'Diagonale du vide', 'Kremlin' => 'Kremlin', 'Parlement du premier Saint-Empire romain de la nation Teutonique' => 'Parlement du premier Saint-Empire romain de la nation Teutonique'], 'attr' => array('class' =>'form-group', 'placeholder' =>'Sélectionnez le centre')))
            ->add('password', PasswordType::class, array('label' => 'Mot de passe', 'required' => true, 'attr' => array('class' =>'form-group', 'placeholder' =>'Entrez votre mot de passe')))
            ->add('confirm_password', PasswordType::class, array('label' =>'Confirmation', 'required' => true, 'attr' => array('class' => 'form-group', 'placeholder' => 'Confirmer le mot de passe')))
            ->add('submit', SubmitType::class, array('label' =>'INSCRIPTION', 'attr' =>array('class' => 'button')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
