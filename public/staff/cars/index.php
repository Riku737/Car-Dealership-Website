<?php 
require_once('../../../private/initialize.php');
$page_title = 'Car Inventory';
require_login();
?>

<?php include(SHARED_PATH . '/staff_navigation.php'); ?>

<?php 

/** @var Car[] $cars */
$cars = Car::find_all();

?>

<div class="website_content">

    <section class="section_container">
    
        <div class="section_content">

            <?php echo display_session_message(); ?>

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
                            <th style="width:5%">ID</th>
                            <th style="width:20%">Make</th>
                            <th style="width:20%">Model</th>
                            <th style="width:5%">Year</th>
                            <th style="width:5%">Colour</th>
                            <th style="width:5%">Mileage</th>
                            <th style="width:5%">Price</th>
                            <th style="width:10%">Condition</th>
                            <th style="width:5%">&nbsp;</th>
                            <th style="width:5%">&nbsp;</th>
                            <th style="width:5%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($cars as $car) {?>
                        <tr>
                            <td><?php echo h($car->id); ?></td>
                            <td><?php echo h($car->make); ?></td>
                            <td><?php echo h($car->model); ?></td>
                            <td><?php echo h($car->year); ?></td>
                            <td><?php echo h($car->colour); ?></td>
                            <td><?php echo h(number_format($car->mileage_km)); ?></td>
                            <td><?php echo h(number_format($car->price)); ?></td>
                            <td><?php echo h($car->condition()); ?></td>
                            <td><a class="link" href="show.php?id=<?php echo h(u($car->id)); ?>">View</a></td>
                            <td><a class="link" href="edit.php?id=<?php echo h(u($car->id)); ?>">Edit</a></td>
                            <td><a class="link" href="delete.php?id=<?php echo h(u($car->id)); ?>">Delete</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
    
                </table>
    
            </div>
    
        </div>
    
    </section>

</div>


<?php include(SHARED_PATH . '/public_footer.php'); ?>