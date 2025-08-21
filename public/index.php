<?php
require_once('../private/initialize.php');
$page_title = 'Inventory';

if (is_post_request()) {

    // Filiter cars
    $selected_make = $_POST['make'];
    $selected_body = $_POST['body_type'];
    $selected_price = $_POST['price'];

    $conditions = [];

    if ($selected_make && $selected_make !== 'all_makes') {
        $conditions[] = "make = '" . $selected_make . "'";
    }
    if ($selected_price && $selected_price !== 'all_prices') {
        $conditions[] = "price <= " . (int)$selected_price;
    }
    if ($selected_body && $selected_body !== 'all_bodys') {
        $conditions[] = "body_type = '" . $selected_body . "'";
    }

    $sql = "SELECT * FROM cars ";
    if (!empty($conditions)) {
        $sql .= "WHERE " . join(' AND ', $conditions);
    }

    $cars = Car::find_by_sql($sql);
} else {

    /** @var Car[] $cars */
    $cars = Car::find_all();
}


include(SHARED_PATH . '/public_navigation.php');
?>

<div class="website_content">

    <section class="section_container">

        <div class="section_content">

            <div class="hero_container">

                <div class="heading_container" style="text-align: center;">
                    <h1 style="margin-top:0px;">Lineup of the Usual Suspects</h1>
                    <p>Find new, used, and certified pre-owned vehicles with clean records and killer deals.</p>
                </div>

                <form class="search_container" action="index.php" method="post">

                    <!-- Make Filter -->
                    <select class="drop_down" name="make" id="make">
                        <option value="all_makes">All makes<i class="bi bi-caret-down-fill" style="color:black;"></i></option>
                        <optgroup label="Makes">
                            <?php foreach ($makes as $option_name) { ?>
                                <?php if ($option_name == $selected_make) { ?>
                                    <option value="<?php echo $option_name; ?>" selected><?php echo $option_name; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </optgroup>
                    </select>

                    <!-- Body Type Filter -->
                    <select class="drop_down" name="body_type" id="body_type">
                        <option value="all_bodys">All body types<i class="bi bi-caret-down-fill" style="color:black;"></i></option>
                        <optgroup label="Body Types">
                            <?php foreach ($bodys as $option_name) { ?>
                                <?php if ($option_name == $selected_body) { ?>
                                    <option value="<?php echo $option_name; ?>" selected><?php echo $option_name; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </optgroup>
                    </select>

                    <!-- Price Filter -->
                    <select class="drop_down" name="price" id="price">
                        <option value="all_prices">No max price<i class="bi bi-caret-down-fill" style="color:black;"></i></option>
                        <optgroup label="Prices">
                            <?php foreach ($prices as $option_value => $option_name) { ?>
                                <?php if ($option_value == $selected_price) { ?>
                                    <option value="<?php echo $option_value; ?>" selected><?php echo $option_name; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $option_value; ?>"><?php echo $option_name; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </optgroup>
                    </select>

                    <button class="primary_button">
                        <i class="bi bi-search" style="font-size:14px; font-weight:bold; stroke-width:2.5;"></i>Search
                    </button>

                </form>

            </div>

        </div>

    </section>

    <section class="section_container">

        <div class="section_content">

            <div class="item_box">

                <?php
                if (empty($cars)) {
                    echo "<p>No cars found matching your search filters.</p>";
                }
                ?>

                <div class="grid_layout">
                    <?php foreach ($cars as $car) { ?>
                        <a class="car_link" href="detail.php?id=<?php echo $car->id; ?>">

                            <div class="image_boundary">
                                <img class="car_preview_thumbnail" src="<?php echo h($car->image()) ?>" alt="<?php echo h($car->name()) ?>">
                            </div>

                            <div class="car_details">
                                <div class="pill_group">
                                    <span class="headline_pill"><?php echo h($car->condition()); ?></span>
                                    <span class="headline_pill"><?php echo h($car->mileage()); ?></span>
                                    <span class="headline_pill"><?php echo h($car->body_type); ?></span>
                                </div>
                                <h4><?php echo h($car->name()) ?></h4>
                                <p><?php echo h($car->price()); ?></p>
                            </div>

                        </a>
                    <?php } ?>
                </div>
            </div>


        </div>

    </section>

</div>

<?php
include(SHARED_PATH . '/public_mobile_menu.php');
include(SHARED_PATH . '/public_footer.php');
?>