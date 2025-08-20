<?php
require_once('../../../private/initialize.php');
$page_title = 'Car Inventory';
require_login(); // Admin protect page

$current_page = $_GET['page'] ?? 1;
$per_page = 10;
$total_count = Car::count_all();

$pagination = new Pagination($current_page, $per_page, $total_count);

// /** @var Car[] $cars */
// $cars = Car::find_all();

$sql = "SELECT * FROM cars ";
$sql .= "LIMIT " . $per_page . " ";
$sql .= "OFFSET " . $pagination->offset();
$cars = Car::find_by_sql($sql);

include(SHARED_PATH . '/staff_navigation.php');
?>

<div class="website_content">

    <section class="section_container">

        <div class="section_content">

            <?php echo display_session_message(); ?>

            <div class="heading_container">
                <div class="breadcrumb_menu">
                    <a class="link" href="<?php echo url_for('/staff/index.php'); ?>">Staff</a>
                    <p>Inventory</p>
                </div>
                <div class="split_container">
                    <div class="left_split">
                        <h1>Inventory</h1>
                        <p>Database for vehicles in stock.</p>
                    </div>
                    <div class="right_split">
                        <a class="primary_button" href="<?php echo url_for('/staff/cars/new.php'); ?>"><i class="bi bi-plus-lg"></i>Add vehicle</a>
                    </div>
                </div>
            </div>

            <div class="item_box">

                <table class="table_section">
                    <thead>
                        <tr>
                            <th style="width:5%">ID</th>
                            <th style="width:25%">Make</th>
                            <th style="width:25%">Model</th>
                            <th style="width:5%">Body</th>
                            <th style="width:5%">Year</th>
                            <th style="width:5%">Colour</th>
                            <th style="width:5%">Mileage</th>
                            <th style="width:5%">Price</th>
                            <th style="width:5%">Condition</th>
                            <th style="width:5%">&nbsp;</th>
                            <th style="width:5%">&nbsp;</th>
                            <th style="width:5%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cars as $car) { ?>
                            <tr>
                                <td><?php echo h($car->id); ?></td>
                                <td><?php echo h($car->make); ?></td>
                                <td><?php echo h($car->model); ?></td>
                                <td><?php echo h($car->body_type); ?></td>
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

                <?php $pagination->page_links(url_for('/staff/cars/index.php')); ?>

            </div>


        </div>

    </section>

</div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>