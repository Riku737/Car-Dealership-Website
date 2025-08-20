<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/public.css'); ?>" />
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

    <nav class="navigation_section">

        <div class="navigation_content">

            <div class="navigation_left">
                <a class="menu_link menu_logo" href="<?php echo url_for('/index.php') ?>">The Used Suspects</a>
                <div class="web_menu_links">
                    <a class="menu_link" href="<?php echo url_for('/index.php') ?>">Home</a>
                    <a class="menu_link" href="<?php echo url_for('/index.php') ?>">About</a>
                    <a class="menu_link" href="<?php echo url_for('/index.php') ?>">Contact</a>
                    <a class="menu_link" href="<?php echo url_for('/index.php') ?>">News</a>
                    <a class="menu_link" href="<?php echo url_for('/index.php') ?>">Careers</a>
                </div>
            </div>
            <div class="navigation_right">
                <a class="secondary_button" href="<?php echo url_for('/index.php') ?>">Cars for sale<i class="bi bi-arrow-right"></i></a>
                <a class="tertiary_button" href="<?php echo url_for('/staff/login.php') ?>">Login</a>
            </div>

        </div>

    </nav>