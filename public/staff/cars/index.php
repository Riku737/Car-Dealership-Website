<?php require_once('../../..//private/initialize.php'); ?>

<?php include(SHARED_PATH . '/staff_navigation.php'); ?>

<?php 

/** @var Car[] $cars */
$cars = Car::find_all();

?>

<div class="website_content">

    <section class="section_container">
    
        <div class="section_content">

            <div class="heading_container">
                <div class="breadcrumb_menu">
                    <a class="link" href="<?php echo url_for('/staff/index.php'); ?>">Staff</a>
                    <p>/</p>
                    <p>Inventory</p>
                </div>
                <div class="split_container">
                    <div>
                        <h1>Inventory</h1>
                        <p>Database for vehicles in stock.</p>
                    </div>
                    <div class="split_corner">
                        <a class="primary_button" href="new.php">Add vehicle</a>
                    </div>
                </div>
            </div>

            <div class="item_box">
    
                <table class="table_section">
                    <thead>
                        <tr>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>Colour</th>
                            <th>Mileage (km)</th>
                            <th>Price</th>
                            <th>Condition</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($cars as $car) {?>
                        <tr>
                            <td><?php echo h($car->make); ?></td>
                            <td><?php echo h($car->model); ?></td>
                            <td><?php echo h($car->year); ?></td>
                            <td><?php echo h($car->colour); ?></td>
                            <td><?php echo h(number_format($car->mileage_km)); ?></td>
                            <td><?php echo h(number_format($car->price)); ?></td>
                            <td><?php echo h($car->condition()); ?></td>
                            <td><a class="link" href="show.php?id=<?php echo $car->id; ?>">View</a></td>
                            <td><a class="link" href="edit.php?id=<?php echo $car->id; ?>">Edit</a></td>
                            <td><a class="link" href="delete.php?id=<?php echo $car->id; ?>">Delete</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
    
                </table>
    
            </div>
    
        </div>
    
    </section>

</div>


<?php include(SHARED_PATH . '/public_footer.php'); ?>