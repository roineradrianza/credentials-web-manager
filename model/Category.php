<?php
require_once "../config/connection.php";

class Category
{
    public function __construct()
    {

    }
    // Add a new category into the database
    public function insert($name, $description, $userID = 0, $apiKey = "")
    {

        if ($userID == 0 and $apiKey != "") {
            $sql = "SELECT userID FROM users WHERE api_token = '$apiKey'";
            $user = executeQueryReturnRow($sql);
            if (empty($user)) {
                return false;
            } else {
                $sql = "INSERT INTO categories (name, description, userID) VALUES('$name','$description', " . $user['userID'] . ");";
            }
        } else {
            $sql = "INSERT INTO categories (name, description, userID) VALUES('$name','$description', $userID);";
        }
        $query = executeQuery($sql);
        return $query;

    }
    // Return a list of categories
    public function listCategories($userID = 0, $apiKey = "")
    {

        if ($userID == 0 and $apiKey != "") {
            $sql = "SELECT userID FROM users WHERE api_token = '$apiKey'";
            $user = executeQueryReturnRow($sql);
            if (empty($user)) {
                return false;
            } else {
                $sql = "SELECT * FROM categories WHERE userID = " . $user['userID'] . ";";
            }
        } else {
            $sql = "SELECT * FROM categories WHERE userID = $userID;";
        }
        $query = executeQuery($sql);
        return $query;

    }
    // Return a list of categories and a count of how many links are linked to the category
    public function listCount($userID = 0, $apiKey = "")
    {
        if ($userID == 0 and $apiKey != "") {
            $sql = "SELECT userID FROM users WHERE api_token = '$apiKey'";
            $user = executeQueryReturnRow($sql);
            if (empty($user)) {
                return false;
            } else {
                $sql = "SELECT C.name as name, COUNT(L.categoryID) as total FROM categories AS C INNER JOIN links AS L ON L.categoryID = C.categoryID WHERE C.userID = " . $user['userID'] . " GROUP BY C.name HAVING total ORDER BY total DESC;";
            }
        } else {
            $sql = "SELECT C.name as name, COUNT(L.categoryID) as total FROM categories AS C INNER JOIN links AS L ON L.categoryID = C.categoryID WHERE C.userID = $userID GROUP BY C.name HAVING total ORDER BY total DESC;";
        }
        $query = executeQuery($sql);
        return $query;

    }
    // Shows a specific category
    public function show($categoryID, $userID = 0, $apiKey = "")
    {
        if ($userID == 0 and $apiKey != "") {
            $sql = "SELECT userID FROM users WHERE api_token = '$apiKey'";
            $user = executeQueryReturnRow($sql);
            if (empty($user)) {
                return false;
            } else {
                $sql = "SELECT * FROM categories WHERE categoryID = $categoryID and userID = " . $user['userID'] . ";";
            }
        } else {
            $sql = "SELECT * FROM categories WHERE categoryID = $categoryID and userID = $userID";
        }
        $query = executeQueryReturnRow($sql);
        return $query;

    }
    // Edit categories
    public function edit($categoryID, $name, $description, $userID = 0, $apiKey = "")
    {
        if ($userID == 0 and $apiKey != "") {
            $sql = "SELECT userID FROM users WHERE api_token = '$apiKey'";
            $user = executeQueryReturnRow($sql);
            if (empty($user)) {
                return false;
            } else {
                $sql = "UPDATE categories SET name = '$name', description = '$description' WHERE categoryID = $categoryID AND userID = " . $user['userID'] . ";";
            }
        } else {
            $sql = "UPDATE categories SET name = '$name', description = '$description' WHERE categoryID = $categoryID AND userID = $userID;";
        }
        $query = executeQuery($sql);
        return $query;
    }
    // Delete a category from the database
    public function delete($categoryID, $userID = 0, $apiKey = "")
    {
        if ($userID == 0 and $apiKey != "") {
            $sql = "SELECT userID FROM users WHERE api_token = '$apiKey'";
            $user = executeQueryReturnRow($sql);
            if (empty($user)) {
                return false;
            } else {
                $sql = "DELETE FROM categories WHERE categoryID = $categoryID AND userID = " . $user['userID'] . ";";
            }
        } else {
            $sql = "DELETE FROM categories WHERE categoryID = $categoryID AND userID = $userID;";
        }
        $sql = "DELETE FROM categories WHERE categoryID = $categoryID;";
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

}
