<?php

class Car {

    // ACTIVE RECORD CODE
    protected static $database;

    public static function set_database($database) {
        self::$database = $database;
    }

    // Executes given SQL query, checks for errors, and then converts each row of the result into a Car object
    public static function find_by_sql($sql) {
        // Execute SQL command and store result in $result
        $result = self::$database->query($sql);

        // Error checking
        if (!$result) {
            exit("Database query failed.");
        }

        // Convert result into objects
        $object_array = [];
        while($record = $result->fetch_assoc()) {
            $object_array[] = self::instantiate($record);
        }
        $result->free();

        return $object_array;
    }

    // Returns array of Car objects, each representing a row from cars table in the database
    public static function find_all() {
        $sql = "SELECT * FROM cars";
        return self::find_by_sql($sql);
    }

    // Retrieves a single car from the database whose id matches the given value
    public static function find_by_id($id) {
        $sql = "SELECT * FROM cars ";
        $sql .= "WHERE id='" . self::$database->escape_string($id) .  "'";
        $object_array = self::find_by_sql($sql);
        if (!empty($object_array)) {
            return array_shift($object_array);
        } else {
            return false;
        }
    }

    // Convert each row of result into Car object
    protected static function instantiate($record) {
        $object = new Car;
        foreach($record as $property => $value) {
            if (property_exists($object, $property)) {
                $object->$property = $value;
            }
        }
        return $object;
    }


    public function create() {
        $sql = "INSERT INTO cars (";
        $sql .= "make, model, year, bodyType_id, colour_id, mileage_km, price, fuelType_id, description, condition_id, file";
        $sql .= ") VALUES (";
        $sql .= "'" . $this->make . "', ";
        $sql .= "'" . $this->model . "', ";
        $sql .= "'" . $this->year . "', ";
        $sql .= "'" . $this->bodyType_id . "', ";
        $sql .= "'" . $this->colour_id . "', ";
        $sql .= "'" . $this->mileage_km . "', ";
        $sql .= "'" . $this->price . "', ";
        $sql .= "'" . $this->fuelType_id . "', ";
        $sql .= "'" . $this->description . "', ";
        $sql .= "'" . $this->condition_id . "', ";
        $sql .= "'" . $this->file . "'";
        $sql .= ")";

        $result = self::$database->query($sql);
        if($result) {
            $this->id = self::$database->insert_id;
        }
        
        return $result;
    }


    // Instance variables (Properties)
    public $id;
    public $make;
    public $model;
    public $year;
    public $mileage_km;
    public $price;
    public $description;
    public $file;

    public $fuelType_id;
    public $condition_id;
    public $bodyType_id;
    public $colour_id;
    
    // Constants
    public const BODY_OPTIONS = [
        1 => 'Sedan',
        2 => 'SUV',
        3 => 'Coupe',
        4 => 'Hatchback',
        5 => 'Convertible',
        6 => 'Pickup',
        7 => 'Van',
        8 => 'Sports',
        9 => 'Crossover',
        10 => 'Motorbike'
    ];
    
    public const COLOUR_OPTIONS = [
        1 => 'Black',
        2 => 'Gray',
        3 => 'Silver',
        4 => 'White',
        5 => 'Blue',
        6 => 'Red'
    ];

    public const FUEL_OPTIONS = [
        1 => 'Petrol',
        2 => 'Diesel',
        3 => 'Electric',
        4 => 'Hybrid',
        5 => 'Plug-in Hybrid',
        6 => 'LPG',
        7 => 'CNG',
        8 => 'Hydrogen'
    ];

    public const CONDITION_OPTIONS = [
        1 => 'New',
        2 => 'Certified Pre-Owned',
        3 => 'Used',
    ];

    // Constructor
    public function __construct($args = []) {
        $this->make = $args['make'] ?? 'Unknown';
        $this->model = $args['model'] ?? 'Unknown';
        $this->year = $args['year'] ?? 0000;
        $this->bodyType_id = $args['bodyType_id'] ?? 0;
        $this->colour_id = $args['colour_id'] ?? 0;
        $this->mileage_km = $args['mileage_km'] ?? 0;
        $this->price = $args['price'] ?? 0.0;
        $this->fuelType_id = $args['fuelType_id'] ?? 0;
        $this->description = $args['description'] ?? '';
        $this->condition_id = $args['condition_id'] ?? 0;
        $this->file = $args['file'] ?? '';
    }

    public function condition() {
        if ($this->condition_id > 0) {
            return self::CONDITION_OPTIONS[$this->condition_id];
        } else {
            return "Unknown";
        }
    }

    public function fuel() {
        if ($this->fuelType_id > 0) {
            return self::FUEL_OPTIONS[$this->fuelType_id];
        } else {
            return "Unknown";
        }
    }

    public function colour() {
        if ($this->colour_id > 0) {
            return self::COLOUR_OPTIONS[$this->colour_id];
        } else {
            return "Unknown";
        }
    }

    public function body() {
        if ($this->bodyType_id > 0) {
            return self::BODY_OPTIONS[$this->bodyType_id];
        } else {
            return "Unknown";
        }
    }

    public function image() {
    }

    public function name() {
        if (isset($this->year) && isset($this->make) && isset($this->model)) {
            return "{$this->year} {$this->make} {$this->model}";
        } else {
            return "Unknown";
        }
    }

    public function price() {
        return "$" . number_format($this->price,2);
    }

    public function mileage() {
        return number_format(h($this->mileage_km)) . " km";
    }


}

?>