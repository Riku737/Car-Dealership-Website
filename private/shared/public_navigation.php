<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/public.css'); ?>"/>
    <title><?php if(isset($page_title)) { echo h($page_title); } ?></title>
</head>
<body>

<nav class="navigation_section">

    <div class="navigation_content">

        <div class="navigation_left">
            <h4>Car Dealership Inventory System</h4>
        </div>
        <div class="navigation_right">
            <a class="menu_link" href="<?php echo url_for('/index.php')?>">Home</a>
        </div>

    </div>

</nav>