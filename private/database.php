<?php

function db_connect() {
    $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_PASS);
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
 * $result->free();
 * $result->num_rows;
 */

?>