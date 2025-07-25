<?php require_once('../../..//private/initialize.php'); ?>

<?php include(SHARED_PATH . '/staff_navigation.php'); ?>

<?php $cars = Car::find_all(); ?>

<div class="website_content">

    <section class="section_container">
    
        <div class="section_content">

            <div class="heading_container">
                <h1>Inventory</h1>
                <p>Find new, used, and certified pre-owned cars.</p>
            </div>

            <div class="item_box">
    
                <table class="table_section">
                    <thead>
                        <tr>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>Body Type</th>
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
                            <td><?php echo h($car->body_type); ?></td>
                            <td><?php echo h($car->colour); ?></td>
                            <td><?php echo h(number_format($car->mileage_km)); ?></td>
                            <td><?php echo h('$' . number_format($car->price, 2)); ?></td>
                            <td><?php echo h($car->condition()); ?></td>
                            <td><a class="link" href="show.php?id=<?php echo $car->id; ?>">View</a></td>
                            <td><a class="link" href="detail.php?id=<?php echo $car->id; ?>">Edit</a></td>
                            <td><a class="link" href="detail.php?id=<?php echo $car->id; ?>">Delete</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
    
                </table>
    
            </div>
    
        </div>
    
    </section>

</div>


<?php include(SHARED_PATH . '/public_footer.php'); ?>