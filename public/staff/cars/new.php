<?php require_once('../../..//private/initialize.php');?>

<?php 

if (is_post_request()) {

    // Create record using post parameters
    $args = [];
    $args['make'] = $_POST['make'] ?? null;
    $args['model'] = $_POST['model'] ?? null;
    $args['year'] = $_POST['year'] ?? null;
    $args['body_type'] = $_POST['body_type'] ?? null;
    $args['colour'] = $_POST['colour'] ?? null;
    $args['mileage'] = $_POST['mileage'] ?? null;
    $args['price'] = $_POST['price'] ?? null;
    $args['condition'] = $_POST['condition'] ?? null;
    $args['description'] = $_POST['description'] ?? null;
    
    $car = new Car($args);
    $result = $car->create();

    if ($result === true) {
        $new_id = $car->id;
        $_SESSION['message'] = 'The car was created successfully.';
        redirect_to(url_for('/staff/cars/show.php?id=' . $new_id));
    }

}

?>

<?php include(SHARED_PATH . '/staff_navigation.php'); ?>

<div class="website_content">

    <section class="section_container">
    
        <div class="section_content">

            <div class="heading_container">
                <div class="breadcrumb_menu">
                    <a class="link" href="<?php echo url_for('/staff/index.php'); ?>">Staff</a>
                    <p>/</p>
                    <a class="link" href="<?php echo url_for('/staff/cars/index.php'); ?>">Inventory</a>
                    <p>/</p>
                    <p>Add vehicle</p>
                </div>
                <h1>Add vehicle</h1>
            </div>

            <form class="form_container" action="<?php echo url_for('/staff/cars/new.php'); ?> method="POST">
                
                <div class="form_box">
                    <h4>Make</h4>
                    <input class="text_field" type="text"  name="make">
                </div>
                <div class="form_box">
                    <h4>Model</h4>
                    <input class="text_field" type="text" name="model">
                </div>
                <div class="form_box">
                    <h4>Year</h4>
                    <input class="text_field" type="text"name="year">
                </div>
                <div class="form_box">
                    <h4>Body Type</h4>
                    <select class="drop_down" name="body_type">
                        <option value=""></option>
                        <option value="sedan">Sedan</option>
                        <option value="suv">SUV</option>
                        <option value="coupe">Coupe</option>
                        <option value="hatchback">Hatchback</option>
                        <option value="convertible">Convertible</option>
                        <option value="pickup">Pickup</option>
                        <option value="van">Van</option>
                        <option value="sports">Sports</option>
                        <option value="crossover">Crossover</option>
                        <option value="motorbike">Motorbike</option>
                    </select>
                </div>
                <div class="form_box">
                    <h4>Colour</h4>
                    <select class="drop_down" name="colour">
                        <option value=""></option>
                        <option value="black">Black</option>
                        <option value="gray">Gray</option>
                        <option value="silver">Silver</option>
                        <option value="white">White</option>
                        <option value="blue">Blue</option>
                        <option value="red">Red</option>
                    </select>
                </div>
                <div class="form_box">
                    <h4>Mileage (km)</h4>
                    <input class="text_field" type="text" name="mileage">
                </div>
                <div class="form_box">
                    <h4>Price ($)</h4>
                    <input class="text_field" type="text" name="price">
                </div>
                <div class="form_box">
                    <h4>Condition</h4>
                    <select class="drop_down" id="condition">
                        <option value=""></option>
                        <option value="1">New</option>
                        <option value="2">Certified Pre-Owned</option>
                        <option value="3">Used</option>
                    </select>
                </div>
                <div class="form_box description_box">
                    <h4>Description</h4>
                    <textarea class="text_field" type="text" name="description"></textarea>
                </div>

                <button type="submit" class="primary_button">Add vehicle</button>

            </form>

        </div>

    </section>

</div>


<?php include(SHARED_PATH . '/public_footer.php'); ?>