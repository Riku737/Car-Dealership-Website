<?php require_once('../../..//private/initialize.php');?>

<?php 

$id = $_GET['id'];

if (!$id) {
    redirect_to('index.php');
}

$car = Car::find_by_id($id);

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
            </div>

        </div>

    </section>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>