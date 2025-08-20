<?php

// SHORTCUT FUNCTIONS
// Helper functions

// add the leading '/' if not present
function url_for($script_path)
{
  if ($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

// Convenient for using strings as part of URL queries
// Replaces unsafe ASCII characters with "%" followed by two hexadecimal digits
// urlencode() replaces spaces with "+"
// Good for query strings (e.g., ?search=car+model)
function u($string = "")
{
  return urlencode($string);
}

// Similar to urlencode(): encodes strings to be safely used in URLs. 
// rawurlencode() replaces spaces with "%20"
// Follows RFC 3986 and is preferred for encoding URL path segments.
// Good for URL path segments (e.g., /cars/car%20model)
function raw_u($string = "")
{
  return rawurlencode($string);
}

// Escape HTML special characters
// Converts special characters to HTML entities
// To convert special HTML entities back to characters, use htmlspecialchars_decode() function
// $_SERVER["PHP_SELF"] exploits (Cross-Site Scripting, XSS) can be avoided by using the htmlspecialchars() function
function h($string = "")
{
  return htmlspecialchars($string);
}

// Indicates that the requested resource or page is unavailable
function error_404()
{
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

// Indicates a server side error of a website
// Generic error for a problem and can't provide a more specific error code
function error_500()
{
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}

// Redirecting users to a different page
function redirect_to($location)
{
  header("Location: " . $location);
  exit; // Stop further code from running after the redirect
}

// Checks if the request method is POST
function is_post_request()
{
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

// Checks if the request method is GET
function is_get_request()
{
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}
