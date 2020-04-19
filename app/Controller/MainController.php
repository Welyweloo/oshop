<?php

namespace Oshop\Controller;

use Oshop\Model\Category;

class MainController extends CoreController
{   
    //responsable d'afficher la page d'accueil
    public function home ($params = [])
    {
        $categories = new Category;
        $categoriesToDisplay = $categories->categoriesOnHome();
        
        $this->show("home", ["category"=>$categoriesToDisplay]);
    }

    public function legal ($params = [])
    {
        $this->show("legal");
    }

      
    public function fourofour ()  // page d'erreur 404
    {
        die("Erreur 404");
        
        //on indique aux robots genre Google que c'est une page d'erreur
        header("HTTP/1.0 404 Not Found");
        $this->show('404');
    }

  

   
}