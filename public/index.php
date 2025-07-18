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

    <section class="hero_section">

        <div class="section_content">
            <div class="heading_container">
                <h1>Inventory</h1>
                <p>Find new, used, and certified pre-owned car in Ottawa.</p>
            </div>
            <form class="search_container">
                <select class="custom_select" name="cars" id="cars">
                    <option value="" disabled selected>Make</option>
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="opel">Opel</option>
                    <option value="audi">Audi</option>
                </select>
                <select class="custom_select" name="cars" id="cars">
                    <option value="" disabled selected>Model</option>
                    <option value="saab">Saab</option>
                    <option value="opel">Opel</option>
                    <option value="audi">Audi</option>
                </select>
                <select class="custom_select" name="cars" id="cars">
                    <option value="" disabled selected>Budget</option>
                    <option value="saab">$0 - $1,000</option>
                    <option value="opel">$1,000 - $5,000</option>
                    <option value="audi">$5,000 - $10,000</option>
                </select>
                <button class="primary_button">Search</button>
            </form>
        </div>

    </section>

    <section class="section_container">

        <div class="section_content">

            <div class="grid_layout">
                <?php foreach($cars as $car) {?>
                <a class="car_link" href="detail.php?id=<?php echo $car->id; ?>">

                    <div class="image_boundary"><img class="car_preview_thumbnail" src="<?php echo h($car->image_path); ?>" ></div>

                    <div class="car_details">
                        <span class="headline_pill"><?php echo h($car->condition()); ?></span>
                        <h4><?php echo $car->name(); ?></h4>
                        <p><?php echo h($car->price()); ?></p>
                    </div>

                </a>
                <?php } ?>
            </div>
            
        </div>

    </section>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>