<?php

class Session
{

    // INSTANCE VARIABLES

    public $admin_id;
    public $username;
    public $last_login;
    public $full_name;
    protected const MAX_LOGIN_AGE = 60 * 60 * 24; // 1 day




    // CONSTRUCTOR
    public function __construct()
    {
        session_start();
        $this->check_stored_login();
    }




    // INSTANCE METHODS

    // Stores admin user information in PHP session
    // Admin user data is validated before login method is called
    // Note: $_SESSION is a superglobal associative array in PHP that is used to store data across multiple pages for a single user session
    // Data in $_SESSION is stored on the server, and each user gets a unique session ID (usually via a cookie)
    // session_start(); must be called before using $_SESSION
    public function login($admin)
    {
        session_regenerate_id(); // Creates a new session ID to prevent session fixation attacks
        if ($admin) { // If an admin object is provided, set session variables

            // Store admin ID
            $_SESSION['admin_id'] = $admin->id;
            $this->admin_id = $admin->id;

            // Store username
            $_SESSION['username'] = $admin->username;
            $this->username = $admin->username;

            // Store full name
            $_SESSION['full_name'] = $admin->full_name();
            $this->full_name = $admin->full_name();

            // Store last login time
            $_SESSION['last_login'] = time();
            $this->last_login = time();
        }
        return true; // Always returns true
    }

    // Check if the admin is logged in
    // An admin is logged in if their ID is set and their last login was recent
    public function is_logged_in()
    {
        // return isset($_SESSION['admin_id']);
        return isset($this->admin_id) && $this->last_login_is_recent();
    }

    // Logout scrubs all user admin session data
    public function logout()
    {
        unset($_SESSION['admin_id']);
        unset($this->admin_id);
        unset($_SESSION['username']);
        unset($this->username);
        unset($_SESSION['full_name']);
        unset($this->full_name);
        unset($_SESSION['last_login']);
        unset($this->last_login);
        return true;
    }

    // Checks if the admin is already logged in
    // The admin is already logged in if their ID is already set in their session
    private function check_stored_login()
    {
        if (isset($_SESSION['admin_id'])) {
            $this->admin_id = $_SESSION['admin_id'];
            $this->username = $_SESSION['username'];
            $this->full_name = $_SESSION['full_name'];
            $this->last_login = $_SESSION['last_login'];
        }
    }

    // Checks if the last login was recent
    // An admin's last login is considered recent if it occurred within the past 24 hours
    // If the last login is not set, then the user has not logged in a session yet, thus return false
    private function last_login_is_recent()
    {
        if (!isset($this->last_login)) {
            return false;
        } elseif (($this->last_login + self::MAX_LOGIN_AGE) < time()) {
            return false;
        } else {
            return true;
        }
    }

    // Sets a message to be displayed to the user
    // For UX form submission messages (update, delete, etc.)
    public function message($msg = "")
    {
        if (!empty($msg)) {
            // Then this is a "set" message
            $_SESSION['message'] = $msg;
            return true;
        } else {
            // Then this is a "get" message
            return $_SESSION['message'] ?? '';
        }
    }

    // Clears the message from the session
    public function clear_message()
    {
        unset($_SESSION['message']);
    }
}
