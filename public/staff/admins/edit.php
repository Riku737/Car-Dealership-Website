<?php 
require_once('../../../private/initialize.php');
$page_title = 'Edit Admin';
require_login(); // Admin protect page

if (!isset($_GET['id'])) {
    redirect_to('index.php');
}

$id = $_GET['id'];
/** @var Admin $admin */
$admin = Admin::find_by_id($id);
if ($admin == false) {
    redirect_to(url_for('/staff/admins/index.php'));
}

if (is_post_request()) {

    $args = $_POST['admin'];
    $admin->merge_attributes($args);
    $result = $admin->save();

    if ($result === true) {
        $session->message('The admin was updated successfully.');
        redirect_to(url_for('/staff/admins/show.php?id=' . $id));
    }

} 


?>

<?php include(SHARED_PATH . '/staff_navigation.php'); ?>

<div class="website_content">

    <section class="section_container">
    
        <div class="section_content">

            <div class="heading_container">
                <div class="breadcrumb_menu">
                    <a class="link" href="<?php echo url_for('/staff/index.php'); ?>">Staff</a><p>/</p><a class="link" href="<?php echo url_for('/staff/admins/index.php'); ?>">Admins</a><p>/</p><p>Edit</p>
                </div>
                <h1><?php echo h($admin->full_name()); ?></h1>
            </div>

            <?php echo display_errors($admin->errors); ?>

            <form class="form_container" action="<?php echo url_for('/staff/admins/edit.php?id=' . h($id)); ?>" method="post">
                
                <?php include('form_fields.php'); ?>

                <div class="form_buttons">
                    <button type="submit" class="primary_button">Save changes</button>
                    <a href="<?php echo url_for('/staff/admins/index.php'); ?>" class="tertiary_button">Cancel</a>
                </div>  


            </form>

        </div>

    </section>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>