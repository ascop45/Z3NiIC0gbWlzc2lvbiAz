<?php

namespace emalBundle\Controller;

// controleur
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// requete
use Symfony\Component\HttpFoundation\Request;

// formulaire
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class DefaultController extends Controller
{
    public function indexAction()
    {
        $request = Request::createFromGlobals();
        
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
        
        if($form->isSubmitted())
        {
            $contenuFormulaire = $form->getData();
            if($contenuFormulaire.profil === 'visiteur')
            {   return $this->render('@emal/Defaut/visiteur/accueil_visiteur.html.twig');}
            else
            {   return $this->render('@emal/Defaut/comptable/accueil_comptable.html.twig'); }
        }
        
        return $this->render('@emal/Default/index.html.twig', array('form'=>$form->createView()));
    }
}
