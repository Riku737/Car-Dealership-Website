<?php
require_once('../../private/initialize.php');
$page_title = "Logout";

$session->logout();
redirect_to(url_for('/staff/login.php'));
