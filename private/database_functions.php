<?php

/**
 * Common useful mysqli object methods and properties
 * 
 * $db->query($sql);
 * $db->escape_string($string);
 * 
 * $db->affected_rows;
 * $db->insert_id;
 * 
 * $result->fetch_assoc();
 * $result->fetch_row();
 * $result->fetch_array();
 * $result->fetch_object();
 * 
 * $result->free();
 * $result->num_rows;
 * 
 */

function db_connect() {
    $connection = new mysqli(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
    confirm_db_connect($connection);
    return $connection;
}

function confirm_db_connect($connection) {
    if ($connection->connect_errno) {
        $msg = "Database connection failed: ";
        $msg .= $connection->connect_error;
        $msg .= " (" . $connection->connect_errorno . ")";
        exit($msg);
    }
}

function db_disconnect($connection) {
    if (isset($connection)) {
        $connection->close();
    }
}

?>