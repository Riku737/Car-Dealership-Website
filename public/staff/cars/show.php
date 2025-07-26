<?php require_once('../../..//private/initialize.php');?>

<?php

$id = $_GET['id'] ?? false;

if (!$id) {

    redirect_to('index.php');

}

$car = Car::find_by_id($id);

?>

<?php include(SHARED_PATH . '/staff_navigation.php'); ?>

<div class="website_content">

    <section class="section_container">


        <div class="section_content">

            <h1><?php echo h($car->name()); ?></h1>

            <div class="content_container">
    
                <div class="item_box">
    
                    <table class="table_section">
                        <tbody>
                            <tr>
                                <th style="width:50%;">ID</th>
                                <td style="width:50%;"><?php echo h($car->id); ?></td>
                            </tr>
                            <tr>
                                <th>Make</th>
                                <td><?php echo h($car->make); ?></td>
                            </tr>
                            <tr>
                                <th>Model</th>
                                <td><?php echo h($car->model); ?></td>
                            </tr>
                            <tr>
                                <th>Year</th>
                                <td><?php echo h($car->year); ?></td>
                            </tr>
                            <tr>
                                <th>Body Type</th>
                                <td><?php echo h($car->body_type); ?></td>
                            </tr>
                            <tr>
                                <th>Colour</th>
                                <td><?php echo h($car->colour); ?></td>
                            </tr>
                            <tr>
                                <th>Mileage (km)</th>
                                <td><?php echo h(number_format($car->mileage_km)); ?></td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td><?php echo h($car->price()); ?></td>
                            </tr>
                            <tr>
                                <th>Fuel Type</th>
                                <td><?php echo h($car->fuel_type); ?></td>
                            </tr>
                            <tr>
                                <th>Condition</th>
                                <td><?php echo h($car->condition()); ?></td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td><?php echo h($car->description); ?></td>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <td><img class="item_thumbnail" src="../../<?php echo h($car->image_path)?>"></td>
                            </tr>
                        </tbody>
    
                    </table>
    
                </div>
    
            </div>

        </div>

    </section>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>