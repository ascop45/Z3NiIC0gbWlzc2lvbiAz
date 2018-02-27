<?php

namespace emalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        // Attention la syntaxe généré par les commandes de symfony ne fonctionnent pas
        return $this->render('@emal/Default/index.html.twig');
    }
    
    // test de reprise en main
    public function helloAction($test="vide")
    {
        return new Response("texte ".$test);
    }
}
