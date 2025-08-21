<?php
require_once('../../..//private/initialize.php');
require_login(); // Admin protect page

$id = $_GET['id'] ?? false;

if (!$id) {
    redirect_to('index.php');
}

/** @var Admin $admin */
$admin = Admin::find_by_id($id);
$page_title = $admin->full_name();

?>

<?php include(SHARED_PATH . '/staff_navigation.php'); ?>

<div class="website_content">

    <section class="section_container">

        <div class="section_content">


            <div class="heading_container">
                <div class="breadcrumb_menu">
                    <a class="link" href="<?php echo url_for('/staff/index.php') ?>">Staff</a>
                    <a class="link" href="<?php echo url_for('/staff/admins/index.php') ?>">Admins</a>
                    <p>Show</p>
                </div>
                <div class="split_container">
                    <div class="left_split">
                        <h1><?php echo h($admin->username); ?></h1>
                    </div>
                    <div class="right_split">
                        <a class="tertiary_button" href="<?php echo url_for('/staff/admins/edit.php?id=' . h($admin->id)); ?>"><i class="bi bi-pencil-fill"></i>Edit admin</a>
                    </div>
                </div>
            </div>

            <?php echo display_session_message(); ?>

            <div class="content_container">

                <div class="item_box">

                    <table class="table_section">
                        <tbody>
                            <tr>
                                <th style="width:50%;">ID</th>
                                <td style="width:50%;"><?php echo h($admin->id); ?></td>
                            </tr>
                            <tr>
                                <th>First Name</th>
                                <td><?php echo h($admin->first_name); ?></td>
                            </tr>
                            <tr>
                                <th>Last Name</th>
                                <td><?php echo h($admin->last_name); ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo h($admin->email); ?></td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td><?php echo h($admin->username); ?></td>
                            </tr>
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>