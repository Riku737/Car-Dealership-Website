<?php
require_once('../../private/initialize.php'); 
$page_title = "Login";

$errors = [];
$username = '';
$password = '';

if (is_post_request()) {
    // Process form submission
    $username = $_POST['admin']['username'] ?? '';
    $password = $_POST['admin']['password'] ?? '';

    // Validate presence of fields
    if (is_blank($username)) {
        $errors['username'] = "Username cannot be blank.";
    }
    if (is_blank($password)) {
        $errors['password'] = "Password cannot be blank.";
    }

    // If no errors, then validate login information
    // Check if admin exists in database, then verify entered password with hashed password
    if (empty($errors)) {

        // Find admin by username in database
        $admin = Admin::find_by_username($username);

        // If admin exists and password is correct, execute login.
        // Otherwise, return errors.
        if ($admin != false && $admin->verify_password($password)) {
            $session->login($admin);
            redirect_to(url_for('/staff/index.php'));
        } else {
            $errors['username'] = "Invalid username or password.";
            $errors['password'] = "Invalid username or password.";
        }

    }
}

include(SHARED_PATH . '/public_navigation.php');
?>

<div class="website_content">

    <section class="section_container">
    
        <div class="section_content_small">

            <div class="heading_container">
                <h1>Login</h1>
            </div>

            <?php echo display_errors($errors); ?>

            <form class="form_container" action="<?php echo url_for('/staff/login.php');?>" method="POST">

                <div class="item_box">

                    <div class="item_box_form_single">

                        <div class="form_box">
                            <h4>Username</h4>
                            <input class="text_field <?php if (has_errors($errors, 'username')) echo 'error'; ?>" type="text" id="username" name="admin[username]" value="<?php echo h($username); ?>" placeholder="Enter username">
                            <?php echo display_inline_errors($errors, 'username'); ?>
                        </div>
        
                        <div class="form_box">
                            <h4>Password</h4>
                            <input class="text_field  <?php if (has_errors($errors, 'password')) echo 'error'; ?>" type="password" id="password" name="admin[password]" value="" placeholder="Enter password">
                            <?php echo display_inline_errors($errors, 'password'); ?>
                        </div>
        
                        <div class="form_buttons">
                            <button type="submit" class="primary_button" name="submit">Login</button>
                        </div>

                    </div>


                </div>


            </form>

        </div>

    </section>

</div>

<?php
db_disconnect($database);
?>