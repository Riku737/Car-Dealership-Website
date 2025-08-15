<!-- First Name -->
<div class="form_box">
    <h4>First Name</h4>
    <input class="text_field <?php if (has_errors($admin->errors, 'first_name')) echo 'error'; ?>" type="text" id="first_name" name="admin[first_name]" value="<?php echo h($admin->first_name); ?>" placeholder="Enter first name">
    <?php echo display_inline_errors($admin->errors, 'first_name'); ?>
</div>

<!-- Last Name -->
<div class="form_box">
    <h4>Last Name</h4>
    <input class="text_field <?php if (has_errors($admin->errors, 'last_name')) echo 'error'; ?>" type="text" id="last_name" name="admin[last_name]" value="<?php echo h($admin->last_name); ?>" placeholder="Enter last name">
    <?php echo display_inline_errors($admin->errors, 'last_name'); ?>
</div>

<!-- Email -->
<div class="form_box">
    <h4>Email</h4>
    <input class="text_field <?php if (has_errors($admin->errors, 'email')) echo 'error'; ?>" type="text" id="email" name="admin[email]" value="<?php echo h($admin->email); ?>" placeholder="Enter email">
    <?php echo display_inline_errors($admin->errors, 'email'); ?>
</div>

<!-- Username -->
<div class="form_box">
    <h4>Username</h4>
    <input class="text_field <?php if (has_errors($admin->errors, 'username')) echo 'error'; ?>" type="text" id="username" name="admin[username]" value="<?php echo h($admin->username); ?>" placeholder="Enter username">
    <?php echo display_inline_errors($admin->errors, 'username'); ?>
</div>

<!-- Password -->
<div class="form_box">
    <h4>Password</h4>
    <input class="text_field <?php if (has_errors($admin->errors, 'password')) echo 'error'; ?>" type="password" id="password" name="admin[password]" value="<?php echo h($admin->password); ?>" placeholder="Enter password">
    <?php echo display_inline_errors($admin->errors, 'password'); ?>
</div>

<!-- Confirm Password -->
<div class="form_box">
    <h4>Confirm Password</h4>
    <input class="text_field <?php if (has_errors($admin->errors, 'confirm_password')) echo 'error'; ?>" type="password" id="confirm_password" name="admin[confirm_password]" value="<?php echo h($admin->confirm_password); ?>" placeholder="Enter confirm password">
    <?php echo display_inline_errors($admin->errors, 'confirm_password'); ?>
</div>