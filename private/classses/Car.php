<?php

class Car {

    // ACTIVE RECORD CODE
    protected static $database;
    protected static $db_columns = ['make', 'model', 'year', 'body_type', 'colour', 'mileage_km', 'price', 'fuel_type', 'description', 'condition_id', 'image'];

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

    public static function find_by_image($image) {
        $dir = __DIR__ . '/../../public/images/';
        $files = [];
        foreach (scandir($dir) as $file) {
            if ($file !== '.' && $file !== '..' && is_file($dir . $file)) {
                $files[] = $file;
            }
        }

        if (in_array($image, $files)) {
            return true;
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
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO cars (";
        $sql .= join(', ', array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";

        // $sql .= "'" . $this->make . "', ";
        // $sql .= "'" . $this->model . "', ";
        // $sql .= "'" . $this->year . "', ";
        // $sql .= "'" . $this->body_type . "', ";
        // $sql .= "'" . $this->colour . "', ";
        // $sql .= "'" . $this->mileage_km . "', ";
        // $sql .= "'" . $this->price . "', ";
        // $sql .= "'" . $this->fuel_type . "', ";
        // $sql .= "'" . $this->description . "', ";
        // $sql .= "'" . $this->condition_id . "', ";
        // $sql .= "'" . $this->image . "'";
        // $sql .= ")";

        $result = self::$database->query($sql);
        if($result) {
            $this->id = self::$database->insert_id;
        }
        
        return $result;
    }

    // Properties which have database columns, excluding ID
    public function attributes() {
        $attributes = [];
        foreach (self::$db_columns as $column) {
            if ($column == 'id') {
                continue; // Skip id as it's auto-generated and incremented
            }
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    protected function sanitized_attributes() {
        $sanitized = [];
        foreach ($this->attributes() as $key => $value) {
            $sanitized[$key] = self::$database->escape_string($value);
        }
        return $sanitized;
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
        $this->model = !empty($args['model']) ? $args['model'] : 'Unknown';
        $this->year = $args['year'] ?? 0;
        $this->body_type = $args['body_type'] ?? 'Unknown';
        $this->colour = $args['colour'] ?? 'Unknown';
        $this->mileage_km = $args['mileage_km'] ?? 0;
        $this->price = $args['price'] ?? 0;
        $this->fuel_type = $args['fuel_type'] ?? 'Unknown';
        $this->description = !empty($args['description']) ? $args['description'] : 'Unknown';
        $this->condition_id = $args['condition_id'] ?? 0;
        $this->image = $args['image'] ?? 'default.png';
    }

    public static function year_options() {
        $years = [];
        for ($year = 1998; $year <= date('Y'); $year++) {
            $years[] = $year;
        }
        rsort($years);
        return $years;
    }

    public function condition() {
        if ($this->condition_id > 0) {
            return self::CONDITION_OPTIONS[$this->condition_id];
        } else {
            return "Unknown";
        }
    }

    public function image() {

        if (self::find_by_image($this->image)) {
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
        return "CAD $" . number_format($this->price);
    }

    public function mileage() {
        return number_format(h($this->mileage_km)) . " km";
    }


}

?>