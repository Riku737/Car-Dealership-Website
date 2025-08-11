<?php

class Car {

    // ACTIVE RECORD CODE
    protected static $database;
    protected static $db_columns = ['make', 'model', 'year', 'body_type', 'colour', 'mileage_km', 'price', 'fuel_type', 'description', 'condition_id', 'image'];
    public $errors = [];

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

    // Validates whether file name exists in images folder
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

    protected function validate() {
        $this->errors = []; // Reset errors array

        if (is_blank($this->make)) {
            $this->errors['make'] = "Make cannot be blank.";
        }
        if (is_blank($this->model)) {
            $this->errors['model'] = "Model cannot be blank.";
        }
        if (is_blank($this->year)) {
            $this->errors['year'] = "Year cannot be blank.";
        }
        if (is_blank($this->body_type)) {
            $this->errors['body_type'] = "Body type cannot be blank.";
        }
        if (is_blank($this->colour)) {
            $this->errors['colour'] = "Colour cannot be blank.";
        }
        if (is_blank($this->mileage_km)) {
            $this->errors['mileage_km'] = "Mileage cannot be blank.";
        }
        if (is_blank($this->price)) {
            $this->errors['price'] = "Price cannot be blank.";
        }
        if (is_blank($this->fuel_type)) {
            $this->errors['fuel_type'] = "Fuel type cannot be blank.";
        }
        if (is_blank($this->description)) {
            $this->errors['description'] = "Description cannot be blank.";
        }
        if (is_blank($this->condition_id)) {
            $this->errors['condition_id'] = "Condition cannot be blank.";
        }
        if (is_blank($this->image)) {
            $this->errors['image'] = "Image cannot be blank.";
        }
        
        return $this->errors;
    }

    // Create a new car record
    protected function create() {
        $this->validate();
        if (!empty($this->errors)) {
            return false;
        }

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

    // Update car record
    protected function update() {
        $this->validate();
        if (!empty($this->errors)) {
            return false;
        }

        $attributes = $this->sanitized_attributes();
        $attribute_pairs = [];
        foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE cars SET ";
        $sql .= join(', ', $attribute_pairs);
        $sql .= " WHERE id='" . self::$database->escape_string($this->id) . "' ";
        $sql .= "LIMIT 1";
        $result = self::$database->query($sql);
        return $result;
    }

    public function save() {
        // A new record will not have an ID yet
        if (isset($this->id)) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    // Merges the provided associative array of attributes into the current object
    public function merge_attributes($args=[]) {
        foreach($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
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
        $this->make = $args['make'] ?? null;
        $this->model = $args['model'] ?? null;
        $this->year = $args['year'] ?? null;
        $this->body_type = $args['body_type'] ?? null;
        $this->colour = $args['colour'] ?? null;
        $this->mileage_km = $args['mileage_km'] ?? null;
        $this->price = $args['price'] ?? null;
        $this->fuel_type = $args['fuel_type'] ?? null;
        $this->description = $args['description'] ?? null;
        $this->condition_id = $args['condition_id'] ?? null;
        $this->image = $args['image'] ?? null;
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