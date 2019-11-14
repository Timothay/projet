<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ConnectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array('label' => 'Email', 'required' => true, 'attr' => array('class' => 'form-group', 'placeholder' => 'Adresse mail')))
            ->add('password', PasswordType::class, array('label' =>'Mot de passe', 'required' => true, 'attr' => array('class' => 'form-group', 'placeholder' => 'Mot de passe')))
            ->add('submit', SubmitType::class, array('label' => 'CONNEXION', 'attr' => array('class' => 'button')))
        ;
    }
}
