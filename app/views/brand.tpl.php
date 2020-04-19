<?php 
  //TODO: Attention aux conditions dans la page, favoriser les méthodes dans les modèles 
?>

<!-- Les commentaires sur cette page sont égalements utiles pour les autres views (category, type)-->

<section class="hero">
    <div class="container">
      <!-- Breadcrumbs (array_key_first, permet de récupérer le nom de la marque renvoyée par viewVars)-->
      <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a href="<?=$_SERVER['BASE_URI']?>/">Home</a></li>
        <li class="breadcrumb-item active"><?= array_key_first($viewVars); ?></li>
      </ol>
      <!-- Hero Content-->
      <div class="hero-content pb-5 text-center">
        <h1 class="hero-heading"><?= array_key_first($viewVars); ?></h1>
        <div class="row">
          <div class="col-xl-8 offset-xl-2">
            <p class="lead text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
              incididunt.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="products-grid">
    <div class="container-fluid">

    <header class="product-grid-header d-flex align-items-center justify-content-between">
        <div class="mr-3 mb-3">
          Affichage 
          <strong>
          <?php 
          /**
           * Ce code permet d'aller compter le nombre de produits selon la catégorie affichée (ligne 27 à 101)
           * Au clic des différents liens (12, 24, Tout), une variable $_GET['show'] est envoyée afin de savoir combien de produits on souhaite afficher sur la page. 
           * Si aucune variable $_GET['show'] n'est définie, tous les produits seront affichés. 
           * Pour l'affichage des produits à gauche, nous stockons dans $countMax la string contenue dans $_GET['show'],
           * si elle est définie :
           * si $_GET['show']est supérieur à $count (nombre de produits d'une catégorie) on réassigne la valeur de $count à la variable $countMax (car le nombre max de produits est le nombre de la catégorie)
           * sinon le chiffre max à afficher reste $_GET['show']
           * si elle n'est pas définie et que $count est supérieur à 0, on affiche de $countMin à $count
           * si elle n'est pas définie et que $count est inférieur à 0, on affiche de 0 à 0 car aucun produit
           */

          $count = 0;
          $countMin = 1;
            foreach ($viewVars["brandCount"] as $brand){
                if ($brand->getName() == array_key_first($viewVars)) {
                  $count = $brand->getNb();
                }
            }

            if(isset($_GET['show'])){
              $countMax = $_GET['show'];
              if ($_GET['show'] > $count) {
                $countMax = $count;
              }
              echo "1 à $countMax";
            } else if($count > 0){
              echo "$countMin à $count";
            } else {
              $countMin = 0;
              $count = 0;
              echo "$countMin à $count";
            }

        ?>
          </strong>de 
          <strong>
          <?php 
            foreach ($viewVars["brandCount"] as $brand){
                if ($brand->getName() == array_key_first($viewVars)) {
                  echo $brand->getNb();
                }
            }
          ?>
          </strong>résultats
        </div>
        <div class="mr-3 mb-3">
          <span class="mr-2">Voir</span>
          <?php 
          foreach ($viewVars["brandCount"] as $brand){

              if ($brand->getName() == array_key_first($viewVars)){
                if(isset($_GET['show'])){?>

                <a href="<?=$_SERVER['BASE_URI'] . '/catalog/brand/'.$brand->getId().'?show=12'?>" class="product-grid-header-show active"><?= ($_GET["show"] === '12') ? '<strong>12</strong>' : '12'?></a>
                <a href="<?=$_SERVER['BASE_URI'] . '/catalog/brand/'.$brand->getId().'?show=24'?>" class="product-grid-header-show "><?= ($_GET["show"] === '24') ? '<strong>24</strong>' : '24'?></a>
                <a href="<?=$_SERVER['BASE_URI'] . '/catalog/brand/'.$brand->getId().'?show=All'?>" class="product-grid-header-show "><?= ($_GET["show"] === 'All') ? '<strong>Tout</strong>' : 'Tout'?></a>
              <?php
          } else {?>
            <a href="<?=$_SERVER['BASE_URI'] . '/catalog/brand/'.$brand->getId().'?show=12'?>" class="product-grid-header-show active">12</a>
            <a href="<?=$_SERVER['BASE_URI'] . '/catalog/brand/'.$brand->getId().'?show=24'?>" class="product-grid-header-show active">24</a>
            <a href="<?=$_SERVER['BASE_URI'] . '/catalog/brand/'.$brand->getId().'?show=All'?>" class="product-grid-header-show active">Tout</a>
            <?php
          }
        };
            }


          ?>
        </div>
        <nav class="navbar navbar-expand-lg navbar-sticky navbar-airy navbar-light">
      <div class="container-fluid">
        <div id="navbarCollapse" class="collapse navbar-collapse">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item dropdown">
              <a href="" class="nav-link dropdown-toggle active" id="navbarDropdown" role="button" data-toggle="dropdown">Trier Par</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php foreach($viewVars["brandCount"] as $brand):
                  if ($brand->getName() == array_key_first($viewVars)):?>
                <a class="dropdown-item text-sm" href="<?=$_SERVER['BASE_URI']?>/catalog/brand/<?= $brand->getId(); ?>/sortName">Nom de produits</a>
                <a class="dropdown-item text-sm" href="<?=$_SERVER['BASE_URI']?>/catalog/brand/<?= $brand->getId(); ?>/sortPriceAsc">Prix Croissant</a>
                <a class="dropdown-item text-sm" href="<?=$_SERVER['BASE_URI']?>/catalog/brand/<?= $brand->getId(); ?>/sortPriceDesc">Prix Décroissant</a>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
            </li>
          </ul>
        </div>
      </div>
        </nav>

      </header>
      <div class="row">
          <?php
            /**
             * Le code ci-dessus permet d'afficher un produit et ses informations grâce au $viewVars et aux méthodes définies dans Product (ligne 127 à 216)
             * Les conditions permettent de vérifier:
             * - si le produit sélectionné dans $products est bien de la marque à afficher
             * - s'il y a une variable $_GET['show'] qui est créée, on la transforme en integer avec (int) afin de la comparer avec $countProducts (qui s'incrémente à chaque ajout de produit grâce au foreach)
             * selon le nombre dans $_GET['show'] nous pouvons donc déterminer combien de produits doivent être affichés
             * - si ce nombre est égal à 0 malgré la boucle, c'est que la marque n'a aucun produit, on affiche un message d'excuse pour les clients
             */

                $products = $viewVars[array_key_first($viewVars)]; 
                $countProducts = 0;
                foreach ($products as $key => $product):
                  if ($product->getBrand_name() == array_key_first($viewVars)) {
                    $countProducts++;
                    if (isset($_GET['show'])) {
                        if ($_GET['show'] === "All") {?>
                        <div class="product col-xl-3 col-lg-4 col-sm-6">
                          <div class="product-image">
                            <a href="<?=$_SERVER['BASE_URI'] . '/catalog/product/' . $product->getId()?>" class="product-hover-overlay-link">
                              <img src="<?= $product->getPicture(); ?>" alt="product" class="img-fluid">
                            </a>
                          </div>
                          <div class="product-action-buttons">
                            <a href="#" class="btn btn-outline-dark btn-product-left"><i class="fa fa-shopping-cart"></i></a>
                            <a href="<?=$_SERVER['BASE_URI'] . '/catalog/product/' . $product->getId()?>" class="btn btn-dark btn-buy"><i class="fa-search fa"></i><span class="btn-buy-label ml-2">Voir</span></a>
                          </div>
                          <div class="py-2">
                            <p class="text-muted text-sm mb-1"><?= $product->getType_name(); ?></p>
                            <h3 class="h6 text-uppercase mb-1"><a href="<?=$_SERVER['BASE_URI'] . '/catalog/product/' . $product->getId()?>" class="text-dark"><?= $product->getName(); ?></a></h3><span class="text-muted"><?= $product->getPriceForCurrentCurrency().' '.$product->getSignForCurrency(); ?></span>
                          </div>
                        </div>
                      <?php
                      } 
                      else if (((int)($_GET['show'])) >= $countProducts) {
                          ?>
                        <div class="product col-xl-3 col-lg-4 col-sm-6">
                          <div class="product-image">
                            <a href="<?=$_SERVER['BASE_URI'] . '/catalog/product/' . $product->getId()?>" class="product-hover-overlay-link">
                              <img src="<?= $product->getPicture(); ?>" alt="product" class="img-fluid">
                            </a>
                          </div>
                          <div class="product-action-buttons">
                            <a href="#" class="btn btn-outline-dark btn-product-left"><i class="fa fa-shopping-cart"></i></a>
                            <a href="<?=$_SERVER['BASE_URI'] . '/catalog/product/' . $product->getId()?>" class="btn btn-dark btn-buy"><i class="fa-search fa"></i><span class="btn-buy-label ml-2">Voir</span></a>
                          </div>
                          <div class="py-2">
                            <p class="text-muted text-sm mb-1"><?= $product->getType_name(); ?></p>
                            <h3 class="h6 text-uppercase mb-1"><a href="<?=$_SERVER['BASE_URI'] . '/catalog/product/' . $product->getId()?>" class="text-dark"><?= $product->getName(); ?></a></h3><span class="text-muted"><?= $product->getPriceForCurrentCurrency().' '.$product->getSignForCurrency(); ?></span>
                          </div>
                        </div>
                      
                    <?php
                      }
                    } else {
                          ?>
                          <div class="product col-xl-3 col-lg-4 col-sm-6">
                          <div class="product-image">
                            <a href="<?=$_SERVER['BASE_URI'] . '/catalog/product/' . $product->getId()?>" class="product-hover-overlay-link">
                              <img src="<?= $product->getPicture(); ?>" alt="product" class="img-fluid">
                            </a>
                          </div>
                          <div class="product-action-buttons">
                            <a href="#" class="btn btn-outline-dark btn-product-left"><i class="fa fa-shopping-cart"></i></a>
                            <a href="<?=$_SERVER['BASE_URI'] . '/catalog/product/' . $product->getId()?>" class="btn btn-dark btn-buy"><i class="fa-search fa"></i><span class="btn-buy-label ml-2">Voir</span></a>
                          </div>
                          <div class="py-2">
                            <p class="text-muted text-sm mb-1"><?= $product->getType_name(); ?></p>
                            <h3 class="h6 text-uppercase mb-1"><a href="<?=$_SERVER['BASE_URI'] . '/catalog/product/' . $product->getId()?>" class="text-dark"><?= $product->getName(); ?></a></h3><span class="text-muted"><?= $product->getPriceForCurrentCurrency().' '.$product->getSignForCurrency(); ?></span>
                          </div>
                        </div>

                        <?php
                      }
                    
              } 
              endforeach;
              if($countProducts === 0){
                echo '<p class="text-center">Il n’y a pas encore de produit de cette marque. Nous vous prions de bien vouloir nous excuser pour la gêne occasionnée.</p>';
              }
              ?>


        <!-- product-->

      </div>
      
    </div>
  </section>