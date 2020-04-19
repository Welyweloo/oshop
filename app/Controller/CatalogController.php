<?php

namespace Oshop\Controller;

use Oshop\Model\Product;
use Oshop\Model\Category;
use Oshop\Model\Type;
use Oshop\Model\Brand;

class CatalogController extends CoreController
{
    public function showAllProducts($params = [])
    {
        $productModel = new Product(); // on créé une instance de Product juste pour avoir accès à la méthode
        $products = $productModel->findAll(); // récupère tous les produits
        $this->show("category");
    }

    public function showCategoryProducts($params = [])
    {
        $categoryShown = new Category; 
        $category = $categoryShown->find($params['id']);

        $count = $categoryShown->totalProductsByCategories(); // Permet de compter le nombre de produits par catégorie

        $product = new Product();

        if (!empty($params["action"])) { //Ces conditions permettent d'effectuer le tri par nom ou prix grâce aux routes lignes 34, 36 et 38 sur index.php 
            
            if ($params["action"] === "sortName") {
                $products = $product->sortName(); //cette méthode est la même que findWithCatAndTypesPrices avec un ORDER BY name
            } elseif ($params["action"] === "sortPriceAsc") {
                $products = $product->sortPriceAsc(); //cette méthode est la même que findWithCatAndTypesPrices avec un ORDER BY price ASC
            } elseif ($params["action"] === "sortPriceDesc") {
                $products = $product->sortPriceDesc(); //cette méthode est la même que findWithCatAndTypesPrices avec un ORDER BY price DESC
            }
        } else {
            $products = $product->findWithCatAndTypePrices();
        }
        
        $this->show("category", [$category->getName() => $products, "categoryCount" => $count]); // "Les informations [] seront contenues dans le tableau ViewVars 
        
    }
        

    public function showTypeProducts($params = [])
    {
         $typeShown = new Type;
         $type = $typeShown->find($params['id']);
 
         $count = $typeShown->totalProductsByTypes();

         $product = new Product();

         if (!empty($params["action"])) {
            
            if ($params["action"] === "sortName") {
                $products = $product->sortName();
            } elseif ($params["action"] === "sortPriceAsc") {
                $products = $product->sortPriceAsc();
            } elseif ($params["action"] === "sortPriceDesc") {
                $products = $product->sortPriceDesc();
            }
        } else {
            $products = $product->findWithCatAndTypePrices();
        }
         $this->show("type", [$type->getName() => $products, "typeCount" => $count]);
    }

    
    public function showBrandProducts($params = [])
    {
        $brandShown = new Brand();
        $brand = $brandShown->find($params['id']);

        $count = $brandShown->totalProductsByBrands();

        $product = new Product();

        if (!empty($params["action"])) {
           
           if ($params["action"] === "sortName") {
               $products = $product->sortName();
           } elseif ($params["action"] === "sortPriceAsc") {
               $products = $product->sortPriceAsc();
           } elseif ($params["action"] === "sortPriceDesc") {
               $products = $product->sortPriceDesc();
           }
       } else {
           $products = $product->findWithCatAndTypePrices();
       }
       $this->show("brand", [$brand->getName() => $products, "brandCount" => $count]);
    }

    public function showProduct($params = [])
    {

        $productModel = new Product();
        $product = $productModel->find($params['id']);

        $this->show("product", ["product"=>$product]);
    }
    
}