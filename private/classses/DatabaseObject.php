<?php

class DatabaseObject {

    // CLASS VARIABLES

    // $database stores the database connection to the MySQL database
    // Since it is an object, it has many built-in properties and methods for interacting with the database, including:
    // * query($sql)
    // * escape_string($string)
    // * insert_id()
    // * error()
    // * close()
    protected static $database;

    protected static $table_name = "";
    protected static $columns = [];


    // INSTANCE VARIABLES
    public $errors = [];




    // METHODS

    // Sets up the database connection across all model classes (as a class method)
    // Called once in initialize.php to make database connection available to all objects that extend DatabaseObject.
    // Avoids having to pass the database connection to every method or store it in every object instance.
    public static function set_database($database) {
        self::$database = $database;
    }


    // SQL QUERY EXECUTION

    // Executes given SQL query, checks for errors, and then converts each row of the result into a class object
    public static function find_by_sql($sql) {
        // Execute SQL command and store success result in $result
        $result = self::$database->query($sql);

        // If the SQL query was not successful, abruptly cancel the method call and return message
        if (!$result) {
            exit("Database query failed.");
        }

        // Convert SQL record into associative array
        $object_array = [];
        // Loops through each row in the SQL query result until there are no more rows
        while($record = $result->fetch_assoc()) { // Fetch the next row as an associative array
            $object_array[] = static::instantiate($record); // Creates a new object of each row from database using the values from $record, and adds object to the array
        }
        $result->free(); // Cleans up and frees memory used by query result

        // After the loop, $object_array contains one object for each row returned by the query, with all properties set from the database.
        return $object_array;
    }

    // SQL SHORTCUT METHODS

    // Returns array of Car objects, each representing a row from cars table in the database
    public static function find_all() {
        // Building SQL query
        $sql = "SELECT * FROM " . static::$table_name; // Determine class name at runtime using static
        // Calls find_by_sql() and returns all records
        return static::find_by_sql($sql);
    }

    // Retrieves a single car from the database whose id matches the given value
    public static function find_by_id($id) {

        // Building SQL query
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE id='" . self::$database->escape_string($id) .  "'";

        // Execute the SQL query
        // Returns an array of objects of the calling class, where each represents a row from the query result
        $object_array = static::find_by_sql($sql);

        // If the query returned results (not empty array), then removes and returns the first (and only) object from the $object_array array
        // Car::find_by_id(2) returns a single fully populated Car object representing the row with id = 2 from the database
        // The array contains objects, but in this case, only one object is expected to be returned by SQL since ID is unique.
        if (!empty($object_array)) {
            return array_shift($object_array);
        } else {
            return false;
        }
    }




    // CRUD OPERATIONS

    // Saves the current state of the object to the database
    // If the object has an ID, it updates the existing record.
    // For further context, when an object is instantiated, it does not have an ID
    // Therefore, a new record will be created by create();
    public function save() {
        // A new record will not have an ID yet
        if (isset($this->id)) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    // Create a new car record
    protected function create() {
        // Validate the object properties before inserting record into the database
        $this->validate();
        if (!empty($this->errors)) {
            return false;
        }

        // Returns sanitized associative array with escaped values for safe SQL use (prevent SQL injection)
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(', ', array_keys($attributes)); // Combines comma-separated list of property names, each wrapped in single quotes
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";

        // Execute the SQL query and returns whether the query was successful
        // If the query fails, it returns false
        $result = self::$database->query($sql);
        if($result) {
            $this->id = self::$database->insert_id;
        }
        
        return $result;
    }

    // Update car record
    protected function update() {
        // Validate the object properties before updating record in the database
        $this->validate();
        if (!empty($this->errors)) {
            return false;
        }

        // Returns a sanitized associative array with escaped values for safe SQL use
        $attributes = $this->sanitized_attributes();

        // Format associative array into SQL syntax
        // Example: ['make' => 'Toyota', 'model' => 'Camry'] becomes "make='Toyota', model='Camry'"
        $attribute_pairs = [];
        foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }

        // Building SQL query
        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= join(', ', $attribute_pairs);
        $sql .= " WHERE id='" . self::$database->escape_string($this->id) . "' ";
        $sql .= "LIMIT 1";

        // Execute the SQL query and returns whether the query was successful
        // If the query fails, it returns false
        $result = self::$database->query($sql);
        return $result;
    }

    // Delete car record
    public function delete() {

        // Building SQL query
        $sql = "DELETE FROM " . static::$table_name . " ";
        $sql .= "WHERE id='" . self::$database->escape_string($this->id) . "' ";
        $sql .= "LIMIT 1";

        // Executing SQL query
        $result = self::$database->query($sql);
        return $result;

        // After deleting, the instance of the object will still exist in memory,
        // even though the database record has been removed.
        // This can be useful for logging or displaying messages to the user.
        // For example: echo $user->first_name . " was deleted.";
        // But, we can't call $user->update() after calling $user->delete().
    }

    // Takes an associative array and updates the current object's properties with the values from that array
    // For each pair, if the property exists and the value is not null, update the property
    // Used for updating database records (edit.php)
    public function merge_attributes($args=[]) {
        foreach($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }


    // SANITIZATION

    // Returns an associative array of the object's property and their values to be used in sanitized_attributes()
    // Excludes the record ID
    // Example: $attributes = ['make' => 'Toyota', 'model' => 'Camry']
    public function attributes() {
        $attributes = [];
        foreach (static::$db_columns as $column) {
            if ($column == 'id') {
                continue; // Skip id as it's auto-generated and incremented by MySQL
            }
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    // Returns a sanitized associative array of the object's attributes
    // Each property is escaped for safe use in SQL queries
    // Escapes special characters, prevent unauthorized SQL injection
    protected function sanitized_attributes() {
        $sanitized = [];
        foreach ($this->attributes() as $key => $value) { // attributes() converts object's attributes into associative array
            $sanitized[$key] = self::$database->escape_string($value);
        }
        return $sanitized;
    }


    // Create Car object from database record (an associative array)
    // Creates a new instance of the class, and assigns each value from the record to the corresponding property
    // $record = ['id' => 1, 'make' => 'Toyota', 'model' => 'Camry', 'year' => 2020];
    protected static function instantiate($record) {
        $object = new static; // Create a new instance of the class that called
        foreach($record as $property => $value) {
            if (property_exists($object, $property)) { // Check if $property is defined property of $object
                $object->$property = $value;
            }
        }
        return $object;
    }




    // VALIDATION FRAMEWORK
    // Overridden in child classes Admin and Car

    protected function validate() {
        $this->errors = []; // Reset errors array

        return $this->errors;
    }

}

?>