<?php require_once('../../private/initialize.php'); ?>

<?php include(SHARED_PATH . '/staff_navigation.php'); ?>

<div class="website_content">

    <section class="section_container">

        <div class="section_content">


            <div class="heading_container">
                <h1>Admin Dashboard</h1>
            </div>

            <div class="admin_banner">

                <div class="admin_box">

                    <h3>Inventory</h3>
                    <a class="primary_button" href="<?php echo url_for("staff/cars/index.php"); ?>">Manage</a>

                </div>

                <div class="admin_box">

                    <h3>Admin</h3>
                    <a class="primary_button" href="<?php echo url_for("staff/admins/index.php"); ?>">Manage</a>

                </div>

            </div>

        </div>

    </section>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>