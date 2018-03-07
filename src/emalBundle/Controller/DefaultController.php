<?php

namespace emalBundle\Controller;

// controleur
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// requete
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// formulaire
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        // recuperation des variables transmis à la page
        //$request = Request::createFromGlobals();
        
        // creation du formulaire procedural
        $form = $this->createFormBuilder()
                ->add('identifiant', TextType::class)
                ->add('motDePasse', PasswordType::class)
                ->add('profil', ChoiceType::class,
                        array('choices'=>array( 'visiteur'=>'Visiteur',
                                                'comptable'=>'Comptable'))
                )
                ->add('valider', SubmitType::class)
                ->getForm()
        ;
        $form->handleRequest($request);
        
        
        if($form->isValid())
        {
            $login = $form->get('identifiant')->getData();
            $mdp = $form->get('motDePasse')->getData();
            $profil = $form->get('profil')->getData();
            $repository = $this->getDoctrine()->getManager()->getRepository('emalBundle:'.$profil);
            
            
            if($profil === 'Visiteur')
            {   return $this->render('@emal/visiteur/accueil_visiteur.html.twig', array('type'=> var_dump($repository))); }
            elseif($profi === 'Comptable')
            {   return $this->render('@emal/comptable/accueil_comptable.html.twig'); }
        }
        
        
        // traitement si formulaire soumis
        /*if($form->isValid())
        {
            if($form->get('profil')->getData() == 'Visiteur')
            {
                return $this->render('@emal/visiteur/accueil_visiteur.html.twig');
            }
            elseif($form->get('profil')->getData() == 'Comptable')
            {
                $id = $form->get('identifiant')->getData();
                $mdp = hash("sha512", $form->get('motDePasse')->getData());
                $retour = 'ok';
                
                $repository = $this->getDoctrine()->getManager()->getRepository('emalBundle:Comptable');
                $visiteur = $repository->findOneBy(array('login'=>$id));
                
                if(!isset($visiteur) || $visiteur->getMdp() != $mdp)
                { $retour = 'nope'; }
                
                return $this->render('@emal/comptable/accueil_comptable.html.twig', array('retour'=>$retour));
            }
        }*/
        
        // affichage du formulaire
        return $this->render('@emal/Default/index.html.twig', array('form'=>$form->createView()));
    }
}
