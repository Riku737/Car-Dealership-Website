<?php

class Car extends DatabaseObject
{

    // ACTIVE RECORD CODES
    protected static $table_name = 'cars';
    protected static $db_columns = ['make', 'model', 'year', 'body_type', 'colour', 'mileage_km', 'price', 'fuel_type', 'description', 'condition_id', 'image'];


    // INSTANCE VARIABLES
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


    // CONSTANTS
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
        'Red',
        'Green'
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
        2 => 'Certified',
        3 => 'Used',
    ];

    public const PRICE_OPTIONS = [
        2000  => '$2,000',
        4000  => '$4,000',
        6000  => '$6,000',
        8000  => '$8,000',
        10000 => '$10,000',
        15000 => '$15,000',
        20000 => '$20,000',
        30000 => '$30,000',
        40000 => '$40,000',
        50000 => '$50,000',
        100000 => '$100,000'
    ];


    // CONSTRUCTOR
    public function __construct($args = [])
    {
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




    // METHODS

    // Returns an array of valid year options for the car
    // Note: array is sorted from recent to oldest years
    public static function year_options()
    {
        $years = [];
        for ($year = 1998; $year <= date('Y'); $year++) {
            $years[] = $year;
        }
        rsort($years);
        return $years;
    }

    // Returns condition based on condition_id of instance
    public function condition()
    {
        if ($this->condition_id > 0) {
            return self::CONDITION_OPTIONS[$this->condition_id];
        } else {
            return "Unknown";
        }
    }

    // Returns the image path for the car image
    public function image()
    {

        if (self::find_by_image($this->image)) {
            return "images/" . $this->image;
        } else {
            return "images/default.png";
        }
    }

    // Validates whether given filename already exists in images folder
    public static function find_by_image($image)
    {
        $dir = __DIR__ . '/../../public/images/'; // Pathway to images directory
        $files = [];

        // Scan the directory to get all files and folders inside images
        // Records filenames in images in $files array
        foreach (scandir($dir) as $file) {
            if ($file !== '.' && $file !== '..' && is_file($dir . $file)) {
                $files[] = $file;
            }
        }

        // Check if the given $image filename exists in the files array
        // Returns true if found, false otherwise
        if (in_array($image, $files)) {
            return true;
        } else {
            return false;
        }
    }

    // Returns the full name of the car
    public function name()
    {
        if (isset($this->year) && isset($this->make) && isset($this->model)) {
            return "{$this->year} {$this->make} {$this->model}";
        } else {
            return "Unknown";
        }
    }

    // Returns full price label
    public function price()
    {
        return "$" . number_format($this->price);
    }

    // Returns full mileage label
    public function mileage()
    {
        return number_format(h($this->mileage_km)) . " km";
    }

    /**
     * Override parent::validate()
     */
    protected function validate()
    {
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
