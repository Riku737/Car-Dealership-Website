<?php 
require_once('../../../private/initialize.php');
$page_title = 'New Admin';
require_login();
?>

<?php

if (is_post_request()) {

    // Create record using post parameters
    $args = $_POST['admin'];
    $admin = new Admin($args);
    $result = $admin->save();

    if ($result === true) {
        $new_id = $admin->id;
        $_SESSION['message'] = 'The admin was created successfully.';
        redirect_to(url_for('/staff/admins/show.php?id=' . $new_id));
    } else {
        // show errors
    }

} else {
    $admin = new Admin();
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
                    <a class="link" href="<?php echo url_for('/staff/admins/index.php'); ?>">Admins</a>
                    <p>/</p>
                    <p>New</p>
                </div>
                <h1>Create new admin</h1>
            </div>

            <?php echo display_errors($admin->errors); ?>

            <form class="form_container" action="<?php echo url_for('/staff/admins/new.php');?>" method="POST">

                <?php include('form_fields.php'); ?>

                <div class="form_buttons">
                    <button type="submit" class="primary_button" name="submit">Create admin</button>
                    <a href="<?php echo url_for('/staff/admins/index.php'); ?>" class="tertiary_button">Cancel</a>
                </div>

            </form>

        </div>

    </section>

</div>


<?php include(SHARED_PATH . '/public_footer.php'); ?>