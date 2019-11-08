<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProjetController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function accueil()
    {
        return $this->render('projet/accueil.html.twig', [
            'controller_name' => 'ProjetController',
        ]);
    }

    /**
     * @Route("/calendrier", name="calendrier")
     */
    public function calendrier(){
        return $this->render('projet/calendrier.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(){
        return $this->render('projet/contact.html.twig');
    }

    /**
     * @Route("/boutique", name="boutique")
     */
    public function boutique(){
        return $this->render('projet/boutique.html.twig');
    }

    /**
     * @Route("/moncompte", name="moncompte")
     */
    public function moncompte(){
        return $this->render('projet/compte.html.twig');
    }

    /**
     * @Route("/admin", name="admin")
     */  
    public function admin(){
        return $this->render('projet/admin.html.twig');
    }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion() {
        return $this->render('projet/connexion.html.twig');
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription() {
        return $this->render('projet/inscription.html.twig');
    }

    /**
     * @Route("/evenement/{id}", name="evenement")
     */
    public function evenement($id) {
        return $this->render('projet/evenement.html.twig');
    }

    /**
     * @Route("/panier", name="panier")
     */
    public function panier() {
        return $this->render('projet/panier.html.twig');
    }

    /**
     * @Route("/ajouter", name="ajouter")
     */
    public function ajouter(){
        return $this->render('projet/ajouter.html.twig');
    }
}


