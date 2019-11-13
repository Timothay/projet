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


        if ($request -> isMethod('GET')) {
            $form->handleRequest($request);
            return $this->render('security/registration.html.twig', ['form' => $form->createView()]);
        }
        
        if ($request -> isMethod('POST')) {
            $form->handleRequest($request);
            
            if($form->isSubmitted()) {
                $users= new Users;
                $data = $form->getData();
                
               if (preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8;,}$/", $data->getPassword())) {
                    $curl = curl_init("10.97.184.127:8080/register-new-user");

                    $postfields = [
                        'center' => $data->getCenter(),
                        'email' => $data->getEmail(),
                        'password' => $data->getPassword(),
                    ];
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded"));
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postfields));

                    $return = curl_exec($curl);
                    curl_close($curl);
                }
            }
        }
        return $this->redirectToRoute("connexion");
    }


    public function connection(Request $request) {

    }
}
