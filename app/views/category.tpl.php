<?php 
  //TODO: Attention aux conditions dans la page, favoriser les méthodes dans les modèles
?>
<section class="hero">
    <div class="container">
      <!-- Breadcrumbs -->
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
          $count = 0;
          $countMin = 1;
            foreach ($viewVars["categoryCount"] as $category){
                if ($category->getName() == array_key_first($viewVars)) {
                  $count = $category->getNb();
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
            foreach ($viewVars["categoryCount"] as $category){
                if ($category->getName() == array_key_first($viewVars)) {
                  echo $category->getNb();
                }
            }
          ?>
          </strong>résultats
        </div>
        <div class="mr-3 mb-3">
          <span class="mr-2">Voir</span>
          <?php 
          foreach ($viewVars["categoryCount"] as $category){

              if ($category->getName() == array_key_first($viewVars)){
                if(isset($_GET['show'])){?>

                <a href="<?=$_SERVER['BASE_URI'] . '/catalog/category/'.$category->getId().'?show=12'?>" class="product-grid-header-show active"><?= ($_GET["show"] === '12') ? '<strong>12</strong>' : '12'?></a>
                <a href="<?=$_SERVER['BASE_URI'] . '/catalog/category/'.$category->getId().'?show=24'?>" class="product-grid-header-show "><?= ($_GET["show"] === '24') ? '<strong>24</strong>' : '24'?></a>
                <a href="<?=$_SERVER['BASE_URI'] . '/catalog/category/'.$category->getId().'?show=All'?>" class="product-grid-header-show "><?= ($_GET["show"] === 'All') ? '<strong>Tout</strong>' : 'Tout'?></a>
              <?php
          } else {?>
            <a href="<?=$_SERVER['BASE_URI'] . '/catalog/category/'.$category->getId().'?show=12'?>" class="product-grid-header-show active">12</a>
            <a href="<?=$_SERVER['BASE_URI'] . '/catalog/category/'.$category->getId().'?show=24'?>" class="product-grid-header-show active">24</a>
            <a href="<?=$_SERVER['BASE_URI'] . '/catalog/category/'.$category->getId().'?show=All'?>" class="product-grid-header-show active">Tout</a>
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
                <?php foreach($viewVars["categoryCount"] as $category):
                  if ($category->getName() == array_key_first($viewVars)):?>
                <a class="dropdown-item text-sm" href="<?=$_SERVER['BASE_URI']?>/catalog/category/<?= $category->getId(); ?>/sortName">Nom de produits</a>
                <a class="dropdown-item text-sm" href="<?=$_SERVER['BASE_URI']?>/catalog/category/<?= $category->getId(); ?>/sortPriceAsc">Prix Croissant</a>
                <a class="dropdown-item text-sm" href="<?=$_SERVER['BASE_URI']?>/catalog/category/<?= $category->getId(); ?>/sortPriceDesc">Prix Décroissant</a>
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
                $products = $viewVars[array_key_first($viewVars)]; 
                $countProducts = 0;
                foreach ($products as $key => $product):
                  if ($product->getCategory_name() == array_key_first($viewVars)) {
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
                echo '<p class="text-center">Il n’y a pas encore de produit dans cette catégorie. Nous vous prions de bien vouloir nous excuser pour la gêne occasionnée.</p>';
              }
              ?>


        <!-- product-->

      </div>
      
    </div>
  </section>