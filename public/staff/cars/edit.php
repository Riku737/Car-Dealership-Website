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

            <h1><?php echo h($car->name()); ?></h1>


        </div>

    </section>

</div>


<?php include(SHARED_PATH . '/public_footer.php'); ?>