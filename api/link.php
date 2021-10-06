<?php
header('Access-Control-Allow-Origin: *');
session_start();
require "../model/Link.php";
//We call the class Link to work with it

$link = new Link();

// We define the vars sent by post
$linkID = isset($_POST["id"]) ? cleanString($_POST["id"]) : "";
$pageName = isset($_POST["pageName"]) ? cleanString($_POST["pageName"]) : "";
$url = isset($_POST["link"]) ? cleanString($_POST["link"]) : "";
$username = isset($_POST["username"]) ? cleanString($_POST["username"]) : "";
$password = isset($_POST["password"]) ? cleanString($_POST["password"]) : "";
$categoryID = isset($_POST["categoryID"]) ? cleanString($_POST["categoryID"]) : "";
$apiKey = isset($_POST["token"]) ? cleanString($_POST["token"]) : "";

switch ($_GET['op']) {
    case 'CreateAndEdit':
        $username = $link->encrypt($username);
        $password = $link->encrypt($password);
        if ($linkID !== "") {
            if ($apiKey != "") {
                $res = $link->edit($linkID, $pageName, $url, $username, $password, $categoryID, 0, $apiKey);
            } else {
                $res = $link->edit($linkID, $pageName, $url, $username, $password, $categoryID, $_SESSION['userID']);
            }
            if ($res) {
                $msg = $link->message('Operation Successfully', 'The link has been edited successfully', 'success');
                echo $msg;
            } else {
                $msg = $link->message('Operation Failed', 'There was an error, try again', 'error');
                echo $msg;
            }
        } else {
            if ($apiKey != "") {
                $res = $link->insert($pageName, $url, $username, $password, $categoryID, 0, $apiKey);
            } else {
                $res = $link->insert($pageName, $url, $username, $password, $categoryID, $_SESSION['userID']);
            }
            if ($res) {
                $msg = $link->message('Operation Successfully', 'The link has been registered successfully', 'success');
                echo $msg;
            } else {
                $msg = $link->message('Operation Failed', 'There was an error, try again', 'error');
                echo $msg;
            }
        }
        break;
    case 'show':
        if ($apiKey != "") {
            $res = $link->show($linkID, 0, $apiKey);
        } else {
            $res = $link->show($linkID, $_SESSION['userID']);
        }
        if ($res == false) {
            $msg = $link->message('Operation Forbidden', "You don't have access to perform this action", 'warning');
            echo $msg;
        } else {
            $res['username'] = $link->decrypt($res['username']);
            $res['password'] = $link->decrypt($res['password']);
            echo json_encode($res);
        }
        break;
    case 'list':
        if ($apiKey != "") {
            $res = $link->listLinks(0, $apiKey);
        } else {
            $res = $link->listLinks($_SESSION['userID']);
        }
        // We declare an array
        $data = array();
        while ($reg = $res->fetch_object()) {
            $id = $reg->linkID;
            $pageName = $reg->pageName;
            $url = $reg->link;
            $login = $link->decrypt($reg->username);
            $password = $link->decrypt($reg->password);
            $categoryName = $reg->categoryName;
            $categoryID = $reg->categoryID;
            $data[] = array(
                "0" => "<a href='$url' target='_blank'><b>" . $pageName . "</b></a>",
                "1" => $login . "<span class='badge badge-secondary copy float-right' data-toggle='tooltip' actionToDo='copy' data-clipboard-text='$login' data-placement='top' title='Copy this user'>Copy</span>",
                "2" => $password . "<span class='badge badge-secondary copy float-right' data-toggle='tooltip' actionToDo='copy' data-clipboard-text='$password' data-placement='top' title='Copy this password'>Copy</span>",
                "3" => $categoryName,
                "4" => "
				<div class='col-md-11 col-sm-12 text-md-center text-sm-left font-weight-bold'>
						<i class='far fa-edit text-success pencilLink' onclick='editForm($id, new Map([[\"pageName\", \"$pageName\"], [\"link\", \"$url\"], [\"username\", \"$login\"], [\"password\", \"$password\"], [\"categoryID\", $categoryID]]))'></i><i class='far fa-trash-alt pl-1 trashLink text-danger' onclick='deleteData($id)'></i>
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
    case 'latestLinks':
        if ($apiKey != "") {
            $res = $link->latestLinks(0, $apiKey);
        } else {
            $res = $link->latestLinks($_SESSION['userID']);
        }
        // We declare an array
        $data = array();
        while ($reg = $res->fetch_object()) {
            $username = $link->decrypt($reg->username);
            $password = $link->decrypt($reg->password);
            $data[] = array(
                "0" => "<a href='$reg->link' target='_blank'><b>" . $reg->pageName . "</b></a>",
                "1" => $username . "<span class='ml-2 badge badge-secondary copy float-right' data-toggle='tooltip' actionToDo='copy' data-clipboard-text='$username' data-placement='top' title='Copy this user'>Copy</span>",
                "2" => $password . "<span class='ml-2 badge badge-secondary copy float-right' data-toggle='tooltip' actionToDo='copy' data-clipboard-text='$password' data-placement='top' title='Copy this password'>Copy</span>",
                "3" => $reg->categoryName,
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
            $res = $link->delete($linkID, 0, $apiKey);
        } else {
            $res = $link->delete($linkID, $_SESSION['userID']);
        }
        if ($res) {
            $msg = $link->message('Operation Successfully', 'The link has been deleted successfully', 'success');
            echo $msg;
        } else {
            $msg = $link->message('Operation Failed', 'It is not possible to delete the link', 'error');
            echo $msg;
        }
        break;
    case "selectCategory":
        require_once "../model/Category.php";
        $category = new Category();
        if ($apiKey != "") {
            $res = $category->listCategories(0, $apiKey);
        } else {
            $res = $category->listCategories($_SESSION['userID']);
        }
        echo "<option value=''></option>";
        while ($reg = $res->fetch_object()) {
            echo "<option value='$reg->categoryID'>$reg->name</option>";
        }
        break;
}
