<?php

namespace emalBundle\Controller;

// controleur
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// requete
use Symfony\Component\HttpFoundation\Request;

// formulaire
use emalBundle\Form\ConnexionForm\ConnexionClass;
use emalBundle\Form\ConnexionForm\ConnexionFormType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $request = Request::createFromGlobals();
        
        // Création du formulaire
        $connexion = new ConnexionClass();
        $form = $this->createForm(ConnexionFormType::class, $connexion);
        
        // Vérification de la complétion du formulaire
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $login = $form->get('login')->getData();
            $mdp = $form->get('motDePasse')->getData();
            $role = $form->get('role')->getData();
            
            $repository = $this->getDoctrine()->getManager()->getRepository('emalBundle:'.ucfirst($role));
            $donneeUtilisateur = $repository->findOneBy(array('login'=>$login, 'mdp'=>$mdp));
            
            if(isset($donneeUtilisateur))
            {
                return $this->redirectToRoute('accueil_'.$role, array('login'=>$login));
            }
            else
            {
                return $this->redirectToRoute('erreur', array('code'=>0));
            }
        }
        
        // Affichage de la page de connexion
        return $this->render('@emal/Default/index.html.twig', array('form'=>$form->createView()));
    }

    
    public function erreurAction(Request $request)
    {
        $messageErreur =    array(
                                'Login, mot de passe ou rôle incorrect',
                            );
        
        return $this->render(
                '@emal/Default/erreur.html.twig',
                array('message'=>$messageErreur[$request->attributes->get('code')])
        );
    }
}
