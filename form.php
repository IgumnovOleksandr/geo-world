<?php
require_once 'config.php';
require_once 'classes/db.php';
require_once 'classes/continent.php';
require_once 'classes/country.php';
DB::connect();

$countryCode = (isset($_GET['country_code'])) ? $_GET["country_code"] : "";
$message = [];
$dangerMessages = [];
$haveCode = 0;
$countries = Country::getAllCountries();
foreach ($countries as $countriesItem){
    if($countriesItem['code'] == $countryCode){
        $haveCode = 1;
        break;
    }
}
$country = new Country($countryCode);
if (isset($_POST['action']) && $_POST['action'] == 'edit' && $country->code == $countryCode) {
    if (strlen($_POST["code"]) != 2) {
        $message['danger'][] = 'Country Code must be 2 characters';
        $dangerMessages["code"] = 1;
    } else
        $dangerMessages["code"] = 0;
    if (strlen($_POST["country_name"]) <= 2) {
        $message['danger'][] = 'Country Name must have at least 3 characters';
        $dangerMessages["country_name"] = 1;
    } else
        $dangerMessages["country_name"] = 0;
    if (strlen($_POST["official_name"]) < 3) {
        $message['danger'][] = 'Official Name must be at least 3 characters';
        $dangerMessages["official_name"] = 1;
    } else
        $dangerMessages["official_name"] = 0;
    if (strlen($_POST["iso3"]) != 3) {
        $message['danger'][] = 'ISO3 must be 3 characters';
        $dangerMessages["iso3"] = 1;
    } else
        $dangerMessages["iso3"] = 0;
    if (strlen($_POST["country_phone_number"]) != 3) {
        $message['danger'][] = 'Country Phone Number must be 3 characters';
        $dangerMessages["country_phone_number"] = 1;
    } else
        $dangerMessages["country_phone_number"] = 0;
    if (strlen($_POST["currency"]) < 2 || $_POST["currency"][0] != '[' || $_POST["currency"][1] != '"' || $_POST["currency"][strlen($_POST["currency"]) - 1] != ']' || $_POST["currency"][strlen($_POST["currency"]) - 2] != '"') {
        $message['danger'][] = 'Currency must at least 2 characters and look like ["UAH"]';
        $dangerMessages["currency"] = 1;
    } else
        $dangerMessages["currency"] = 0;
    if (strlen($_POST["capital"]) < 3) {
        $message['danger'][] = 'Capital must be at least 3 characters';
        $dangerMessages["capital"] = 1;
    } else
        $dangerMessages["capital"] = 0;
    if (!is_numeric($_POST["area"])) {
        $message['danger'][] = 'Country Area must be numeric';
        $dangerMessages["area"] = 1;
    } else
        $dangerMessages["area"] = 0;
    if (strlen($_POST["country_continent_code"]) != 2) {
        $message['danger'][] = 'Continent Code must be 2 characters';
        $dangerMessages["country_continent_code"] = 1;
    } else
        $dangerMessages["country_continent_code"] = 0;
    if (strlen($_POST["coords"]) < 5 || $_POST["coords"][0] != '[' || $_POST["coords"][strlen($_POST["coords"]) - 1] != ']') {
        $message['danger'][] = 'Country Coords must be at least 7 characters and look like [x,y]';
        $dangerMessages["coords"] = 1;
    } else
        $dangerMessages["coords"] = 0;
    if (strlen($_POST["display_order"]) < 2) {
        $message['danger'][] = 'Display Order must be at least 2 characters';
        $dangerMessages["display_order"] = 1;
    } else
        $dangerMessages["display_order"] = 0;
    if (empty($message['danger'])) {
        $country->countryName = $_POST["country_name"];
        $country->officialName = $_POST["official_name"];
        $country->iso3 = $_POST["iso3"];
        $country->phoneNumber = $_POST["country_phone_number"];
        $country->currency = $_POST["currency"];
        $country->capital = $_POST["capital"];
        $country->area = $_POST["area"];
        $country->continentCode = $_POST["country_continent_code"];
        $country->coords = $_POST["coords"];
        $country->displayOrder = $_POST["display_order"];

        if ($country->update()) {
            $message['success'][] = 'Country successfully updated!';
        } else {
            $message['danger'][] = 'Country something wrong!';
        }
    }
} else
if (isset($_POST['action']) && $_POST['action'] == 'add' && strlen($countryCode) == 0) {
    if (strlen($_POST["code"]) != 2) {
        $message['danger'][] = 'Country Code must be 2 characters';
        $dangerMessages["code"] = 1;
    } else
        $dangerMessages["code"] = 0;
    if (strlen($_POST["country_name"]) <= 2) {
        $message['danger'][] = 'Country Name must have at least 3 characters';
        $dangerMessages["country_name"] = 1;
    } else
        $dangerMessages["country_name"] = 0;
    if (strlen($_POST["official_name"]) < 3) {
        $message['danger'][] = 'Official Name must be at least 3 characters';
        $dangerMessages["official_name"] = 1;
    } else
        $dangerMessages["official_name"] = 0;
    if (strlen($_POST["iso3"]) != 3) {
        $message['danger'][] = 'ISO3 must be 3 characters';
        $dangerMessages["iso3"] = 1;
    } else
        $dangerMessages["iso3"] = 0;
    if (strlen($_POST["country_phone_number"]) != 3) {
        $message['danger'][] = 'Country Phone Number must be 3 characters';
        $dangerMessages["country_phone_number"] = 1;
    } else
        $dangerMessages["country_phone_number"] = 0;
    if (strlen($_POST["currency"]) < 2 || $_POST["currency"][0] != '[' || $_POST["currency"][1] != '"' || $_POST["currency"][strlen($_POST["currency"]) - 1] != ']' || $_POST["currency"][strlen($_POST["currency"]) - 2] != '"') {
        $message['danger'][] = 'Currency must at least 2 characters and look like ["UAH"]';
        $dangerMessages["currency"] = 1;
    } else
        $dangerMessages["currency"] = 0;
    if (strlen($_POST["capital"]) < 3) {
        $message['danger'][] = 'Capital must be at least 3 characters';
        $dangerMessages["capital"] = 1;
    } else
        $dangerMessages["capital"] = 0;
    if (!is_numeric($_POST["area"])) {
        $message['danger'][] = 'Country Area must be numeric';
        $dangerMessages["area"] = 1;
    } else
        $dangerMessages["area"] = 0;
    if (strlen($_POST["country_continent_code"]) != 2) {
        $message['danger'][] = 'Continent Code must be 2 characters';
        $dangerMessages["country_continent_code"] = 1;
    } else
        $dangerMessages["country_continent_code"] = 0;
    if (strlen($_POST["coords"]) < 5 || $_POST["coords"][0] != '[' || $_POST["coords"][strlen($_POST["coords"]) - 1] != ']') {
        $message['danger'][] = 'Country Coords must be at least 7 characters and look like [x,y]';
        $dangerMessages["coords"] = 1;
    } else
        $dangerMessages["coords"] = 0;
    if (strlen($_POST["display_order"]) < 2) {
        $message['danger'][] = 'Display Order must be at least 2 characters';
        $dangerMessages["display_order"] = 1;
    } else
        $dangerMessages["display_order"] = 0;
    if (empty($message['danger'])) {
        $country->code = $_POST["code"];
        $country->countryName = $_POST["country_name"];
        $country->officialName = $_POST["official_name"];
        $country->iso3 = $_POST["iso3"];
        $country->phoneNumber = $_POST["country_phone_number"];
        $country->currency = $_POST["currency"];
        $country->capital = $_POST["capital"];
        $country->area = $_POST["area"];
        $country->continentCode = $_POST["country_continent_code"];
        $country->coords = $_POST["coords"];
        $country->displayOrder = $_POST["display_order"];

        if ($country->create()) {
            $message['success'][] = 'Country successfully created!';
        } else {
            $message['danger'][] = 'Country something wrong!';
        }
    }
} else {
    if($haveCode == 0 && strlen($countryCode) != 0)
    $message['danger'][] = 'Sorry! Country is not found.';
}
require_once 'header.php';
?>
<section id="main">
    <div class="container">
        <ul class="list-group">
            <?php foreach ($message as $key => $messageBlock): ?>
                <?php foreach ($messageBlock as $messageItem): ?>
                    <li class="list-group-item list-group-item-<?= $key ?>"><?= $messageItem ?></li>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
        <?php if(($haveCode == 1) || ($haveCode == 0 && strlen($countryCode) == 0)) { ?>
        <form method="post" action="form.php?country_code=<?= $countryCode ?>" class="mb-3 mt-3">
            <div class="form-group">
                <label for="country-code">Country Code</label>
                <input type="text" class="form-control <?php if ($dangerMessages["code"] == 1) : ?> input-error <?php endif; ?>" id="country-code" placeholder="Country Code" value="<?= $country->code; ?>" name="code" >
            </div>
            <div class="form-group">
                <label for="country-name">Country Name</label>
                <input type="text" class="form-control <?php if ($dangerMessages["country_name"] == 1) : ?> input-error <?php endif; ?>" id="country-name" placeholder="Country Name" value="<?= $country->countryName; ?>" name="country_name">
            </div>
            <div class="form-group">
                <label for="official-name">Official Name</label>
                <input type="text" class="form-control <?php if ($dangerMessages["official_name"] == 1) : ?> input-error <?php endif; ?>" id="official-name" placeholder="Official Name" value="<?= $country->officialName; ?>" name="official_name">
            </div>
            <div class="form-group">
                <label for="iso3">ISO3</label>
                <input type="text" class="form-control <?php if ($dangerMessages["iso3"] == 1) : ?> input-error <?php endif; ?>" id="iso3" placeholder="ISO3" value="<?= $country->iso3; ?>" name="iso3">
            </div>
            <div class="form-group">
                <label for="country-phone-number">Country Phone Number</label>
                <input type="text" class="form-control <?php if ($dangerMessages["country_phone_number"] == 1) : ?> input-error <?php endif; ?>" id="country-phone-number" value="<?= $country->phoneNumber; ?>" placeholder="Country Phone Number" name="country_phone_number">
            </div>
            <div class="form-group">
                <label for="country-currency">Currency</label>
                <input type="text" class="form-control <?php if ($dangerMessages["currency"] == 1) : ?> input-error <?php endif; ?>" id="country-currency" value='<?= $country->currency; ?>' placeholder="Country Currency" name="currency">
            </div>
            <div class="form-group">
                <label for="country-capital">Capital</label>
                <input type="text" class="form-control <?php if ($dangerMessages["capital"] == 1) : ?> input-error <?php endif; ?>" id="country-capital" value="<?= $country->capital; ?>" placeholder="Country Capital" name="capital">
            </div>
            <div class="form-group">
                <label for="country-area">Area</label>
                <input type="text" class="form-control <?php if ($dangerMessages["area"] == 1) : ?> input-error <?php endif; ?>" id="country-area" value="<?= $country->area; ?>" placeholder="Country Area" name="area">
            </div>
            <div class="form-group">
                <label for="country-continent-code">Continent Code</label>
                <input type="text" class="form-control <?php if ($dangerMessages["country_continent_code"] == 1) : ?> input-error <?php endif; ?>" id="country-continent-code" value="<?= $country->continentCode; ?>" placeholder="Continent Code" name="country_continent_code">
            </div>
            <div class="form-group">
                <label for="country-coords">Coords</label>
                <input type="text" class="form-control <?php if ($dangerMessages["coords"] == 1) : ?> input-error <?php endif; ?>" id="country-coords" value="<?= $country->coords; ?>" placeholder="Country Coords" name="coords">
            </div>
            <div class="form-group">
                <label for="display-order">Display Order</label>
                <input type="text" class="form-control <?php if ($dangerMessages["display_order"] == 1) : ?> input-error <?php endif; ?>" id="display-order" value="<?= $country->displayOrder; ?>" placeholder="Display Order" name="display_order">
            </div>
            <?php if ($countryCode != '') { ?>
                <input type="hidden" name="action" value="edit">
            <?php } else { ?>
                <input type="hidden" name="action" value="add">
            <?php } ?>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php } ?>
    </div>
</section>
<?php
require_once 'footer.php';
?>
