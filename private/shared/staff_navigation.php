<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/public.css'); ?>" />
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css'); ?>" />
    <title>
        <?php
        if (isset($page_title)) {
            echo h($page_title) . ' - The Used Suspects';
        } else {
            echo 'The Used Suspects';
        }
        ?>
    </title>
</head>

<body>

    <div class="banner_message">
        <div class="banner_content">
            <h4>Admin</h4>
        </div>
    </div>

    <nav class="navigation_section">

        <div class="navigation_content">

            <div class="navigation_left">
                <a class="menu_link menu_logo" href="<?php echo url_for('/staff/index.php') ?>">The Used Suspects</a>
                <div class="staff_menu_links">
                    <a class="menu_link" href="<?php echo url_for('/staff/cars/index.php') ?>">Inventory</a>
                    <a class="menu_link" href="<?php echo url_for('/staff/admins/index.php') ?>">Admins</a>
                </div>
            </div>
            <div class="navigation_right">
                <a class="secondary_button" href="<?php echo url_for('/staff/logout.php') ?>">Logout</a>
                <a class="tertiary_button" href="<?php echo url_for('/staff/admins/show.php?id=' . h(u($session->admin_id))); ?>"></i><?php echo h($session->username); ?></a>
            </div>

        </div>

    </nav>