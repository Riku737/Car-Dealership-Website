<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/public.css'); ?>"/>
    <title>Document</title>
</head>
<body>

<nav class="navbar sticky-top container-fluid navigation_section border-bottom border-body" data-bs-theme="light">

    <div class="collapse navbar-collapse container row navigation_content">

        <div class="nav navigation_left justify-content-start">
            <a class="navbar-brand nav-link" href="<?php url_for('/index.php')?>">
                Car Dealership Inventory System
            </a>
        </div>
        <div class="col navigation_right navbar-nav">
            <a class="nav-item nav-link" href="<?php echo url_for('/index.php')?>">Inventory</a>
            <a class="nav-item nav-link" href="<?php echo url_for('/index.php')?>">Home</a>
        </div>

    </div>

</nav>