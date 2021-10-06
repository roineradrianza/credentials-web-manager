<?php
require_once "../config/connection.php";
require_once "../vendor/autoload.php";

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

class Link
{
    public function __construct()
    {

    }
    // Add a new link into the database
    public function insert($link, $pageName, $username, $password, $categoryID, $userID = 0, $apiKey = "")
    {
        if ($userID == 0 and $apiKey != "") {
            $sql = "SELECT userID FROM users WHERE api_token = '$apiKey'";
            $user = executeQueryReturnRow($sql);
            if (empty($user)) {
                return false;
            } else {
                $sql = "INSERT INTO links (pageName, link, username, password, categoryID, userID) VALUES('$link', '$pageName', '$username', '$password', $categoryID, " . $user['userID'] . ");";
            }
        } else {
            $sql = "INSERT INTO links (pageName, link, username, password, categoryID, userID) VALUES('$link', '$pageName', '$username', '$password', $categoryID, $userID);";
        }
        $query = executeQuery($sql);
        return $query;
    }
    // Return a list of links
    public function listLinks($userID = 0, $apiKey = "")
    {
        if ($userID == 0 and $apiKey != "") {
            $sql = "SELECT userID FROM users WHERE api_token = '$apiKey'";
            $user = executeQueryReturnRow($sql);
            if (empty($user)) {
                return false;
            } else {
                $sql = "SELECT L.linkID AS linkID, L.link AS link, L.pageName as pageName, L.username AS username, L.password AS password, C.name AS categoryName, C.categoryID AS categoryID FROM links AS L INNER JOIN categories AS C ON C.categoryID = L.categoryID WHERE L.userID = " . $user['userID'] . ";";
            }
        } else {
            $sql = "SELECT L.linkID AS linkID, L.link AS link, L.pageName as pageName, L.username AS username, L.password AS password, C.name AS categoryName, C.categoryID AS categoryID FROM links AS L INNER JOIN categories AS C ON C.categoryID = L.categoryID WHERE L.userID = $userID;";
        }
        $query = executeQuery($sql);
        return $query;

    }
    // Return a list of the latest 10 links
    public function latestLinks($userID = 0, $apiKey = "")
    {
        if ($userID == 0 and $apiKey != "") {
            $sql = "SELECT userID FROM users WHERE api_token = '$apiKey'";
            $user = executeQueryReturnRow($sql);
            if (empty($user)) {
                return false;
            } else {
                $sql = "SELECT L.linkID AS linkID, L.link AS link, L.pageName as pageName, L.username AS username, L.password AS password, C.name AS categoryName FROM links AS L INNER JOIN categories AS C ON C.categoryID = L.categoryID WHERE L.userID = " . $user['userID'] . " ORDER BY linkID DESC LIMIT 10;";
            }
        } else {
            $sql = "SELECT L.linkID AS linkID, L.link AS link, L.pageName as pageName, L.username AS username, L.password AS password, C.name AS categoryName FROM links AS L INNER JOIN categories AS C ON C.categoryID = L.categoryID WHERE L.userID = $userID ORDER BY linkID DESC LIMIT 10;";
        }
        $query = executeQuery($sql);
        return $query;

    }
    // Shows a specific link
    public function show($linkID, $userID = 0, $apiKey = "")
    {
        if ($userID == 0 and $apiKey != "") {
            $sql = "SELECT userID FROM users WHERE api_token = '$apiKey'";
            $user = executeQueryReturnRow($sql);
            if (empty($user)) {
                return false;
            } else {
                $sql = "SELECT L.linkID AS linkID, L.link AS link, L.pageName as pageName, L.username AS username, L.password AS password, C.categoryID AS categoryID FROM links AS L INNER JOIN categories AS C ON C.categoryID = L.categoryID WHERE L.linkID = $linkID AND L.userID = " . $user['userID'] . ";";
            }
        } else {
            $sql = "SELECT L.linkID AS linkID, L.link AS link, L.pageName as pageName, L.username AS username, L.password AS password, C.categoryID AS categoryID FROM links AS L INNER JOIN categories AS C ON C.categoryID = L.categoryID WHERE L.linkID = $linkID AND L.userID = $userID;";
        }

        $query = executeQueryReturnRow($sql);
        return $query;

    }
    // Edit links
    public function edit($linkID, $pageName, $link, $username, $password, $categoryID, $userID = 0, $apiKey = "")
    {
        if ($userID == 0 and $apiKey != "") {
            $sql = "SELECT userID FROM users WHERE api_token = '$apiKey'";
            $user = executeQueryReturnRow($sql);
            if (empty($user)) {
                return false;
            } else {
                $sql = "UPDATE links SET link = '$link', pageName = '$pageName', username = '$username', password = '$password', categoryID = $categoryID WHERE linkID = $linkID and userID = " . $user['userID'] . ";";
            }
        } else {
            $sql = "UPDATE links SET link = '$link', pageName = '$pageName', username = '$username', password = '$password', categoryID = $categoryID WHERE linkID = $linkID and userID = $userID;";
        }

        $query = executeQuery($sql);
        return $query;
    }
    // Delete a Link from the database
    public function delete($linkID, $userID = 0, $apiKey = "")
    {
        if ($userID == 0 and $apiKey != "") {
            $sql = "SELECT userID FROM users WHERE api_token = '$apiKey'";
            $user = executeQueryReturnRow($sql);
            if (empty($user)) {
                return false;
            } else {
                $sql = "DELETE FROM links WHERE linkID = $linkID AND userID = " . $user['userID'] . ";";
            }
        } else {
            $sql = "DELETE FROM links WHERE linkID = $linkID AND userID = $userID;";
        }
        $query = executeQuery($sql);
        return $query;

    }
    // message to return when a function is done
    public function message($title, $message, $status)
    {
        $response = [
            'title' => "$title",
            'message' => "$message",
            'status' => "$status",
        ];
        return json_encode($response);

    }

    public static function encrypt($string = '')
    {
        if (empty($string)) {
            return $string;
        }

        $key = Key::loadFromAsciiSafeString(ENCRYPT_KEY);
        return Crypto::encrypt($string, $key);
    }

    public static function decrypt($string = '')
    {
        if (empty($string)) {
            return $string;
        }

        $key = Key::loadFromAsciiSafeString(ENCRYPT_KEY);
        return Crypto::decrypt($string, $key);
    }
}
