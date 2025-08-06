<?php require_once('../private/initialize.php'); ?>

<?php include(SHARED_PATH . '/public_navigation.php'); ?>

<?php

// $parser = new ParseCSV(PRIVATE_PATH . '/car_dealership_inventory.csv');
// $car_array = $parser->parse();

// print_r($car_array);

// $args = [
//     'make' => 'Toyota',
//     'model' => 'Corolla',
//     'year' => 2022,
//     'body_type' => 'Sedan',
//     'color' => 'White',
//     'mileage_km' => 15000,
//     'price' => 18000,
//     'fuel_type' => 'Gasoline',
//     'status' => 'Available',
//     'condition_id' => '1'
// ];

// $car = new Car($args);

$cars = Car::find_all();

?>

<div class="website_content">

    <section class="section_container">

        <div class="section_content">

            <div class="hero_container">
                
                <div class="heading_container" style="text-align: center;">
                    <h1 style="margin-top:0px;">Lineup of the Usual Suspects</h1>
                    <p>Find new, used, and certified pre-owned vehicles with clean records and killer deals.</p>
                </div>
    
                <form class="search_container">
                    <select class="custom_select" name="cars" id="cars">
                        <option value="all_makes" selected>All makes<i class="bi bi-caret-down-fill" style="color:black;"></i></option>
                        <optgroup label="Makes">
                            <option value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option value="opel">Opel</option>
                            <option value="audi">Audi</option>
                        </optgroup>
                    </select>
                    <select class="custom_select" name="cars" id="cars">
                        <option value="all_models" selected>All body types<i class="bi bi-caret-down-fill" style="color:black;"></i></option>
                        <optgroup label="Models">
                            <option value="saab">Saab</option>
                            <option value="opel">Opel</option>
                            <option value="audi">Audi</option>
                        </optgroup>
                    </select>
                    <select class="custom_select" name="cars" id="cars">
                        <option value="all_budgets" selected>All budgets<i class="bi bi-caret-down-fill" style="color:black;"></i></option>
                        <optgroup label="Budgets">
                            <option value="saab">$0 - $5,000</option>
                            <option value="opel">$5,000 - $10,000</option>
                            <option value="audi">$10,000 - $15,000</option>
                        </optgroup>
                    </select>
                    <button class="primary_button">
                        <i class="bi bi-search" style="font-size:14px; font-weight:bold; stroke-width:2.5;"></i>Search
                    </button>
                </form>

            </div>
            
        </div>

    </section>

    <section class="section_container">

        
        <div class="section_content">

            <h2>All Vehicles</h2>

            <div class="grid_layout">
                <?php foreach($cars as $car) {?>
                <a class="car_link" href="detail.php?id=<?php echo $car->id; ?>">

                    <div class="image_boundary"><img class="car_preview_thumbnail" src="<?php echo h($car->image_path); ?>" ></div>

                    <div class="car_details">
                        <div class="pill_group">
                            <span class="headline_pill"><?php echo h($car->condition()); ?></span>
                            <span class="headline_pill"><?php echo h($car->mileage()); ?></span>
                            <span class="headline_pill"><?php echo h($car->body_type); ?></span>
                        </div>
                        <h4><?php echo h($car->name()) ?></h4>
                        <p><?php echo h($car->price()); ?></p>
                    </div>

                </a>
                <?php } ?>
            </div>
            
        </div>

    </section>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>