<?php
require_once 'config.php';
require_once 'classes/db.php';
require_once 'classes/continent.php';
require_once 'classes/country.php';
require_once 'classes/html.php';
DB::connect();
$continentCode = (isset($_GET['code'])) ? $_GET['code'] : "AF";
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;

$continents = Continent::getAllContinents();

$continent = new Continent($continentCode);

$qntArray = $continent->getCountCountries();
$pageCount = ceil($qntArray['qnt'] / ITEMS_ON_PAGE);

$countries = Country::getCountriesByContinent($continentCode, $page);
?>

<?php include("header.php"); ?>

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="list-group">
                    <?php foreach ($continents as $continentItem): ?>
                        <a href="continent.php?code=<?= $continentItem['code']; ?>" class="list-group-item list-group-item-action <?= HTML::active($continentItem['code'], $continentCode); ?>"><?= $continentItem['name'] ?></a>
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
                <div class="mt-5 ">
                    <?php HTML::pageNavHelper($pageCount, $page, "continent.php?code=$continentCode") ?>
                </div>
            </div>
        </div>
</section>

<?php include("footer.php"); ?>