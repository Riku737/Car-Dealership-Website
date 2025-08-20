<?php

// Validate user is logged in
function require_login()
{
	global $session;
	if (!$session->is_logged_in()) {
		redirect_to(url_for('/staff/login.php'));
	}
}

// Display errors in a user-friendly way
function display_errors($errors = array())
{
	$output = '';
	if (!empty($errors)) {
		$output .= "<div class=\"error_container\">";
		$output .= "<i class=\"bi bi-exclamation-triangle-fill\"></i>";
		$output .= "<span>An error has occurred. Please check your input and try again.</span>";
		$output .= "</div>";
	}
	return $output;
}

// Display inline errors for a specific field
function display_inline_errors($errors = [], $field_name = '')
{

	if (has_errors($errors, $field_name)) {
		return '<div class="inline_error">' . h($errors[$field_name]) . '</div>';
	}
}

// Display a session message
// Shows a message to the user, typically after a form submission
function display_session_message()
{
	global $session;
	$msg = $session->message();
	if (isset($msg) && $msg != '') {
		$session->clear_message();
		$output = '<div class="message">';
		$output .= '<i class="bi bi-check-lg"></i>';
		$output .= h($msg);
		$output .= '</div>';
		return $output;
	}
}
