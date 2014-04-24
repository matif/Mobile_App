<?php
define('baseURL','http://localhost/jmobile/');
// You need to add server side validation and better error handling here
$dbDap = null;

function getDBConnection() {
    $databasename = 'jmobile';
    $host = 'localhost';
    $username = 'root';
    $password = '';
    global $dbDap;
    $dbDap = @mysql_connect($host, $username, $password);
    $selectdb = @mysql_select_db($databasename);
 if (!$selectdb)
        die("could not connect to database ");
}

function executeQuery($query) {
    global $dbDap;
    if (!$dbDap) {
        $dbDap = getDBConnection();
    }
    $result = array();

    $result_query = mysql_query($query);
    if (is_resource($result_query)) {
        while ($row = mysql_fetch_assoc($result_query)) {
            $result[] = $row;
        }
        return $result;
    } else {
        return $result;
    }
}

function insertData($table, $arr) {
    global $dbDap;
    if (!$dbDap) {
        $dbDap = getDBConnection();
    }
    $query = "INSERT INTO `$table` ";
    foreach ($arr as $k => $a) {
        $names[] = '`' . $k . '`';
        $values[] = "" . sqlSafePlease($a) . "";
    }
    $query .= '(' . implode(',', $names) . ') VALUES (' . implode(',', $values) . ')';
    executeQuery($query);
    return mysql_insert_id();
}

function sqlSafePlease($value, $quote = "'") {
    global $dbDap;
    if (!$dbDap) {
        $dbDap = getDBConnection();
    }

    $value = str_replace(array("\'", "'"), "&#39;", $value);

    // Stripslashes 
    if (get_magic_quotes_gpc()) {
        $value = stripslashes($value);
    }
    // Quote value
//    if (version_compare(phpversion(), "4.3.0") == "-1") {
//        $value = mysql_escape_string($value);
//    } else {
//        $value = mysql_escape_string($value);
//    }
    $value = $quote . trim($value) . $quote;

    return $value;
}

function updateData($table, $arr, $where = null) {
    global $dbDap;
    if (!$dbDap) {
        $dbDap = getDBConnection();
    }
    if ($where) {
        $query = "UPDATE `$table` SET ";
        $i = 1;
        foreach ($arr as $key => $a) {
            if (sizeof($arr) > $i) {
                $query .= " `$key`=" . sqlSafePlease($a) . " , ";
            } else {
                $query .= " `$key`=" . sqlSafePlease($a) . "";
            }
            $i++;
        }
        $query.=' WHERE ' . $where;
        return executeQuery($query);
    } else {
        return FALSE;
    }
}

?>