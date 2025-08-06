<?php require_once('../../..//private/initialize.php');?>

<?php 

$id = $_GET['id'] ?? false;

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
                    <a class="link" href="<?php echo 'index.php' ?>">Staff</a>
                    <p>/</p>
                    <a class="link" href="<?php echo '../cars/index.php' ?>">Inventory</a>
                    <p>/</p>
                    <p><?php echo h($car->name()) ?></p>
                </div>
                <h1><?php echo h($car->name()); ?></h1>
            </div>

            <div class="content_container">

                <label for="fname">First name:</label>
                <input class="text_field" type="text" id="fname" name="fname"><br><br>

            </div>

        </div>

    </section>

</div>


<?php include(SHARED_PATH . '/public_footer.php'); ?>