<?php

class Car {

    // ACTIVE RECORD CODE
    protected static $database;

    public static function set_database($database) {
        self::$database = $database;
    }

    public static function find_by_sql($sql) {
        // Execute SQL command and store result in $result
        $result = self::$database->query($sql);

        // Error checking
        if (!$result) {
            exit("Database query failed.");
        }

        // Transform result into objects
        $object_array = [];
        while($record = $result->fetch_assoc()) {
            $object_array[] = self::instantiate($record);
        }
        $result->free();

        return $object_array;
    }

    public static function find_all() {
        $sql = "SELECT * FROM cars";
        return self::find_by_sql($sql);
    }

    protected static function instantiate($record) {
        $object = new Car;
        foreach($record as $property => $value) {
            if (property_exists($object, $property)) {
                $object->$property = $value;
            }
        }
        return $object;
    }

    // Instance variables (Properties)
    public $id;
    public $make;
    public $model;
    public $year;
    public $body_type;
    public $colour;
    public $mileage_km;
    public $price;
    public $fuel_type;
    public $description;
    protected $condition_id;

    // Constants
    public const CATEGORIES = ['Sedan', 'SUV', 'Coupe', 'Hatchback', 'Convertible', 'Pickup', 'Van', 'Sports', 'Crossover'];
    public const COLOUR = ['Black', 'Gray', 'Silver', 'White', 'Blue', 'Red'];
    protected const CONDITION_OPTIONS = [
        1 => 'New',
        2 => 'Certified Pre-Owned',
        3 => 'Used',
    ];

    // Constructor
    public function __construct($args = []) {
        $this->make = $args['make'] ?? '';
        $this->model = $args['model'] ?? '';
        $this->year = $args['year'] ?? '';
        $this->body_type = $args['body_type'] ?? '';
        $this->colour = $args['colour'] ?? '';
        $this->mileage_km = $args['mileage_km'] ?? 0;
        $this->price = $args['price'] ?? 0.0;
        $this->fuel_type = $args['fuel_type'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->condition_id = $args['condition_id'] ?? '';
    }

    public function condition() {
        if ($this->condition_id > 0) {
            return self::CONDITION_OPTIONS[$this->condition_id];
        } else {
            return "Unknown";
        }
    }


}

?>