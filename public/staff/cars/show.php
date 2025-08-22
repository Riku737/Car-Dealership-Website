<?php
require_once('../../..//private/initialize.php');
require_login(); // Ensure user is logged in

$id = $_GET['id'] ?? false;

if (!$id) { // No ID present
    redirect_to('index.php');
}

// Find the car by ID
/** @var Car $car */
$car = Car::find_by_id($id);

$page_title = $car->name(); // Title page based on car name

include(SHARED_PATH . '/staff_navigation.php');
?>

<div class="website_content">

    <section class="section_container">

        <div class="section_content">


            <div class="heading_container">
                <div class="breadcrumb_menu">
                    <a class="link" href="<?php echo url_for('/staff/index.php') ?>">Staff</a>
                    <a class="link" href="<?php echo url_for('/staff/cars/index.php') ?>">Inventory</a>
                    <p>Show</p>
                </div>
                <div class="split_container">
                    <div class="left_split">
                        <h1><?php echo h($car->name()); ?></h1>
                    </div>
                    <div class="right_split">
                        <a class="tertiary_button" href="<?php echo url_for('/staff/cars/edit.php?id=' . h($car->id)); ?>"><i class="bi bi-pencil-fill"></i>Edit car</a>
                    </div>
                </div>

            </div>

            <?php echo display_session_message(); ?>

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
                            <tr>
                                <th>Description</th>
                                <td><?php echo h($car->description); ?></td>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <td style="display: flex; gap: 15px; align-items: center;">
                                    <img style="width:25%" class="item_thumbnail" src="../../<?php echo h($car->image()) ?>" alt="<?php echo h($car->name()) ?>">
                                    <small style="width: 75%;"><?php echo h($car->image) ?></small>
                                </td>
                            </tr>
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>