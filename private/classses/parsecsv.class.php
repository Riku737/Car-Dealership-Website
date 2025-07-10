<?php

class ParseCSV {

    // Instance variables (properties)
    public static $delimiter = ',';

    private $filename;
    private $header;
    private $data = [];
    private $row_count = 0;

    // Constructor
    public function __construct($filename='') {
        if ($filename != '') {
            $this->file($filename);
        }
    }

    public function file($filename) {
        if (!file_exists($filename)) {
            echo "File does not exist.";
            return false;
        } elseif(!is_readable($filename)) {
            echo "File is not readable.";
            return false;
        }
        $this->filename = $filename;
        return true;
    }

    public function parse() {
        // Precondition
        if (!isset($this->filename)) {
            echo "File not set.";
            return false;
        }

        // Clear any previous results
        $this->reset();

        // fopen() oens a file or URL and returns a file hande to read from or write to
        // The first argument is the file path; the second argument is the mode (r = read, w = write)
        $file = fopen($this->filename, 'r');

        // feof() checks if "end of life" has been reached for an open file pointer
        while (!feof($file)) {

            // Reads a line from an open file and parses it as a CSV (comma-seperated  values) row.
            // First argument is file handle; second argument maximum length (0 means no limit); third argument is the delimiter
            // Returns an array of v alues from the CSV or false if there are no more lines
            $row = fgetcsv($file, 0, self::$delimiter);
            if ($row == null || $row === false) {
                continue;
            }
            if (!$this->header) {
                $this->header = $row;
            } else {
                $this->data[] = array_combine($this->header, $row);
                $this->row_count++;
            }
        }
        fclose($file);
        return $this->data;
    }

    public function last_results() {
        return $this->data;
    }

    public function row_count() {
        return $this->row_count;
    }

    private function reset() {
        $this->header = null;
        $this->data = [];
        $this->row_count = 0;
    }

}

?>