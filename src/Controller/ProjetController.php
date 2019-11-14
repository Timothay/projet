<?php
namespace App\Controller;
use App\Form\AddType;
use App\Entity\Products;
use App\Form\ContactType;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjetController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function accueil()
    {
        return $this->render('projet/accueil.html.twig', [
        ]);
    }

        /**
     * @Route("/echec", name="echec")
     */
    public function echec()
    {
        return $this->render('projet/echec.html.twig', [
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
    public function contact(Request $request){
        $form = $this->createForm(ContactType::class);
            return $this->render('projet/contact.html.twig', [
                'formContact' => $form->createView()
                ]);
            }
    /**
     * @Route("/boutique", name="boutique")
     */
    public function boutique(){
        $repo=$this->getDoctrine()->getRepository(Products::class);
        $products = $repo->findAll();
        return $this->render('projet/boutique.html.twig',[
            'products'=>$products
        ]);
    }
    /**
     * @Route("/moncompte", name="moncompte")
     */
    public function moncompte(Request $request){
        return $this->render('projet/compte.html.twig');

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
    public function ajouter(EntityManagerInterface $em, Request $request){
        $ajout = new Products();
        $form = $this->createForm(AddType::class, $ajout);

        if ($request -> isMethod('GET')){
            $form->handleRequest($request);
            return $this->render('projet/ajout.html.twig', ['form' => $form->createView()]);

        }
        if ($request -> isMethod('POST')){
            $data = $form->getData();
            
            $ajout = setName($data['name']);
            $ajout = setPrice($data['price']);
            $ajout = setImage($data['image']);

            $em->persist($ajout);
            $em->flush();






        }


        return $this->render('projet/ajouter.html.twig');


    }
    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentions(){
        return $this->render('projet/mentions.html.twig');
    }
    /**
     * @Route ("/cgv", name="cgv")
     */
    public function cgv(){
        return $this->render('projet/cgv.html.twig');
    }
}