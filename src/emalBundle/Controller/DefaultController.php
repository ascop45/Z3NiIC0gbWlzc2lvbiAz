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
    public function indexAction()
    {
        // recuperation des variables transmis à la page
        $request = Request::createFromGlobals();
        
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
        
        // traitement si formulaire soumis
        if($form->isSubmitted())
        {
            if($form->get('profil')->getData() == 'Visiteur')
            {   return $this->render('@emal/visiteur/accueil_visiteur.html.twig');}
            else
            {   return $this->render('@emal/comptable/accueil_comptable.html.twig'); }
        }
        
        // affichage du formulaire
        return $this->render('@emal/Default/index.html.twig', array('form'=>$form->createView()));
    }
}
