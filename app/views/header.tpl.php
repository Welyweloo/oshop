<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?=$_SERVER['BASE_URI']?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=$_SERVER['BASE_URI']?>/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=$_SERVER['BASE_URI']?>/css/styles.css">
  <title>oShop</title>
</head>

<body>
  <header>
    <div class="top-bar">
      <div class="container-fluid">
        <div class="row d-flex align-items-center">
          <div class="col-sm-7 d-none d-sm-block">
            <ul class="list-inline mb-0">
              <li class="list-inline-item pr-3 mr-0">
                <i class="fa fa-phone"></i> 01 02 03 04 05
              </li>
              <?php
              /**
               * Ce code (ligne 19 à 50) permet  grâce au codeIso passé en $_SESSION['currency'] de choisir avec quelle devise sera affiché le coût de livraison, 
               * si pas de session la devise par défaut sera l'euro. 
               */
              if (!empty($_SESSION['currency'])) {?>
                <li class="list-inline-item px-3 border-left d-none d-lg-inline-block">
                  Livraison offerte à partir de 
                  <?php
                  if ($_SESSION['currency'] == 978) {?>
                    100€
                    <?php
                  } else if ($_SESSION['currency'] == 840) {?> 
                    $107 
                    <?php
                  } else if ($_SESSION['currency'] == 826) {?> 
                    £93
                </li>
              <?php
                }
              }  else {
                    $_SESSION['currency'] == 978;
              ?>
                <li class="list-inline-item px-3 border-left d-none d-lg-inline-block">Livraison offerte à partir de 100€</li>
              <?php
                  }
              ?>
            </ul>
          </div>


          <div class="col-sm-5 d-flex justify-content-end">
            <!-- Currency Dropdown-->
            <?php
            /**
             * Ce code (ligne à ) toujours garder la devise choisie ($_SESSION, sinon euro pas défaut) en affichage de la dropdown list
             */
              if (!empty($_SESSION['currency'])) {
                  if ($_SESSION['currency'] == 978) {
                      ?>
                  <div class="dropdown pl-3 ml-0">
                    <a id="currencyDropdown" href="<?=$_SERVER['BASE_URI']?>/978" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle topbar-link">EUR</a>
                    <div aria-labelledby="currencyDropdown" class="dropdown-menu dropdown-menu-right">
                      <a href="<?=$_SERVER['BASE_URI']?>/840" class="dropdown-item text-sm" >USD</a>
                      <a href="<?=$_SERVER['BASE_URI']?>/826" class="dropdown-item text-sm">GBP</a>
                  </div>
                  </div>
            <?php
                  } elseif ($_SESSION['currency'] == 840) {
                      ?>
                  <div class="dropdown pl-3 ml-0">
                  <a id="currencyDropdown" href="<?=$_SERVER['BASE_URI']?>/840" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle topbar-link">USD</a>
                  <div aria-labelledby="currencyDropdown" class="dropdown-menu dropdown-menu-right">
                    <a href="<?=$_SERVER['BASE_URI']?>/978" class="dropdown-item text-sm" >EUR</a>
                    <a href="<?=$_SERVER['BASE_URI']?>/826" class="dropdown-item text-sm">GBP</a>
                </div>
                </div> 
            <?php
                  } elseif ($_SESSION['currency'] == 826) {
                      ?>
                  <div class="dropdown pl-3 ml-0">
                    <a id="currencyDropdown" href="<?=$_SERVER['BASE_URI']?>/826" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle topbar-link">GBP</a>
                    <div aria-labelledby="currencyDropdown" class="dropdown-menu dropdown-menu-right">
                      <a href="<?=$_SERVER['BASE_URI']?>/978" class="dropdown-item text-sm" >EUR</a>
                      <a href="<?=$_SERVER['BASE_URI']?>/840" class="dropdown-item text-sm">USD</a>
                    </div>
                  </div> 
                  
            <?php
                  }} else {
                      ?>
                <div class="dropdown pl-3 ml-0">
                  <a id="currencyDropdown" href="<?=$_SERVER['BASE_URI']?>/978" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle topbar-link">EUR</a>
                  <div aria-labelledby="currencyDropdown" class="dropdown-menu dropdown-menu-right">
                    <a href="<?=$_SERVER['BASE_URI']?>/840" class="dropdown-item text-sm" >USD</a>
                    <a href="<?=$_SERVER['BASE_URI']?>/826" class="dropdown-item text-sm">GBP</a>
                  </div>
                </div>
              <?php
                  }
             
            ?>

          </div>
        </div>
      </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-sticky navbar-airy navbar-light">
      <div class="container-fluid">
        <!-- Navbar Header  -->
        <a href="index.html" class="navbar-brand">oShop</a>
        <button type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
          aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
        <!-- Navbar Collapse -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a href="<?=$_SERVER['BASE_URI']?>/" class="nav-link <?php if($templateName == "home"){ echo "active";} ?> ">Home</a>
            </li>
            <li class="nav-item dropdown">
              <!-- <a href=" php // $router->generate("category-route", ['id' => 1]) ?>" class="nav-link">Catégories</a> -->
              <!-- TODO : faire un menu déroulant avec "Catégories" pour afficher les différentes catégories -->
              <a href="" class="nav-link dropdown-toggle <?php if($templateName == "category"){ echo "active";} ?> " id="navbarDropdown" role="button" data-toggle="dropdown">Catégories</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php 
                  foreach($headerCategories as $category):
                ?>
                <a class="dropdown-item text-sm" href="<?=$_SERVER['BASE_URI']?>/catalog/category/<?= $category->getId(); ?>"><?= $category->getName(); ?></a>
                <?php 
                  endforeach;
                ?>
              </div>
            </li>
            <li class="nav-item dropdown">
              <!-- <a href=" php // $router->generate("category-route", ['id' => 1]) ?>" class="nav-link">Catégories</a> -->
              <!-- TODO : faire un menu déroulant avec "Catégories" pour afficher les différentes catégories -->
              <a href="" class="nav-link dropdown-toggle <?php if($templateName == "type"){ echo "active";} ?> " id="navbarDropdown" role="button" data-toggle="dropdown">Types de produits</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php 
                  foreach($headerTypes as $type):
                ?>
                <a class="dropdown-item text-sm" href="<?=$_SERVER['BASE_URI']?>/catalog/type/<?= $type->getId(); ?>"><?= $type->getName(); ?></a>
                <?php 
                  endforeach;
                ?>
              </div>
            </li>
            <li class="nav-item dropdown">
              <!-- <a href=" php // $router->generate("category-route", ['id' => 1]) ?>" class="nav-link">Catégories</a> -->
              <!-- TODO : faire un menu déroulant avec "Catégories" pour afficher les différentes catégories -->
              <a href="" class="nav-link dropdown-toggle <?php if($templateName == "brand"){ echo "active";} ?> " id="navbarDropdown" role="button" data-toggle="dropdown">Marques</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php 
                  foreach($headerBrands as $brand):
                ?>
                <a class="dropdown-item text-sm" href="<?=$_SERVER['BASE_URI']?>/catalog/brand/<?= $brand->getId(); ?>"><?= $brand->getName(); ?></a>
                <?php 
                  endforeach;
                ?>
              </div>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Blog</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Contact</a>
            </li>
          </ul>
          <div class="d-flex align-items-center justify-content-between justify-content-lg-end mt-1 mb-2 my-lg-0">
            <!-- Search Button-->
            <div class="nav-item navbar-icon-link">
              <a href="#" class="navbar-icon-link"><i class="fa fa-search"></i></a>
            </div>
            <!-- User Not Logged - link to login page-->
            <div class="nav-item">
              <a href="#" class="navbar-icon-link"><i class="fa fa-user"></i></a>
            </div>
            <!-- Cart Dropdown-->
            <div class="nav-item dropdown">
              <a href="cart.html" class="navbar-icon-link d-lg-none">
                  <span class="badge badge-secondary">New</span>
              </a>
              <div class="d-none d-lg-block">
                <a id="cartdetails" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" href="cart.html" class="navbar-icon-link dropdown-toggle">
                <i class="fa fa-shopping-cart"></i>
                <span class="badge badge-secondary">2</span>
                </a>
                <div aria-labelledby="cartdetails" class="dropdown-menu dropdown-menu-right p-4">
                  <div class="navbar-cart-product-wrapper">
                    <!-- cart item-->
                    <div class="navbar-cart-product">
                        
                      <div class="w-100">
                          
                          <div> <a href="detail.html" class="navbar-cart-product-link">Retro socks</a><small
                              class="d-block text-muted">Quantité : 1 </small><strong class="d-block text-sm">45 €
                            </strong></div>
                      </div>
                    </div>
                    <div class="navbar-cart-product">
                        
                      <div class="w-100">
                          
                          <div> <a href="detail.html" class="navbar-cart-product-link">Dillinger</a><small
                              class="d-block text-muted">Quantité : 1 </small><strong class="d-block text-sm">30 €
                            </strong></div>
                      </div>
                    </div>
                    
                    <!-- total price-->
                    <div class="navbar-cart-total"><span class="text-uppercase text-muted">Total</span><strong class="text-uppercase">75 €</strong></div>
                    <!-- buttons-->
                    <div class="d-flex justify-content-between">
                      <a href="cart.html" class="btn btn-link text-dark mr-3">Voir le panier <i class="fa-arrow-right fa"></i></a>
                      <a href="#" class="btn btn-outline-dark">Commander</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>