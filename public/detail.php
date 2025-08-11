<?php
// Initalize files
require_once('../private/initialize.php');

if (!isset($_GET['id'])) {
    redirect_to('index.php');
}

$id = $_GET['id'];

/** @var Car $car */
$car = Car::find_by_id($id);
$page_title = $car->name();

// Navigation component
include(SHARED_PATH . '/public_navigation.php');
?>

<div class="website_content">
    
    <section class="section_container">
    
        <div class="section_content">
    
            <div class="heading_container">
                <div class="breadcrumb_menu">
                    <a class="link" href="<?php echo 'index.php' ?>">Inventory</a>
                    <p>/</p>
                    <p><?php echo h($car->name()) ?></p>
                </div>
                <div class="pill_group">
                    <span class="headline_pill"><?php echo h($car->condition()); ?></span>
                    <span class="headline_pill"><?php echo h($car->mileage()); ?></span>
                    <span class="headline_pill"><?php echo h($car->body_type); ?></span>
                </div>
                <h1 style="margin-top:7px; margin-bottom: 3px;"><?php echo h($car->name())?></h1>
                <h2><?php echo h($car->price()) ?></h2>
            </div>
    
    
            <img class="item_thumbnail" src="<?php echo h($car->image())?>" alt="<?php echo h($car->name()) ?>">
    
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
                                <th>Mileage</th>
                                <td><?php echo h($car->mileage()); ?></td>
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

            <div class="content_container">

                <div class="item_box car_banner">

                    <h2>Found the One?</h2>
                    <p>If this ride checks all your boxes, don’t let it slip away. Let’s make your next move easy.</p>
                    <a class="primary_button" href="<?php echo url_for('/index.php'); ?>">Get more info</a>

                </div>


            </div>
    
        </div>
    
    </section>

</div>


<?php 
// Footer component
include(SHARED_PATH . '/public_footer.php'); 
?>