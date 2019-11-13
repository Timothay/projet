<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\ContactType;

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
        $contact = null;
        $form = $this->createForm(ContactType::class);

        return $this->render('projet/contact.html.twig', [
            'formContact' => $form->createView()
        ]);
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
     * @Route("/evenement/{id}", name="evenement")
     */
    public function evenement($id) {
        return $this->render('projet/evenement.html.twig');
    }
    /**
     * @Route("/panier", name="panier")
     */
    public function panier() {
        return $this->render('projet/panier.php');
    }
    /**
     * @Route("/ajouter", name="ajouter")
     */
    public function ajouter(){
        return $this->render('projet/ajouter.html.twig');
    }
    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentions(){
        return $this->render('projet/mentions.html.twig');
    }
}