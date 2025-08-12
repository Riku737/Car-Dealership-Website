<?php 
require_once('../../../private/initialize.php');
$page_title = 'Delete Car';
require_login();
?>

<?php 

$id = $_GET['id'];

if (!isset($id)) {
    redirect_to(url_for('/staff/cars/index.php'));
}

/** @var Car $car */
$car = Car::find_by_id($id);
if ($car == false) {
    redirect_to(url_for('/staff/cars/index.php'));
}

if (is_post_request()) {
    // Delete car

    $result = $car->delete();
    $_SESSION['message'] = "The car was deleted successfully.";
    redirect_to(url_for('/staff/cars/index.php'));

} else {
    // Display form
}

?>

<?php include(SHARED_PATH . '/staff_navigation.php'); ?>

<div class="website_content">

    <section class="section_container">

        <div class="section_content">

            <div class="heading_container">
                <div class="breadcrumb_menu">
                    <a class="link" href="<?php echo url_for('/staff/index.php') ?>">Staff</a>
                    <p>/</p>
                    <a class="link" href="<?php echo url_for('/staff/cars/index.php') ?>">Inventory</a>
                    <p>/</p>
                    <p>Delete</p>
                </div>
                <h1><?php echo h($car->name()); ?></h1>
                <p>Are you sure you want to delete this car?</p>
            </div>

            <form action="<?php echo url_for('/staff/cars/delete.php?id=' . h(u($car->id))); ?>" method="post">
            
                <div class="form_buttons">
                    <button type="submit" class="primary_button" name="submit">Delete Car</button>
                    <a href="<?php echo url_for('/staff/cars/index.php'); ?>" class="tertiary_button">Cancel</a>
                </div>

            </form>

        </div>

    </section>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>