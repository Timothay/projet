<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
        public function registration(Request $request) {
        $user = new Users();

        $form = $this->createForm(RegistrationType::class, $user);
            if ($request -> isMethod('GET')){
        $form->handleRequest($request);
        
        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);



            if($request -> isMethod('POST')){
        if($form->isSubmitted() && $form->isValid()) {
            $curl = curl_init();

            curl_setopt($curl, CURLOPT-URL, 'localhost:8080/');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_COOKIESESSION, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postfields);

            $postfields = array(
                'center' => $centre,
                'email' => $mail,
                'password' => $password,
            );

            $return = curl_exec($curl);
            curl_close($curl);


        }
        

    }
}
        }
    }
