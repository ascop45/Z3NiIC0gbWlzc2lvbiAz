<?php

namespace emalBundle\Form\ConnexionForm;

/**
 * Classe permettant de générer le formulaire de connexion
 *
 * @author laze
 */
class ConnexionClass {
    
    //ATRIBUTS
    private $login;
    private $motDePasse;
    private $role;
    
    //METHODES
    
    //getter
    public function getLogin(){
        return $this->login;
    }
    
    public function getMotDePasse(){
        return $this->motDePasse;
    }
    
    public function getRole(){
        return $this->role;
    }
    
    //setter
    public function setLogin($login){
        $this->login = $login;
    }
    
    public function setMotDePasse($mdp){
        $this->motDePasse = $mdp;
    }
    
    public function setRole($role){
        $this->role = $role;
    }
}
