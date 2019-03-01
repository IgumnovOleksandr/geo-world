<?php

class Continent{
    public $code = "";
    public $name = "";
    public $description = "";
    
    public function __construct($code = "AF") {
        $this->code = $code;
        $continent = $this->getContinentByCode();
        $this->name = $continent["name"];
        $this->description = $continent["description"];
    }
    public function getCountCountries(){
        $sql = "SELECT COUNT(*) AS qnt FROM `countries` WHERE continent_code=?";
        $stmt = DB::$connection->prepare($sql);
        $stmt->execute([$this->code]);
        return $stmt->fetch();
    }
    public static function getAllContinents(){
        $sql = "SELECT * FROM `continents`";
        $stmt = DB::$connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchALL();
    }
    private function getContinentByCode(){
        $sql = "SELECT * FROM `continents` WHERE code=?";
        $stmt = DB::$connection->prepare($sql);
        $stmt->execute([$this->code]);
        return $stmt->fetch();
    }
}

