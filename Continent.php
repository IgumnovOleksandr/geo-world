<?php

require_once 'config.php';
require_once 'classes/db.php';
require_once 'classes/continent.php';
require_once 'classes/country.php';
DB::connect();
$continentCode = $_GET['code'];

$continents = Continent::getAllContinents();

$continent = new Continent($continentCode);

$countries = Country::getCountriesByContinent($continentCode);
?>

<?php include("header.php"); ?>

<section id="main">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-3">
        <div class="list-group">
          <?php foreach ($continents as $continentItem): ?>
            <a href="continent.php?code=<?= $continentItem['code']; ?>" class="list-group-item list-group-item-action <?php if($continentItem['code'] == $continentCode): ?> active<?php endif;?>"><?= $continentItem['name'] ?></a>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="col-12 col-md-9">
      <h2><?= $continent->name ?></h2>
      <p><?= $continent->description ?></p>
      <div class="list-group">
          <?php foreach ($countries as $countryItem): ?>
            <a href="country.php?country_code=<?= $countryItem['code']; ?>" class="list-group-item list-group-item-action "><?= $countryItem['country_name'] ?></a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<?php include("footer.php"); ?>