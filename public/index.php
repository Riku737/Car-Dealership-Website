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

<section class="section_container">

    <div class="section_content">

        <div class="heading_container">
            <h1>Inventory</h1>
            <p>Find new, used, and certified pre-owned car in Ottawa.</p>
        </div>

        <div class="grid_layout">
            <?php foreach($cars as $car) {?>
            <a class="item_box car_link" href="detail.php?id=<?php echo $car->id; ?>">

                <img class="car_preview_thumbnail" src="<?php echo h($car->image_path); ?>" >

                <div class="car_details">
                    <small><?php echo h($car->mileage()); ?></small>
                    <h3><?php echo $car->name(); ?></h3>
                    <h4><?php echo h($car->price()); ?></h4>
                </div>

            </a>
            <?php } ?>
        </div>
        
    </div>

</section>

<?php include(SHARED_PATH . '/public_footer.php'); ?>