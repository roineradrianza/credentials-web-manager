<?php
header('Access-Control-Allow-Origin: *');
session_start();
require "../model/Category.php";
//We call the class category to work with it

$category = new Category();

// We define the vars sent by post
$categoryID = isset($_POST["id"]) ? cleanString($_POST["id"]) : "";
$name = isset($_POST["name"]) ? cleanString($_POST["name"]) : "";
$description = isset($_POST["description"]) ? cleanString($_POST["description"]) : "";
$apiKey = isset($_POST["token"]) ? cleanString($_POST["token"]) : "";

switch ($_GET['op']) {

    case 'CreateAndEdit':
        if ($categoryID !== "") {
            if ($apiKey != "") {
                $res = $category->edit($categoryID, $name, $description, 0, $apiKey);
            } else {
                $res = $category->edit($categoryID, $name, $description, $_SESSION['userID']);
            }
            if ($res) {
                $msg = $category->message('Operation Successfully', 'The category has been edited successfully', 'success');
                echo $msg;
            } else {
                $msg = $category->message('Operation Failed', 'There was an error, try again', 'error');
                echo $msg;
            }
        } else {
            if ($apiKey != "") {
                $res = $category->insert($name, $description, 0, $apiKey);
            } else {
                $res = $category->insert($name, $description, $_SESSION['userID']);
            }
            if ($res) {
                $msg = $category->message('Operation Successfully', 'The category has been registered successfully', 'success');
                echo $msg;
            } else {
                $msg = $category->message('Operation Failed', 'There was an error, try again', 'error');
                echo $msg;
            }
        }
        break;
    case 'show':
        if ($apiKey != "") {
            $res = $category->show($categoryID, 0, $apiKey);
        } else {
            $res = $category->show($categoryID, $_SESSION['userID']);
        }
        if ($res == false) {
            $msg = $link->message('Operation Forbidden', "You don't have access to perform this action", 'warning');
            echo $msg;
        } else {
            echo json_encode($res);
        }
        break;
    case 'list':
        if ($apiKey != "") {
            $res = $category->listCategories(0, $apiKey);
        } else {
            $res = $category->listCategories($_SESSION['userID']);
        }
        // We declare an array
        $data = array();
        while ($reg = $res->fetch_object()) {
            $id = $reg->categoryID;
            $name = $reg->name;
            $description = $reg->description;
            $data[] = array(
                "0" => $name,
                "1" => $description,
                "2" => "<div class='col-11 text-center font-weight-bold'>
						<i class='far fa-edit pr-1 text-success pencilLink' onclick='editForm($id, new Map([[\"name\", \"$name\"], [\"description\", \"$description\"]]))' data-toggle='tooltip' data-placement='left' title='Edit this category'></i><i class='far fa-trash-alt pl-1 trashLink text-danger' onclick='deleteData($id)' data-toggle='tooltip' data-placement='right' title='Delete this category'></i>
				</div>",
            );
        }
        $results = array(
            "sEcho" => 1, //Information for the datatables
            "iTotalRecords" => count($data), //Total registers count
            "iTotalDisplayRecords" => count($data), //Total of registers to display
            "aaData" => $data,
        );
        echo json_encode($results);
        break;
    case 'listCount':
        if ($apiKey != "") {
            $res = $category->listCount(0, $apiKey);
        } else {
            $res = $category->listCount($_SESSION['userID']);
        }
        // We declare an array
        $data = array();
        while ($reg = $res->fetch_object()) {
            $data[] = array(
                "0" => $reg->name,
                "1" => $reg->total,
            );
        }
        $results = array(
            "sEcho" => 1, //Information for the datatables
            "iTotalRecords" => count($data), //Total registers count
            "iTotalDisplayRecords" => count($data), //Total of registers to display
            "aaData" => $data,
        );
        echo json_encode($results);
        break;
    case 'delete':
        if ($apiKey != "") {
            $res = $category->delete($categoryID, 0, $apiKey);
        } else {
            $res = $category->delete($categoryID, $_SESSION['userID']);
        }
        if ($res) {
            $msg = $category->message('Operation Successfully', 'The category has been deleted successfully', 'success');
            echo $msg;
        } else {
            $msg = $category->message('Operation Failed', 'It is not possible to delete the category', 'error');
            echo $msg;
        }
        break;
}
