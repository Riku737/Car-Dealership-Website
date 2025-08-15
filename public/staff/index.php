<?php 
require_once('../../private/initialize.php');
$page_title = 'Staff Dashboard';
require_login(); // Ensure user is logged in

include(SHARED_PATH . '/staff_navigation.php'); 
?>

<div class="website_content">

    <section class="section_container">

        <div class="section_content">

            <div class="heading_container">
                <h1>Welcome, <?php echo h($session->full_name); ?></h1>
            </div>

            <div class="admin_banner">

                <!-- Inventory Management -->
                <div class="admin_box">
                    <h3>Inventory</h3>
                    <p>View, edit, delete, or add vehicles.</p>
                    <a class="primary_button" href="<?php echo url_for("staff/cars/index.php"); ?>">Manage</a>
                </div>

                <!-- Admin Management -->
                <div class="admin_box">
                    <h3>Admin</h3>
                    <p>Update, delete, or add admins.</p>
                    <a class="primary_button" href="<?php echo url_for("staff/admins/index.php"); ?>">Manage</a>
                </div>

            </div>

        </div>

    </section>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>