<?php

class Admin extends DatabaseObject
{

    // CLASS VARIABLES
    protected static $table_name = "admins";
    protected static $db_columns = ['first_name', 'last_name', 'email', 'username', 'hashed_password'];


    // INSTANCE VARIABLES
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $username;
    protected $hashed_password;
    public $password;
    public $confirm_password;
    protected $password_required = true;




    // CONSTRUCTOR
    // Note: The constructor accepts an associative array of attributes
    public function __construct($args = [])
    {
        $this->first_name = $args['first_name'] ?? null;
        $this->last_name = $args['last_name'] ?? null;
        $this->email = $args['email'] ?? null;
        $this->username = $args['username'] ?? null;
        $this->password = $args['password'] ?? null;
        $this->confirm_password = $args['confirm_password'] ?? null;
    }




    // INSTANCE METHODS

    // Returns the full name of the admin
    public function full_name()
    {
        return $this->first_name . " " . $this->last_name;
    }

    // Sets the hashed password for the admin
    protected function set_hashed_password()
    {
        $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Verifies whether the given password matches the stored hashed password
    public function verify_password($password)
    {
        return password_verify($password, $this->hashed_password);
    }


    // SQL SEARCH QUERY

    // Searches admins by username in the database
    // Returns true or false whether an admin with the given username exists
    public static function find_by_username($username)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE username='" . self::$database->escape_string($username) .  "'";
        $object_array = static::find_by_sql($sql);
        if (!empty($object_array)) {
            return array_shift($object_array);
        } else {
            return false;
        }
    }


    // CRUD METHODS

    /**
     * Override parent::create()
     */
    protected function create()
    {
        $this->set_hashed_password();
        return parent::create();
    }

    protected function update()
    {
        if ($this->password != '') {
            // Validate password
            $this->set_hashed_password();
        } else {
            // Skip hashing and validation
            $this->password_required = false;
        }
        return parent::update();
    }

    /**
     * Override parent::validate()
     */
    protected function validate()
    {
        // Reset errors array
        $this->errors = [];

        // First name validation
        if (is_blank($this->first_name)) {
            $this->errors['first_name'] = "First name cannot be blank.";
        } elseif (!has_length($this->first_name, array('min' => 2, 'max' => 255))) {
            $this->errors['first_name'] = "First name must be between 2 and 255 characters.";
        }

        // Last name validation
        if (is_blank($this->last_name)) {
            $this->errors['last_name'] = "Last name cannot be blank.";
        } elseif (!has_length($this->last_name, array('min' => 2, 'max' => 255))) {
            $this->errors['last_name'] = "Last name must be between 2 and 255 characters.";
        }

        // Email validation
        if (is_blank($this->email)) {
            $this->errors['email'] = "Email cannot be blank.";
        } elseif (!has_length($this->email, array('max' => 255))) {
            $this->errors['email'] = "Email must be less than 255 characters.";
        } elseif (!has_valid_email_format($this->email)) {
            $this->errors['email'] = "Email must be a valid format.";
        }

        // Username validation
        if (is_blank($this->username)) {
            $this->errors['username'] = "Username cannot be blank.";
        } elseif (!has_length($this->username, array('min' => 8, 'max' => 255))) {
            $this->errors['username'] = "Username must be between 8 and 255 characters.";
        } elseif (!has_unique_username($this->username, $this->id ?? 0)) {
            $this->errors['username'] = "Username must be unique.";
        }

        // Password validation
        // Note: If the admin already has a password, password_required is false
        // If the admin is new (no existing password), password_required is true
        // Password validation occurs when new admin is created or admin is changed
        if ($this->password_required) {

            // Validate password
            if (is_blank($this->password)) {
                $this->errors['password'] = "Password cannot be blank.";
            } elseif (!has_length($this->password, array('min' => 12))) {
                $this->errors['password'] = "Password must contain 12 or more characters";
            } elseif (!preg_match('/[A-Z]/', $this->password)) {
                $this->errors['password'] = "Password must contain at least 1 uppercase letter";
            } elseif (!preg_match('/[a-z]/', $this->password)) {
                $this->errors['password'] = "Password must contain at least 1 lowercase letter";
            } elseif (!preg_match('/[0-9]/', $this->password)) {
                $this->errors['password'] = "Password must contain at least 1 number";
            } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
                $this->errors['password'] = "Password must contain at least 1 symbol";
            }

            // Confirm password validation
            if (is_blank($this->confirm_password)) {
                $this->errors['confirm_password'] = "Confirm password cannot be blank.";
            } elseif ($this->password !== $this->confirm_password) {
                $this->errors['confirm_password'] = "Password and confirm password must match.";
            }
        }

        return $this->errors;
    }
}
