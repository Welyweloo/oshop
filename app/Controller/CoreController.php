<?php

namespace Oshop\Controller;
use Oshop\Model\Category;
use Oshop\Model\Brand;
use Oshop\Model\Type;


abstract class CoreController 
{
protected function redirect($url)
{

}




    protected function show($templateName, $viewVars = [])
    {
        //Si aucune session n'est définie, applique l'EUR en devise par défaut
        if(!isset($_SESSION['currency'])) { 
            $_SESSION['currency'] = 978;
        }

        //HEADER
        $categoryModel = new Category();
        $headerCategories = $categoryModel->findAll();

        $brandModel = new Brand();
        $headerBrands = $brandModel->findAll();

        $typeModel = new Type();
        $headerTypes = $typeModel->findAll();

        //FOOTER
        $footerTypes = $typeModel->findFiveFooterType();
        $footerBrands = $brandModel->findFiveFooterBrand();

        require("../app/views/header.tpl.php");
        require("../app/views/$templateName.tpl.php");
        require("../app/views/footer.tpl.php");
    }
}