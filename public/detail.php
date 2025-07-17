<?php
// Initalize files
require_once('../private/initialize.php');

$id = $_GET['id'] ?? false;

if (!$id) {
    redirect_to('index.php');
}

$car = Car::find_by_id($id);
$page_title = $car->name();

// Navigation component
include(SHARED_PATH . '/public_navigation.php');
?>

<div class="website_content">
    
    <section class="section_container">
    
        <div class="section_content">
    
            <div class="heading_container">
                <span class="headline_pill"><?php echo h($car->condition()); ?></span>
                <h1><?php echo h($car->name())?></h1>
                <h2><?php echo h($car->price()) ?></h2>
            </div>
    
            <div class="item_box">
    
                <img class="item_thumbnail" src="<?php echo h($car->image_path)?>">
    
            </div>
    
            <div class="content_container">
    
                <h2>Description</h2>
    
                <div class="item_box">
                    <p><?php echo h($car->description); ?></p>
                </div>
    
            </div>
    
            <div class="content_container">
    
                <h2>Specifications</h2>
    
                <div class="item_box">
    
                    <table class="table_section">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td><?php echo h($car->id); ?></td>
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
                        </tbody>
    
                    </table>
    
                </div>
    
            </div>
    
        </div>
    
    </section>

</div>


<?php 
// Footer component
include(SHARED_PATH . '/public_footer.php'); 
?>