<?php

class Car {

    // Instance variables
    public $make;
    public $model;
    public $year;
    public $body_type;
    public $color;
    public $mileage_km;
    public $price;
    public $fuel_type;
    protected $condition_id;

    // Constants
    public const CATEGORIES = ['Sedan', 'SUV', 'Coupe', 'Hatchback', 'Convertible', 'Pickup', 'Van', 'Sports', 'Crossover'];
    public const COLOR = ['Black', 'Gray', 'Silver', 'White', 'Blue', 'Red'];
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
        $this->color = $args['color'] ?? '';
        $this->mileage_km = $args['mileage_km'] ?? 0;
        $this->price = $args['price'] ?? 0.0;
        $this->fuel_type = $args['fuel_type'] ?? '';
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