<?php
require_once('../private/initialize.php'); 
$page_title = 'Inventory';
?>

<?php include(SHARED_PATH . '/public_navigation.php'); ?>

<?php

if (is_post_request()) {
    // Handle form submission
    $selected_make = $_POST['make'] ?? 'all_makes';
    $selected_body = $_POST['body_type'] ?? 'all_bodys';
    $selected_budget = $_POST['budget'] ?? 'all_budgets';

}

/** @var Car[] $cars */
$cars = Car::find_all();

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
                    <select class="custom_select" name="make" id="make">
                        <option value="all_makes" selected>All makes<i class="bi bi-caret-down-fill" style="color:black;"></i></option>
                        <optgroup label="Makes">
                            <?php foreach ($makes as $option_name) { ?>
                                <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                            <?php } ?>
                        </optgroup>
                    </select>
                    <select class="custom_select" name="body_type" id="body_type">
                        <option value="all_bodys" selected>All body types<i class="bi bi-caret-down-fill" style="color:black;"></i></option>
                        <optgroup label="Body Types">
                            <?php foreach ($bodys as $option_name) { ?>
                                <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                            <?php } ?>
                        </optgroup>
                    </select>
                    <select class="custom_select" name="budget" id="budget">
                        <option value="all_budgets" selected>All budgets<i class="bi bi-caret-down-fill" style="color:black;"></i></option>
                        <optgroup label="Budgets">
                            <option value="saab">$0 - $5,000</option>
                            <option value="opel">$5,000 - $10,000</option>
                            <option value="audi">$10,000 - $15,000</option>
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

            <h2>All Vehicles</h2>

            <div class="grid_layout">
                <?php foreach($cars as $car) {?>
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

    </section>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>