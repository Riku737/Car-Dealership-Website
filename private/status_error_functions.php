<?php

function require_login() {
	global $session;
	if (!$session->is_logged_in()) {
	redirect_to(url_for('/staff/login.php'));
	}
}

function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"error_container\">";
	$output .= "<i class=\"bi bi-exclamation-triangle-fill\"></i>";
    $output .= "<span>An error has occurred. Please check your input and try again.</span>";
    $output .= "</div>";
  }
  return $output;
}

function inline_errors($errors=[], $field_name='') {

	if (has_errors($errors, $field_name)) {
		return '<div class="inline_error">' . h($errors[$field_name]) . '</div>';
	}

}

function display_session_message() {
	global $session;
	$msg = $session->message();
	if(isset($msg) && $msg != '') {
		$session->clear_message();
		return '<div id="message">' . h($msg) . '</div>';
	}
}

?>
