<?php require_once('../../private/initialize.php'); ?>

<?php include(SHARED_PATH . '/staff_navigation.php'); ?>

<?php $cars = Car::find_all(); ?>

<div class="website_content">

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
                            <th>Colour</th>
                            <th>Mileage (km)</th>
                            <th>Price</th>
                            <th>Condition</th>
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
                            <td><a href="detail.php?id=<?php echo $car->id; ?>">View</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
    
                </table>
    
            </div>
    
        </div>
    
    </section>

</div>


<?php include(SHARED_PATH . '/public_footer.php'); ?>