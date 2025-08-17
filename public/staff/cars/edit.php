<?php 
require_once('../../../private/initialize.php');
$page_title = 'Edit Car';
require_login(); // Admin protect page

if (!isset($_GET['id'])) {
    redirect_to('index.php');
}

$id = $_GET['id'];

/** @var Car $car */
$car = Car::find_by_id($id);
if ($car == false) {
    redirect_to(url_for('/staff/cars/index.php'));
}

if (is_post_request()) {

    $args = $_POST['car'];

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
    $result = $car->save();

    if ($result === true) {
        $session->message('The car was updated successfully.');
        redirect_to(url_for('/staff/cars/show.php?id=' . $id));
    }

} 

include(SHARED_PATH . '/staff_navigation.php'); 
?>

<div class="website_content">

    <section class="section_container">
    
        <div class="section_content">

            <div class="heading_container">
                <div class="breadcrumb_menu">
                    <a class="link" href="<?php echo url_for('/staff/index.php'); ?>">Staff</a>
                    <a class="link" href="<?php echo url_for('/staff/cars/index.php'); ?>">Inventory</a>
                    <p>Edit</p>
                </div>
                <div class="split_container">
                    <div class="left_split">
                        <h1><?php echo h($car->name()); ?></h1>
                    </div>
                    <div class="right_split">
                        <a class="primary_button" href="<?php echo url_for('/staff/cars/delete.php?id=' . h($car->id)); ?>"><i class="bi bi-trash-fill"></i>Delete car</a>
                    </div>
                </div>
            </div>
            

            <?php echo display_errors($car->errors); ?>
            
            <form class="form_container" action="<?php echo url_for('/staff/cars/edit.php?id=' . $id); ?>" method="post" enctype="multipart/form-data">
                
                <?php include('form_fields.php'); ?>

                <div class="form_buttons">
                    <button type="submit" class="primary_button">Save changes</button>
                    <a href="<?php echo url_for('/staff/cars/index.php'); ?>" class="tertiary_button">Cancel</a>
                </div>  


            </form>

        </div>

    </section>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>

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