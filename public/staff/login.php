<?php
require_once('../../private/initialize.php'); 
$page_title = "Login";

$errors = [];
$username = '';
$password = '';

if (is_post_request()) {
    $username = $_POST['admin']['username'] ?? '';
    $password = $_POST['admin']['password'] ?? '';

    if (is_blank($username)) {
        $errors['username'] = "Username cannot be blank.";
    }
    if (is_blank($password)) {
        $errors['password'] = "Password cannot be blank.";
    }

    if (empty($errors)) {
        // Perform login
        $admin = Admin::find_by_username($username);
        if ($admin != false && $admin->verify_password($password)) {
            $session->login($admin);
            redirect_to(url_for('/staff/index.php'));
        } else {
            $errors['username'] = "Invalid username or password.";
            $errors['password'] = "Invalid username or password.";
        }
    }
}

?>

<?php include(SHARED_PATH . '/public_navigation.php'); ?>

<div class="website_content">

    <section class="section_container">
    
        <div class="section_content">

            <div class="heading_container">
                <div class="breadcrumb_menu">
                    <a class="link" href="<?php echo url_for('/staff/index.php'); ?>">Staff</a>
                    <p>/</p>
                    <p>Login</p>
                </div>
                <h1>Login</h1>
            </div>

            <?php echo display_errors($errors); ?>

            <form class="form_container" action="<?php echo url_for('/staff/login.php');?>" method="POST">

                <div class="form_box">
                    <h4>Username</h4>
                    <input class="text_field <?php if (has_errors($errors, 'username')) echo 'error'; ?>" type="text" id="username" name="admin[username]" value="<?php echo h($username); ?>" placeholder="Enter username">
                    <?php echo inline_errors($errors, 'username'); ?>
                </div>

                <div class="form_box">
                    <h4>Password</h4>
                    <input class="text_field  <?php if (has_errors($errors, 'password')) echo 'error'; ?>" type="password" id="password" name="admin[password]" value="" placeholder="Enter password">
                    <?php echo inline_errors($errors, 'password'); ?>
                </div>

                <div class="form_buttons">
                    <button type="submit" class="primary_button" name="submit">Login</button>
                </div>

            </form>

        </div>

    </section>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>