<section>
  <div class="container-fluid">
    <div class="row mx-0">
      <?php
      $categories = $viewVars["category"];
      foreach ($categories as $key => $category) {
        if ($key < 2) {
          echo '        
      <div class="col-md-6">
        <div class="card border-0 text-white text-center"><img src="' . $category->getPicture() . '" alt="Card image" class="card-img">
          <div class="card-img-overlay d-flex align-items-center">
            <div class="w-100 py-3">
              <h2 class="display-3 font-weight-bold mb-4">' . $category->getName() . '</h2><a href="' . $_SERVER['BASE_URI'] . '/catalog/category/' . $category->getId() . '" class="btn btn-light">' . $category->getSubtitle() . '</a>
            </div>
          </div>
        </div>
      </div>';
        } else {
          echo  '
        <div class="col-lg-4">
          <div class="card border-0 text-center text-white"><img src="' . $category->getPicture() . '" alt="Card image" class="card-img">
            <div class="card-img-overlay d-flex align-items-center">
              <div class="w-100">
                <h2 class="display-4 mb-4">' . $category->getName() . '</h2><a href="' . $_SERVER['BASE_URI'] . '/catalog/category/' . $category->getId() . '" class="btn btn-link text-white">' . $category->getSubtitle() . '<i class="fa-arrow-right fa ml-2"></i></a>
              </div>
            </div>
          </div>
      </div>';
        }
      }
      ?>

    </div>
  </div>
</section>