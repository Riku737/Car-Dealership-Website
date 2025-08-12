<?php

class Session {

    private $admin_id;
    private $username;
    private $last_login;
    private const MAX_LOGIN_AGE = 60*60*24; // 1 day

    public function __construct() {
        session_start();
        $this->check_stored_login();
    }

    public function getID() {
        return $this->admin_id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getLastLogin() {
        return $this->last_login;
    }

    public function login($admin) {
        // prevent session fixation attacks
        session_regenerate_id();
        if ($admin) {
            $_SESSION['admin_id'] = $admin->id;
            $this->admin_id = $admin->id;

            $_SESSION['username'] = $admin->username;
            $this->username = $admin->username;

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
        unset($_SESSION['last_login']);
        unset($this->last_login);
        return true;
    }

    private function check_stored_login() {
        if (isset($_SESSION['admin_id'])) {
            $this->admin_id = $_SESSION['admin_id'];
            $this->username = $_SESSION['username'];
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

}

?>