<?php

class Session {

    // INSTANCE VARIABLES

    public $admin_id;
    public $username;
    public $last_login;
    public $full_name;
    protected const MAX_LOGIN_AGE = 60*60*24; // 1 day




    // CONSTRUCTOR
    public function __construct() {
        session_start();
        $this->check_stored_login();
    }




    // INSTANCE METHODS

    public function login($admin) {
        // prevent session fixation attacks
        session_regenerate_id();
        if ($admin) {
            $_SESSION['admin_id'] = $admin->id;
            $this->admin_id = $admin->id;

            $_SESSION['username'] = $admin->username;
            $this->username = $admin->username;

            $_SESSION['full_name'] = $admin->full_name();
            $this->full_name = $admin->full_name();

            $_SESSION['last_login'] = time();
            $this->last_login = time();
        }
        return true;
    }

    public function is_logged_in() {
        // return isset($_SESSION['admin_id']);
        return isset($this->admin_id) && $this->last_login_is_recent();
    }

    public function logout() {
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

    private function check_stored_login() {
        if (isset($_SESSION['admin_id'])) {
            $this->admin_id = $_SESSION['admin_id'];
            $this->username = $_SESSION['username'];
            $this->full_name = $_SESSION['full_name'];
            $this->last_login = $_SESSION['last_login'];
        }
    }

    private function last_login_is_recent() {
        if (!isset($this->last_login)) {
            return false;
        } elseif (($this->last_login + self::MAX_LOGIN_AGE) < time()) {
            return false;
        } else {
            return true;
        }
    }

    public function message($msg="") {
        if(!empty($msg)) {
            // Then this is a "set" message
            $_SESSION['message'] = $msg;
            return true;
        } else {
            // Then this is a "get" message
            return $_SESSION['message'] ?? '';
        }
    }

    public function clear_message() {
        unset($_SESSION['message']);
    }

}

?>