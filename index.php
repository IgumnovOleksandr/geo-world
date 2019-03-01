<?php

require_once 'config.php';
require_once 'classes/db.php';
require_once 'classes/continent.php';
require_once 'classes/country.php';
DB::connect();
$continents = Continent::getAllContinents();

?>

<?php include("header.php"); ?>

<section id="main">
  <div class="container">
    <div class="row">
      <?php foreach ($continents as $continentItem): ?>
      <div class="col-12 col-sm-6 col-md-4 mt-3">
        <div class="card p-3">
          <img src="images/continents/<?= strtolower($continentItem['code']); ?>.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><?= $continentItem['name']; ?></h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="continent.php?code=<?= $continentItem['code']; ?>" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>

<?php include("footer.php"); ?>