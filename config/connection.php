<?php
require_once 'global.php';
// IP,user, password, database name
$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($connection, 'SET NAMES"' . DB_ENCODE . '"');
if (mysqli_connect_errno()) {
    printf('Has been failed trying to set a connection with the database: ', mysqli_connect_errno());
    exit();
}
if (!function_exists('executeQuery')) {
    function executeQuery($sql)
    {
        global $connection;
        $query = $connection->query($sql);
        return $query;
    }
    function executeQueryReturnRow($sql)
    {
        global $connection;
        $query = $connection->query($sql);
        $row = $query->fetch_assoc();
        return $row;
    }
    function executeQueryReturnID($sql)
    {
        global $connection;
        $query = $connection->query($sql);
        return $connection->insert_id;
    }
    function cleanString($str)
    {
        global $connection;
        $str = mysqli_real_escape_string($connection, trim($str));
        return htmlspecialchars($str);
    }
}
