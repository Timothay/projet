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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array('label' => 'Email', 'required' => true, 'attr' => array('class' =>'form-group', 'placeholder' =>'Entrez votre adresse mail')))
            ->add('center', ChoiceType::class, array('label' => 'Centre', 'required' => true, 'choices' => ['Lille' => 'Lille', 'Arras' => 'Arras', 'Rouen' => 'Rouen', 'Triangle des Bermudes' => 'Triangle des Bermudes', 'Diagonale du vide' => 'Diagonale du vide', 'Kremlin' => 'Kremlin'], 'attr' => array('class' =>'form-group', 'placeholder' =>'Sélectionnez le centre')))
            ->add('password', RepeatedType::class, ['type' => PasswordType::class, 'invalid_message' => 'les mots de passe sont différents.', 'options' => ['attr' => ['password-field']], 'required' => true, 'first_options' => ['label' => 'Mot de passe'], 'second_options' => ['label' => 'Confirmer le mot de passe']])
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
