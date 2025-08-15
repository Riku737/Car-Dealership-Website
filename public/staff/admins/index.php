<?php
require_once('../../..//private/initialize.php');
$page_title = 'Admins';
require_login(); // Admin protect page

/** @var Admin[] $admins */
$admins = Admin::find_all();

?>

<?php include(SHARED_PATH . '/staff_navigation.php'); ?>

<div class="website_content">

    <section class="section_container">
    
        <div class="section_content">

            <div class="heading_container">
                <div class="breadcrumb_menu">
                    <a class="link" href="<?php echo url_for('/staff/index.php'); ?>">Staff</a>
                    <p>Admins</p>
                </div>
                <div class="split_container">
                    <div>
                        <h1>Admins</h1>
                        <p>Database for managing admin users.</p>
                    </div>
                    <div class="split_corner">
                        <a class="primary_button" href="new.php">Add admin</a>
                    </div>
                </div>
            </div>

            <div class="item_box">
    
                <table class="table_section">
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 20%;">First Name</th>
                            <th style="width: 20%;">Last Name</th>
                            <th style="width: 20%;">Email</th>
                            <th style="width: 20%;">Username</th>
                            <th style="width: 5%;">&nbsp;</th>
                            <th style="width: 5%;">&nbsp;</th>
                            <th style="width: 5%;">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($admins as $admin) {?>
                        <tr>
                            <td><?php echo h($admin->id); ?></td>
                            <td><?php echo h($admin->first_name); ?></td>
                            <td><?php echo h($admin->last_name); ?></td>
                            <td><?php echo h($admin->email); ?></td>
                            <td><?php echo h($admin->username); ?></td>
                            <td><a class="link" href="show.php?id=<?php echo h(u($admin->id)); ?>">View</a></td>
                            <td><a class="link" href="edit.php?id=<?php echo h(u($admin->id)); ?>">Edit</a></td>
                            <td><a class="link" href="delete.php?id=<?php echo h(u($admin->id)); ?>">Delete</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
    
                </table>
    
            </div>
    
        </div>
    
    </section>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>