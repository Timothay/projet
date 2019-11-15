<?php

namespace App\Controller;

use App\Form\AddType;
use App\Entity\Activity;
use App\Entity\Products;

use App\Form\CommentType;
use App\Form\ContactType;
use App\Entity\Activities;
use App\Entity\Commentaire;
use App\Entity\Inscription;
use App\Form\AddActivitiesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjetController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function accueil()
    {
        return $this->render('projet/accueil.html.twig', []);
    }

    /**
     * @Route("/echec", name="echec")
     */
    public function echec()
    {
        return $this->render('projet/echec.html.twig', []);
    }
    /**
     * @Route("/calendrier", name="calendrier")
     */
    public function calendrier()
    {
        return $this->render('projet/calendrier.html.twig');
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request)
    {
        $form = $this->createForm(ContactType::class);
        return $this->render('projet/contact.html.twig', [
            'formContact' => $form->createView()
        ]);
    }
    /**
     * @Route("/boutique", name="boutique")
     */
    public function boutique()
    {
        $repo = $this->getDoctrine()->getRepository(Products::class);
        $products = $repo->findBy(array(), ['nbVentes' => 'DESC']);

        return $this->render('projet/boutique.html.twig', [
            'products' => $products
        ]);
    }
    /**
     * @Route("/moncompte", name="moncompte")
     */
    public function moncompte(Request $request)
    {
        return $this->render('projet/compte.html.twig');
    }


    /**
     * @Route("/evenement", name="evenement")
     */
    public function evenement()
    {
        $repo = $this->getDoctrine()->getRepository(Activities::class);
        $activities = $repo->findAll();
        return $this->render('projet/evenement.html.twig', [
            'controller_name' => 'ProjetController',
            'activities' => $activities
        ]);
    }

    /**
     * @Route("/evenement/{id}", name="evenement_show/{id}")
     */
    public function show(EntityManagerInterface $em, Request $request, $id)
    {
        $comment = new Commentaire();
        $form = $this->createForm(CommentType::class, $comment);
        if ($request->isMethod('GET')) {
            $form->handleRequest($request);
            $repo = $this->getDoctrine()->getRepository(Activities::class);
            $activities = $repo->find($id);
            return $this->render('projet/show.html.twig', [
                'controller_name' => 'ProjetController',
                'activities' => $activities,
                'form' => $form->createView()
            ]);
        }
            if ($request->isMethod('POST')) {
                $form->handleRequest($request);

                if ($form->isSubmitted()) {
                    $data = $form->getData();

                    $comment->setComment($data->getComment());
                    $comment->setUserId($request->getSession()->get('user_id'));
                    $comment->setEmail($request->getSession()->get('user'));
                    $comment->setEventId($id);

                    $em->persist($comment);
                    $em->flush();

                    return $this->redirectToRoute('evenement');
                }
            }
        
        return $this->redirectToRoute('evenement');
    }

    /**
     * @Route("/sinscrireacti/{id}", name="sinscrireacti")
     */
    public function sinscrireacti(EntityManagerInterface $em, $id, Request $request)
    {
        $inscription = new Inscription();
        $repo = $this->getDoctrine()->getRepository(Inscription::class);

        $inscription->setUserId($request->getSession()->get('user_id'));
        $inscription->setEmail($request->getSession()->get('user'));
        $inscription->setEventId($id);

        $em->persist($inscription);
        $em->flush();

        return $this->redirectToRoute('evenement');
    }




    /**
     * @Route("/panier", name="panier")
     */
    public function panier()
    {
        return $this->render('projet/panier.php');
    }


    /**
     * @Route("/ajouter", name="ajouter")
     */
    public function ajouter(EntityManagerInterface $em, Request $request)
    {
        $ajout = new Products();
        $form = $this->createForm(AddType::class, $ajout);

        if ($request->isMethod('GET')) {
            $form->handleRequest($request);
            return $this->render('projet/ajouter.html.twig', ['form' => $form->createView()]);
        }
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $data = $form->getData();

            $ajout->setName($data->getName());
            $ajout->setNbVentes(0);
            $ajout->setPrice($data->getPrice());
            $ajout->setImage($data->getImage());

            $em->persist($ajout);
            $em->flush();

            return $this->RedirectToRoute('boutique');
        }
    }


    /**
     * @Route("/ajouteracti", name="ajouterActi")
     */
    public function ajouterActi(EntityManagerInterface $em, Request $request)
    {
        $ajout = new Activities();
        $form = $this->createForm(AddActivitiesType::class, $ajout);

        if ($request->isMethod('GET')) {
            $form->handleRequest($request);
            return $this->render('projet/ajouteracti.html.twig', ['form' => $form->createView()]);
        }
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $data = $form->getData();

            $ajout->setName($data->getName());
            $ajout->setDate($data->getDate());
            $ajout->setDescription($data->getDescription());
            $ajout->setImage($data->getImage());

            $em->persist($ajout);
            $em->flush();

            return $this->RedirectToRoute('evenement');
        }

        return $this->render('projet/ajouteracti.html.twig');
    }


    /**
     * @Route("/supprimer/{id}", name="supprimer")
     */
    public function supprimer($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $this->getDoctrine()->getRepository(Products::Class);

        $product = $repo->find($id);
        $em->remove($product);
        $em->flush();

        return $this->RedirectToRoute('boutique');
    }

    /**
     * @Route("/supprimeracti/{id}", name="supprimeracti")
     */
    public function supprimeracti($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $this->getDoctrine()->getRepository(Activities::Class);

        $activity = $repo->find($id);
        $em->remove($activity);
        $em->flush();

        return $this->RedirectToRoute('evenement');
    }

    /**
     * @Route("/masqueracti/{id}", name="masqueracti")
     */
    public function masqueracti($id, Request $request)
    {
        if ($request->getSession()->get('role') == 3) {
            $em = $this->getDoctrine()->getManager();
            $repo = $this->getDoctrine()->getRepository(Activities::Class);

            $activity = $repo->find($id);
            $activity->setMasquee(true);
            $em->flush();
        }
        return $this->RedirectToRoute('evenement');
    }

    /**
     * @Route("/afficheracti/{id}", name="afficheracti")
     */
    public function afficheracti($id, Request $request)
    {
        if ($request->getSession()->get('role') == 3) {
            $em = $this->getDoctrine()->getManager();
            $repo = $this->getDoctrine()->getRepository(Activities::Class);

            $activity = $repo->find($id);
            $activity->setMasquee(false);
            $em->flush();
        }
        return $this->RedirectToRoute('evenement');
    }

    /**
     * @Route("/inscritsa/{id}", name="inscritsa")
     */
    public function inscritsa($id, Request $request)
    {
        if ($request->getSession()->get('role') == 2) {
            $output = '';
            $repo = $this->getDoctrine()->getRepository(Inscription::Class);
            $inscrits = $repo->findBy(['event_id' => $id]);
            foreach ($inscrits as $inscrit) {
                $output = $output . $inscrit->getEmail() . ';';
            }

            $filename = "inscrits.csv";

            $response = new Response($output);

            $disposition = $response->headers->makeDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                $filename
            );

            $response->headers->set('Content-Disposition', $disposition);

            return $response;
        }
        return $this->redirectToRoute('evenement');
    }

    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentions()
    {
        return $this->render('projet/mentions.html.twig');
    }
    /**
     * @Route ("/cgv", name="cgv")
     */
    public function cgv()
    {
        return $this->render('projet/cgv.html.twig');
    }
}
