<?php

class Car extends DatabaseObject{

    // ACTIVE RECORD CODE
    protected static $table_name = 'cars';
    protected static $db_columns = ['make', 'model', 'year', 'body_type', 'colour', 'mileage_km', 'price', 'fuel_type', 'description', 'condition_id', 'image'];

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


}

?>