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
        $sql .= "make, model, year, body_type, colour, mileage_km, price, fuel_type, description, condition_id, image";
        $sql .= ") VALUES (";
        $sql .= "'" . $this->make . "', ";
        $sql .= "'" . $this->model . "', ";
        $sql .= "'" . $this->year . "', ";
        $sql .= "'" . $this->body_type . "', ";
        $sql .= "'" . $this->colour . "', ";
        $sql .= "'" . $this->mileage_km . "', ";
        $sql .= "'" . $this->price . "', ";
        $sql .= "'" . $this->fuel_type . "', ";
        $sql .= "'" . $this->description . "', ";
        $sql .= "'" . $this->condition_id . "', ";
        $sql .= "'" . $this->image . "'";
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
    public $image;

    public $colour;
    public $body_type;
    public $fuel_type;
    public $condition_id;
    
    // Constants
    public const MAKE_OPTIONS = [
        'Honda',
        'Toyota',
        'Ford',
        'Chevrolet',
        'Nissan',
        'Volkswagen',
        'Hyundai',
        'Kia',
        'Mazda',
        'Subaru',
        'Mercedes-Benz',
        'BMW',
        'Audi',
        'Lexus',
        'Jeep',
        'Ram',
        'GMC',
        'Dodge',
        'Tesla',
        'Volvo',
        'Land Rover',
        'Jaguar',
        'Porsche',
        'Mini',
        'Fiat',
        'Ducati'
    ];

    public const BODY_OPTIONS = [
        'Sedan',
        'SUV',
        'Coupe',
        'Hatchback',
        'Convertible',
        'Pickup',
        'Van',
        'Sports',
        'Crossover',
        'Motorbike'
    ];
    
    public const COLOUR_OPTIONS = [
        'Black',
        'Gray',
        'Silver',
        'White',
        'Blue',
        'Red'
    ];

    public const FUEL_OPTIONS = [
        'Petrol',
        'Diesel',
        'Electric',
        'Hybrid',
        'Plug-in Hybrid',
        'LPG',
        'CNG',
        'Hydrogen'
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
        $this->body_type = $args['body_type'] ?? 'Unknown';
        $this->colour = $args['colour'] ?? 'Unknown';
        $this->mileage_km = $args['mileage_km'] ?? 0;
        $this->price = $args['price'] ?? 0.00;
        $this->fuel_type = $args['fuel_type'] ?? 'Unknown';
        $this->description = $args['description'] ?? 'Unknown';
        $this->condition_id = $args['condition_id'] ?? 0;
        $this->image = $args['image'] ?? null;
    }

    public function condition() {
        if ($this->condition_id > 0) {
            return self::CONDITION_OPTIONS[$this->condition_id];
        } else {
            return "Unknown";
        }
    }

    public function image() {
    if ($this->image) {
        return "images/" . $this->image;
    } else {
        return "images/default.png";
    }
}

    public function name() {
        if (isset($this->year) && isset($this->make) && isset($this->model)) {
            return "{$this->year} {$this->make} {$this->model}";
        } else {
            return "Unknown";
        }
    }

    public function price() {
        return "$" . number_format($this->price);
    }

    public function mileage() {
        return number_format(h($this->mileage_km)) . " km";
    }


}

?>