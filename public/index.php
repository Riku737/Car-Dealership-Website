<?php require_once('../private/initialize.php'); ?>

<?php require_once(SHARED_PATH . '/public_navigation.php'); ?>

<?php

$parser = new ParseCSV(PRIVATE_PATH . '/car_dealership_inventory.csv');
$car_array = $parser->parse();

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

?>

<section class="section_container">

    <div class="section_content">

        <h1>Inventory</h1>
        <h2>Find new, used, and certified pre-owned cars.</h2>

        <div class="item_box">

            <table class="table_section">
                <thead>
                    <tr>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Body Type</th>
                        <th>Color</th>
                        <th>Mileage (km)</th>
                        <th>Price</th>
                        <th>Fuel Type</th>
                        <th>Condition</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($car_array as $args) {?>
                        <?php $car = new Car($args); ?>
                        
                    <tr>
                        <td><?php echo h($car->make); ?></td>
                        <td><?php echo h($car->model); ?></td>
                        <td><?php echo h($car->year); ?></td>
                        <td><?php echo h($car->body_type); ?></td>
                        <td><?php echo h($car->color); ?></td>
                        <td><?php echo h(number_format($car->mileage_km)); ?></td>
                        <td><?php echo h('$' . number_format($car->price, 2)); ?></td>
                        <td><?php echo h($car->fuel_type); ?></td>
                        <td><?php echo h($car->condition()); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>

        
        </div>

    </div>

</section>

<?php require_once(SHARED_PATH . '/public_footer.php'); ?>