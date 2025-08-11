<?php

class Admin extends DatabaseObject {

    protected static $table_name = "admins";
    protected static $db_columns = ['id', 'first_name', 'last_name', 'email', 'username', 'hashed_password'];

    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $username;
    protected $hashed_password;
    public $password;
    public $confirm_password;

    public function __construct($args=[]) {
        $this->id = $args['id'] ?? null;
        $this->first_name = $args['first_name'] ?? null;
        $this->last_name = $args['last_name'] ?? null;
        $this->email = $args['email'] ?? null;
        $this->username = $args['username'] ?? null;
        $this->confirm_password = $args['confirm_password'] ?? null;
    }

    public function full_name() {
        return $this->first_name . " " . $this->last_name;
    }

}

?>