<?php
require('../vendor/autoload.php'); // on rend disponible tous nos packages installés par Composer
session_start(); //démarrage de la session pour stocker le choix de la devise

//on récupère le paramètre d'URL page et on le stocke dans une belle petite variable
$page = (!empty($_GET['page'])) ? $_GET['page'] : "home";

require('../app/Database.php');
require('../app/Model/CoreModel.php');
require('../app/Model/Product.php');
require('../app/Model/Category.php');
require('../app/Model/Type.php');
require('../app/Model/Brand.php');
require('../app/Controller/CoreController.php');
require('../app/Controller/MainController.php');
require('../app/Controller/CatalogController.php');

$router = new AltoRouter();

//demande à AltoRouter d'ignorer les sous-dossiers présents dans l'URL
//je veux qu'il compare mes routes avec la fin de l'URL seulement
//le BASE_URI a été créé par le .htaccess !
$router->setBasePath($_SERVER['BASE_URI']);


$router->map("GET", "/", ["MainController", "home"]); //accueil
$router->map("GET", "/legal-mentions", ["MainController", "legal"]); //mentions légales
$router->map("GET", "/[i:codeISO]", ["MainController", "home"],"currency-route"); //devise



//la partie [i:id] est dynamique, variable ! Elle doit contenir un nombre entier
$router->map("GET", "/catalog/category/[i:id]", ["CatalogController", "showCategoryProducts"], "category-route");
$router->map("GET", "/catalog/category/[i:id]/[a:action]", ["CatalogController", "showCategoryProducts"]); // pour le tri des produits sur category.tpl.php
$router->map("GET", "/catalog/type/[i:id]", ["CatalogController", "showTypeProducts"],"type-route");
$router->map("GET", "/catalog/type/[i:id]/[a:action]", ["CatalogController", "showTypeProducts"]); // pour le tri des produits sur type.tpl.php
$router->map("GET", "/catalog/brand/[i:id]", ["CatalogController", "showBrandProducts"],"brand-route");
$router->map("GET", "/catalog/brand/[i:id]/[a:action]", ["CatalogController", "showBrandProducts"]); // pour le tri des produits sur brand.tpl.php
$router->map("GET", "/catalog/product/[i:id]", ["CatalogController", "showProduct"],"product-route");



$match = $router->match(); // on demande à altorouter de comparer maintenant l'URL de la requête avec nos routes


if ($match === false) { // si AltoRouter n'a pas trouvé l'URL demandée dans la liste de nos routes, alors page 404
    $controller = new MainController(); // instancie notre class MainController
    $controller->fourofour();
}else{

    if(!empty($match['params']['codeISO'])){ // Si un paramètre codeISO est défini, stocke le en session
        $_SESSION['currency'] = $match['params']['codeISO'];
    }
    
    $controllerToUse = "Oshop\Controller\\".$match["target"][0]; //dans quel contrôleur sqe trouve la méthode à appeler ?
    $methodToCall = $match["target"][1]; // quelle est la méthode à appeler ?

    $controller = new $controllerToUse(); //truc méga chelou : on crée une instance à partir du nom du contrôleur qui est contenu, sous forme de chaîne dans notre variable
    $controller->$methodToCall( $match["params"] ); //même logique... on connait le nom de la méthode à appeler, il est dans notre variable... 
}
