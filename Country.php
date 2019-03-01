<?php
require_once 'config.php';
require_once 'classes/db.php';
require_once 'classes/continent.php';
require_once 'classes/country.php';
DB::connect();
$countryCode = $_GET["country_code"];

$country = new Country($countryCode);
$countryArray = array();
foreach ($country as $countryItem) {
    if ($countryItem[0] == '[') {
        $countryItem[0] = '';
        $countryItem[strlen($countryItem) - 1] = '';
        if ($countryItem[1] == '"') {
            $countryItem[1] = '';
            $countryItem[strlen($countryItem) - 2] = '';
        }
    }
    $countryArray[] = $countryItem;
}
$st = 0;
for ($i = 0; $countryArray[1][$i] != ','; $i++) {
    $st = $i;
}
$countryCoordsX = substr($countryArray[1], 1, $st + 1);
$countryCoordsY = substr($countryArray[1], $st + 2, strlen($countryArray[1]));
?>

<?php include("header.php"); ?>

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 mt-3">
                <table class="table table-hover table-light">
                    <h2><?= $countryArray[2] ?></h2>
                    <tbody>
                        <tr>
                            <td>Столиця</td>
                            <td><?= $countryArray[3] ?></td>
                        </tr>
                        <tr>
                            <td>Прапор</td>
                            <td><img src="images/countries/png100px/<?= strtolower($countryArray[0])?>.png" /></td>
                        </tr>
                        <tr>
                            <td>Валюта</td>
                            <td><?= $countryArray[4] ?></td>
                        </tr>
                        <tr>
                            <td>Площа</td>
                            <td><?= $countryArray[5] ?> км²</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-sm-12 col-md-6 mt-3">
                <div id="map"></div>
                <script>
                    function initMap() {
                        var myLatLng = {lat: <?= (float) $countryCoordsX ?>, lng: <?= (float) $countryCoordsY ?>};
                        var map = new google.maps.Map(document.getElementById('map'), {
                            center: myLatLng,
                            zoom: 4
                        });
                        var marker = new google.maps.Marker({
                            map: map,
                            position: myLatLng,
                            title: 'Hello World!'
                        });
                    }

                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0bTC3v2Lwx5RUBxAdn1zUKDqpgkAjjMs&callback=initMap"
                async defer></script>
            </div>
        </div>
    </div>
</section>

<?php include("footer.php"); ?>