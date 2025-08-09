<?php require_once('../../..//private/initialize.php');?>

<?php

if (is_post_request()) {

    // Create record using post parameters
    $args = [];
    $args['make'] = $_POST['make'];
    $args['model'] = $_POST['model'];
    $args['year'] = $_POST['year'];
    $args['body_type'] = $_POST['body_type'];
    $args['colour'] = $_POST['colour'];
    $args['mileage'] = $_POST['mileage'];
    $args['price'] = $_POST['price'];
    $args['condition'] = $_POST['condition'];
    $args['description'] = $_POST['description'];
    $args['file'] = $_FILES['image'];

    $file_name = $_FILES['image']['name'] ?? null; // Add this line
    $tempname = $_FILES['image']['tmp_name']; // Correct key is 'tmp_name'
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/projects/Car-Dealership-Inventory-System/public/images/' . $file_name;

    move_uploaded_file($tempname, $folder);
    
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
                <h1>Add vehicle to inventory</h1>
            </div>

            <form class="form_container" action="<?php echo url_for('/staff/cars/new.php');?>" method="POST" enctype="multipart/form-data">
                
                <div class="form_box">
                    <h4>Make</h4>
                    <select class="drop_down" name="make">
                        <option selected disabled value="">Select make</option>
                        <?php foreach ($makes as $option_name) { ?>
                            <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form_box">
                    <h4>Model</h4>
                    <input class="text_field" type="text" name="model" placeholder="Enter model name">
                </div>

                <div class="form_box">
                    <h4>Year</h4>
                    <input class="text_field" type="text" name="year" maxlength="4" placeholder="Enter year in YYYY format">
                </div>
                
                <div class="form_box">
                    <h4>Body Type</h4>
                    <select class="drop_down" name="body_type">
                        <option selected disabled value="">Select body type</option>
                        <?php foreach ($bodys as $option_name) { ?>
                            <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form_box">
                    <h4>Colour</h4>
                    <select class="drop_down" name="colour">
                        <option selected disabled value="">Select colour</option>
                        <?php foreach ($colours as $option_name) { ?>
                            <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form_box">
                    <h4>Mileage (km)</h4>
                    <input class="text_field" type="text" name="mileage" placeholder="Enter mileage in km">
                </div>

                <div class="form_box">
                    <h4>Price ($)</h4>
                    <input class="text_field" type="text" name="price" placeholder="Enter price in CAD">
                </div>

                <div class="form_box">
                    <h4>Condition</h4>
                    <select class="drop_down" id="condition">
                        <option selected disabled value="">Select condition</option>
                        <?php foreach (Car::CONDITION_OPTIONS as $option_id => $option_name) { ?>
                            <option value="<?php echo $option_id; ?>"><?php echo $option_name; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form_box description_box">
                    <h4>Description</h4>
                    <textarea class="text_field description_text" type="text" name="description" placeholder="Enter brief vehicle description"></textarea>
                </div>

                <div class="form_box image_box">
                    <h4>Image</h4>
                    <label for="image" class="image_button">
                        <input class="text_field image_button" type="file" id="image" name="image" accept=".jpg, .jpeg, .png">
                        <div>
                            <img id="image_preview" src="#" alt="Image Preview" style="display: none; max-width: 100%; height: auto;">
                        </div>
                        <span>Choose Image</span>
                    </label>
                </div>

                <div class="form_buttons">
                    <button type="submit" class="primary_button" name="submit">Add vehicle</button>
                    <a href="<?php echo url_for('/staff/cars/index.php')?>" class="tertiary_button">Cancel</a>
                </div>

            </form>

        </div>

    </section>

</div>


<?php include(SHARED_PATH . '/public_footer.php'); ?>

<script>
document.getElementById('image').addEventListener('change', function(event) {
    const [file] = event.target.files;
    if (file) {
        const preview = document.getElementById('image_preview');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
});
</script>