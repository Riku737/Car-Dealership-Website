<?php

class DatabaseObject {

    protected static $database;
    protected static $table_name = "";
    protected static $columns = [];
    public $errors = [];

    public static function set_database($database) {
        self::$database = $database;
    }

    // Executes given SQL query, checks for errors, and then converts each row of the result into a Car object
    public static function find_by_sql($sql) {
        // Execute SQL command and store result in $result
        $result = self::$database->query($sql);

        // Error checking
        if (!$result) {
            exit("Database query failed.");
        }

        // Convert result into objects
        $object_array = [];
        while($record = $result->fetch_assoc()) {
            $object_array[] = static::instantiate($record);
        }
        $result->free();

        return $object_array;
    }

    // Returns array of Car objects, each representing a row from cars table in the database
    public static function find_all() {
        $sql = "SELECT * FROM " . static::$table_name; // Determine class name at runtime using static
        return static::find_by_sql($sql);
    }

    // Retrieves a single car from the database whose id matches the given value
    public static function find_by_id($id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE id='" . self::$database->escape_string($id) .  "'";
        $object_array = static::find_by_sql($sql);
        if (!empty($object_array)) {
            return array_shift($object_array);
        } else {
            return false;
        }
    }

    // Validates whether file name exists in images folder
    public static function find_by_image($image) {
        $dir = __DIR__ . '/../../public/images/';
        $files = [];
        foreach (scandir($dir) as $file) {
            if ($file !== '.' && $file !== '..' && is_file($dir . $file)) {
                $files[] = $file;
            }
        }

        if (in_array($image, $files)) {
            return true;
        } else {
            return false;
        }

    }

    // Convert each row of result into Car object
    protected static function instantiate($record) {
        $object = new static; // Create a new instance of the class that called
        foreach($record as $property => $value) {
            if (property_exists($object, $property)) {
                $object->$property = $value;
            }
        }
        return $object;
    }

    protected function validate() {
        $this->errors = []; // Reset errors array

        // Generic validation
        // Add custom validations here 
        
        return $this->errors;
    }

    // Create a new car record
    protected function create() {
        $this->validate();
        if (!empty($this->errors)) {
            return false;
        }

        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(', ', array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";

        $result = self::$database->query($sql);
        if($result) {
            $this->id = self::$database->insert_id;
        }
        
        return $result;
    }

    // Update car record
    protected function update() {
        $this->validate();
        if (!empty($this->errors)) {
            return false;
        }

        $attributes = $this->sanitized_attributes();
        $attribute_pairs = [];
        foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= join(', ', $attribute_pairs);
        $sql .= " WHERE id='" . self::$database->escape_string($this->id) . "' ";
        $sql .= "LIMIT 1";
        $result = self::$database->query($sql);
        return $result;
    }

    public function save() {
        // A new record will not have an ID yet
        if (isset($this->id)) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    // Merges the provided associative array of attributes into the current object
    public function merge_attributes($args=[]) {
        foreach($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // Properties which have database columns, excluding ID
    public function attributes() {
        $attributes = [];
        foreach (static::$db_columns as $column) {
            if ($column == 'id') {
                continue; // Skip id as it's auto-generated and incremented
            }
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    protected function sanitized_attributes() {
        $sanitized = [];
        foreach ($this->attributes() as $key => $value) {
            $sanitized[$key] = self::$database->escape_string($value);
        }
        return $sanitized;
    }

    public function delete() {
        $sql = "DELETE FROM " . static::$table_name . " ";
        $sql .= "WHERE id='" . self::$database->escape_string($this->id) . "' ";
        $sql .= "LIMIT 1";
        $result = self::$database->query($sql);
        return $result;

        // After deleting, the instance of the object will still exist in memory,
        // even though the database record has been removed.
        // This can be useful for logging or displaying messages to the user.
        // For example: echo $user->first_name . " was deleted.";
        // But, we can't call $user->update() after calling $user->delete().
    }

}

?>