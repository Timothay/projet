<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nom', TextType::class,array('label' => 'Nom', 'required' => true, 'attr' => array('placeholder' =>'Entrez votre nom', )))
            ->add('prenom', TextType::class,array('label' => 'Prénom', 'required' => true, 'attr' => array('placeholder' =>'Entrez votre prénom')))
            ->add('email', EmailType::class, array('label' => 'E-mail', 'required' => true, 'attr' => array('placeholder' =>'Entrez votre adresse mail')))
            ->add('texte', TextareaType::class, array('label' => 'Exprimez vous et donnez nous un maximum de détails', 'required' => true))
            ->add('submit', SubmitType::class, array('label' =>'Envoyer', ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
