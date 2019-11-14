<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationType;
use App\Form\ConnectionType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

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
                $data = $form->getData();
               

                if (preg_match('/[0-9]/', $data->getPassword()) && preg_match('/[A-Z]/', $data->getPassword()) && preg_match('/[a-z]/', $data->getPassword()))
                {
                    $curl = curl_init("10.97.184.127:8080/register-new-user");

                    $postfields = [
                        'center' => $data->getCenter(),
                        'email' => $data->getEmail(),
                        'password' => $data->getPassword()
                    ];
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded"));
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postfields));

                    $return = curl_exec($curl);
                    curl_close($curl);
                }
                else{
                return $this->redirectToRoute("echec");    
                }
            }
        }
        return $this->redirectToRoute("connexion");
    }



    /**
     * @Route("/connexion", name="connexion")
     */
    public function connection(Request $request) 
    {
        $user = new Users();
        $form = $this->createForm(ConnectionType::class, $user);
        
        if ($request->isMethod('GET'))
        {
            $form->handleRequest($request);
            return $this->render('security/connexion.html.twig', ['form' => $form->createView()]);
        }

        if ($request->isMethod('POST'))// && $form->isSubmitted())// && $form->isValid())
        {
            $form->handleRequest($request);
            $data = $form->getData();
            $getfields = [
                'user' => $data->getEmail(),
                'pass' => $data->getPassword(),
                'city' => "Lille"
  
            ];
            $params = http_build_query($getfields);
            $curl = curl_init("10.97.184.127:8080/login?".$params);
        
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $return = curl_exec($curl);
            curl_close($curl);
            $return = json_decode($return);

            $email=$data->getEmail();
            $role=$return->role;
            $token=$return->token;

            $session=$request->getSession();
            $session->set('token', $token);
            $session->set('user', $email);
            $session->set('role', $role);



            return $this->render('projet/compte.html.twig');
        }
        return $this->render('projet/accueil.html.twig');
    }
    
    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion(Request $request){
        $session = $request->getSession();
        $session -> clear();
        return $this->RedirectToRoute('accueil');



    }
}



