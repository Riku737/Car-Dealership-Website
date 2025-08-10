<?php require_once('../../..//private/initialize.php');?>

<?php 

if (!isset($_GET['id'])) {
    redirect_to('index.php');
}

$id = $_GET['id'];
$car = Car::find_by_id($id);
if ($car == false) {
    redirect_to(url_for('/staff/cars/index.php'));
}

if (is_post_request()) {

    $args = [];
    $args['make'] = $_POST['make'] ?? null;
    $args['model'] = $_POST['model'] ?? null;
    $args['year'] = $_POST['year'] ?? null;
    $args['body_type'] = $_POST['body_type'] ?? null;
    $args['colour'] = $_POST['colour'] ?? null;
    $args['mileage_km'] = $_POST['mileage'] ?? null;
    $args['price'] = $_POST['price'] ?? null;
    $args['fuel_type'] = $_POST['fuel_type'] ?? null;
    $args['condition_id'] = $_POST['condition'] ?? null;
    $args['description'] = $_POST['description'] ?? null;

    if (!empty($_FILES['image']['name'])) {
        $file_name = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        $folder = __DIR__ . '/../../images/' . $file_name;
        move_uploaded_file($tempname, $folder);
        $args['image'] = $file_name;
    } else {
        $args['image'] = $car->image; // Keep existing image
    }

    $car->merge_attributes($args);
    $result = $car->update();

    if ($result === true) {
        $_SESSION['message'] = 'The car was updated successfully.';
        redirect_to(url_for('/staff/cars/show.php?id=' . $id));
    } else {
        // Show errors
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
                    <p>Edit</p>
                </div>
                <h1><?php echo h($car->name()); ?></h1>
            </div>

            <form class="form_container" action="<?php echo url_for('/staff/cars/edit.php?id=' . $id); ?>" method="post" enctype="multipart/form-data">
                
                <div class="form_box">
                    <h4>Make</h4>
                    <select class="drop_down" name="make">
                        <option selected disabled value="">Select make</option>
                        <?php foreach ($makes as $option_name) { ?>
                            <?php if ($option_name == $car->make) { ?>
                                <option selected value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                            <?php } else {?>
                                <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <div class="form_box">
                    <h4>Model</h4>
                    <input class="text_field" type="text" id="model" name="model" value="<?php echo h($car->model); ?>" placeholder="Enter model name">
                </div>

                <div class="form_box">
                    <h4>Year</h4>
                    <select class="drop_down" name="year">
                        <option selected disabled value="">Select year</option>
                        <?php foreach (Car::year_options() as $option_name) { ?>
                            <?php if ($option_name == $car->year) { ?>
                                <option selected value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                            <?php } else {?>
                                <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <div class="form_box">
                    <h4>Body Type</h4>
                    <select class="drop_down" name="body_type" id="body_type">
                        <option selected disabled value="">Select body type</option>
                        <?php foreach ($bodys as $option_name) { ?>
                            <?php if ($option_name == $car->body_type) { ?>
                                <option selected value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                            <?php } else {?>
                                <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <div class="form_box">
                    <h4>Colour</h4>
                    <select class="drop_down" name="colour" id="colour">
                        <option selected disabled value="">Select colour</option>
                        <?php foreach ($colours as $option_name) { ?>
                            <?php if ($option_name == $car->colour) { ?>
                                <option selected value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                            <?php } else {?>
                                <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <div class="form_box">
                    <h4>Mileage (km)</h4>
                    <input class="text_field" type="number" step="1" id="mileage" name="mileage" value="<?php echo h($car->mileage_km); ?>" placeholder="Enter mileage in km">
                    <small>Mileage will be rounded to nearest whole number.</small>
                </div>

                <div class="form_box">
                    <h4>Price ($)</h4>
                    <input class="text_field" type="number" step="1" id="price" name="price" value="<?php echo h($car->price); ?>" placeholder="Enter price in CAD">
                    <small>Price will be rounded to nearest whole number.</small>
                </div>

                <div class="form_box">
                    <h4>Fuel Type</h4>
                    <select class="drop_down" name="fuel_type">
                        <option selected disabled value="">Select fuel type</option>
                        <?php foreach (Car::FUEL_OPTIONS as $option_name) { ?>
                            <?php if ($option_name == $car->fuel_type) { ?>
                                <option selected value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                            <?php } else {?>
                                <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <div class="form_box">
                    <h4>Condition</h4>
                    <select class="drop_down" name="condition_id">
                        <option selected disabled value="">Select condition</option>
                        <?php foreach (Car::CONDITION_OPTIONS as $option_id => $option_name) { ?>
                            <?php if ($option_id == $car->condition_id) { ?>
                                <option selected value="<?php echo $option_id; ?>"><?php echo $option_name; ?></option>
                            <?php } else {?>
                                <option value="<?php echo $option_id; ?>"><?php echo $option_name; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <div class="form_box description_box">
                    <h4>Description</h4>
                    <textarea class="text_field description_text" type="text" id="description" name="description" placeholder="Enter brief vehicle description"><?php echo h($car->description); ?></textarea>
                </div>

                <div class="form_box image_box">
                    <h4>Image</h4>
                    <div class="image_display">
                        <img id="image_preview" alt="Image preview" src="../../<?php echo h($car->image())?>">
                        <span id="image_name"><?php echo h($car->image); ?></span>
                    </div>
                    <label for="image" class="image_button">
                        <input class="text_field image_button" type="file" id="image" name="image" accept=".jpg, .jpeg, .png">
                        <p><i class="bi bi-upload"></i>Upload Image</p>
                        <small style="font-weight: normal;">jpg, jpeg, png formats</small>
                    </label>
                </div>

                <div class="form_buttons">
                    <button type="submit" class="primary_button">Save changes</button>
                    <a href="<?php echo url_for('/staff/cars/index.php'); ?>" class="tertiary_button">Cancel</a>
                </div>


            </form>

        </div>

    </section>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>

<script>
document.getElementById('image').addEventListener('change', function(event) {

    const [file] = event.target.files;
    const imageName = document.getElementById('image_name');
    const imagePreview = document.getElementById('image_preview');
    const imageDisplay = document.querySelector('.image_display');

    if (file) {
        imageName.textContent = file.name;
        imagePreview.src = URL.createObjectURL(file);
        imageDisplay.style.display = 'flex';
    } else {
        imageName.textContent = '';
        imagePreview.src = '';
        imageDisplay.style.display = 'none';
    }

});
</script>