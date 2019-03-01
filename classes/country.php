<?php

class Country {

    public $code = "";
    public $coords = "";
    public $countryName = "";
    public $capital = "";
    public $currency = "";
    public $area = "";
    public $iso3 = "";
    public $phoneNumber = "";
    public $continentCode = "";
    public $officialName = "";
    public $displayOrder = "";

    public function __construct($countryCode) {
        if (!empty($countryCode)) {
            $this->code = $countryCode;
            $country = $this->getCountryByCode();
            $this->coords = $country["coords"];
            $this->countryName = $country["country_name"];
            $this->currency = $country["currency"];
            $this->capital = $country["capital"];
            $this->area = $country["area"];
            $this->iso3 = $country["iso3"];
            $this->phoneNumber = $country["phone_number"];
            $this->officialName = $country["official_name"];
            $this->continentCode = $country["continent_code"];
            $this->displayOrder = $country["display_order"];
        }
    }

    private function getCountryByCode() {
        $sql = "SELECT * FROM `countries` WHERE code=?";
        $stmt = DB::$connection->prepare($sql);
        $stmt->execute([$this->code]);
        return $stmt->fetch();
    }

    public function update() {
        $sql = "UPDATE `countries` SET country_name=?, area=?, currency=?, coords=?, capital=?, iso3=?, phone_number=?, official_name=?, continent_code=?, display_order=?  WHERE (code=?)";
        $stmt = DB::$connection->prepare($sql);
        $result = $stmt->execute([$this->countryName, $this->area, $this->currency, $this->coords, $this->capital, $this->iso3, $this->phoneNumber, $this->officialName, $this->continentCode, $this->displayOrder, $this->code]);
        return $result;
    }
    public function create() {
        $sql = "INSERT INTO`countries` (code, country_name, area, currency, coords, capital, iso3, phone_number, official_name, continent_code, display_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = DB::$connection->prepare($sql);
        $result = $stmt->execute([$this->code, $this->countryName, $this->area, $this->currency, $this->coords, $this->capital, $this->iso3, $this->phoneNumber, $this->officialName, $this->continentCode, $this->displayOrder]);
        return $result;
    }
    public static function getCountriesByContinent($continentCode, $page) {
        $n = ITEMS_ON_PAGE;
        $start = ($page-1)*ITEMS_ON_PAGE;
        $sql = "SELECT * FROM `countries` WHERE continent_code=? LIMIT $start, $n";
        $stmt = DB::$connection->prepare($sql);
        $stmt->execute([$continentCode]);
        return $stmt->fetchAll();
    }
    public static function getAllCountries(){
        $sql = "SELECT * FROM `countries`";
        $stmt = DB::$connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchALL();
    }
}
