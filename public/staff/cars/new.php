<?php 

require_once('../../../private/initialize.php');
$page_title = 'New Car';
require_login(); // Admin protect page

if (is_post_request()) {

    // Create record using post parameters
    $args = $_POST['car'];
    $args['image'] = $_FILES['image']['name'];

    // If an image is uploaded, store file in the designated images folder
    if (!empty($_FILES['image']['name'])) {
        $file_name = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        $folder = __DIR__ . '/../../images/' . $file_name;
        move_uploaded_file($tempname, $folder);
    }

    // Create a new Car object with the provided arguments
    $car = new Car($args);
    // Validate and save the car to database. Return whether successful insertion
    $result = $car->save();

    if ($result === true) { // If the car was saved successfully
        $new_id = $car->id;
        $session->message('The car was created successfully.');
        redirect_to(url_for('/staff/cars/show.php?id=' . $new_id));
    }

} else {

    // Not a post request, or form submission. Loading the form for the first time.
    $car = new Car();

}

include(SHARED_PATH . '/staff_navigation.php');
?>

<div class="website_content">

    <section class="section_container">
    
        <div class="section_content">

            <div class="heading_container">
                <div class="breadcrumb_menu">
                    <a class="link" href="<?php echo url_for('/staff/index.php'); ?>">Staff</a><p>/</p><a class="link" href="<?php echo url_for('/staff/cars/index.php'); ?>">Inventory</a><p>/</p><p>New</p>
                </div>
                <h1>Add vehicle to inventory</h1>
            </div>

            <?php echo display_errors($car->errors); ?>

            <form class="form_container" action="<?php echo url_for('/staff/cars/new.php');?>" method="POST" enctype="multipart/form-data">

                <?php include('form_fields.php'); ?>

                <div class="form_buttons">
                    <button type="submit" class="primary_button" name="submit">Add vehicle</button>
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