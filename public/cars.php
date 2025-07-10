<?php require_once('../private/initialize.php'); ?>

<?php require_once(SHARED_PATH . '/public_navigation.php'); ?>

<?php require_once(SHARED_PATH . '/public_footer.php'); ?>

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

<div class="section_container container">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Make</th>
                <th scope="col">Model</th>
                <th scope="col">Year</th>
                <th scope="col">Body Type</th>
                <th scope="col">Color</th>
                <th scope="col">Mileage (km)</th>
                <th scope="col">Price</th>
                <th scope="col">Fuel Type</th>
                <th scope="col">Condition</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">

            <?php foreach($car_array as $args) {?>
                <?php $car = new Car($args); ?>

            <tr>
                <td><?php echo h($car->make); ?></td>
                <td><?php echo h($car->model); ?></td>
                <td><?php echo h($car->year); ?></td>
                <td><?php echo h($car->body_type); ?></td>
                <td><?php echo h($car->color); ?></td>
                <td><?php echo h($car->mileage_km); ?></td>
                <td><?php echo h('$' . number_format($car->price, 2)); ?></td>
                <td><?php echo h($car->fuel_type); ?></td>
                <td><?php echo h($car->condition()); ?></td>
            </tr>

            <?php } ?>

        </tbody>
    </table>

</div>