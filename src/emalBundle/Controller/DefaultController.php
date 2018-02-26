<?php

namespace emalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        // Attention la syntaxe généré par les commandes de symfony ne fonctionnent pas
        return $this->render('@emal/Default/index.html.twig');
    }
}
