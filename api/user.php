<?php
session_start();
require "../model/User.php";
require "../vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
//We call the class User to work with it

$user = new User;
$projectName = PROJECT_NAME;
// We define the vars sent by post
$userID = isset($_POST["userID"]) ? cleanString($_POST["userID"]) : "";
$firstName = isset($_POST["firstName"]) ? cleanString($_POST["firstName"]) : "";
$lastName = isset($_POST["lastName"]) ? cleanString($_POST["lastName"]) : "";
$email = isset($_POST["email"]) ? cleanString($_POST["email"]) : "";
$emailCompare = isset($_POST["emailCompare"]) ? cleanString($_POST["emailCompare"]) : "";
$password = isset($_POST["password"]) ? cleanString($_POST["password"]) : "";
$resetCode = isset($_POST["resetCode"]) ? cleanString($_POST["resetCode"]) : "";
$type = isset($_POST["type"]) ? cleanString($_POST["type"]) : "";

switch ($_GET['op']) {

    case 'CreateAndEdit':
        if ($userID !== "") {
            if ($password !== "") {
                $password = hash("MD5", $password);
            }
            if ($emailCompare == $email) {
                $email = "";
            }
            $res = $user->edit($userID, $firstName, $lastName, $email, $password, $type);
            if ($res) {
                $msg = $user->message('Operation Successfully', 'The user has been edited successfully', 'success');
                echo $msg;
            } else {
                $msg = $user->message('Operation Failed', 'The email already exists, try again', 'error');
                echo $msg;
            }
        } else {
            $hashPassword = hash("MD5", $password);
            $res = $user->insert($firstName, $lastName, $email, $hashPassword, $type);
            if ($res) {
                $msg = $user->message('Operation Successfully', 'The user has been registered successfully', 'success');
                echo $msg;
            } else {
                $msg = $user->message('Operation Failed', 'The email already exists, try again', 'error');
                echo $msg;
            }
        }
        break;
    case 'show':
        $res = $user->show($userID);
        echo json_encode($res);
        break;
    case 'list':
        $res = $user->listUsers();
        // We declare an array
        $data = array();
        while ($reg = $res->fetch_object()) {
            $data[] = array(
                "0" => $reg->firstName . " " . $reg->lastName,
                "1" => $reg->email,
                "2" => $reg->type,
                "3" => $reg->last_connection,
                "4" => "
				<div class='col-11 text-center font-weight-bold'>
					<i class='far fa-edit pr-1 text-success pencilLink' onclick='showUser($reg->userID)' data-toggle='tooltip' data-placement='left' title='Edit this user'></i>
					<i class='far fa-trash-alt pl-1 trashLink text-danger' onclick='deleteUser($reg->userID)' data-toggle='tooltip' data-placement='right' title='Delete this user'></i>
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
    case 'list-currently-signed':
        $res = $user->listCurrentlySigned();
        // We declare an array
        $data = array();
        while ($reg = $res->fetch_object()) {
            $data[] = array(
                "0" => $reg->firstName . " " . $reg->lastName,
                "1" => $reg->email,
                "2" => $reg->type,
                "3" => "
					<div class='col-11 text-center font-weight-bold'>
						<i class='fas fa-sign-out-alt pr-1 trashLink text-danger' onclick='logoutUser($reg->userID)' data-toggle='tooltip' data-placement='left' title='Sign out this user'></i>
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
    case 'sign-in':
        $hashPassword = hash('MD5', $password);
        $res = $user->verify($email, $hashPassword);
        $fetch = $res->fetch_object();
        if (!empty($fetch)) {
            $user->change_signed_status($fetch->userID, 1);
            $user->update_signed_at($fetch->userID);
            $_SESSION['userID'] = $fetch->userID;
            $_SESSION['firstName'] = $fetch->firstName;
            $_SESSION['lastName'] = $fetch->lastName;
            $_SESSION['email'] = $fetch->email;
            $_SESSION['is_signed'] = 1;
            $_SESSION['type'] = $fetch->type;
            if ($fetch->api_token === "" or $fetch->api_token === null) {
                $_SESSION['apiKey'] = "";
            } else {
                $_SESSION['apiKey'] = $fetch->api_token;
            }
        } else {

        }
        echo json_encode($fetch);
        break;
    case 'sign-up':
        $hashPassword = hash('MD5', $password);
        $res = $user->register($firstName, $lastName, $email, $hashPassword);
        if ($res > 0) {
            $_SESSION['userID'] = $res;
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['email'] = $email;
            $_SESSION['type'] = 'member';
            $_SESSION['is_signed'] = 1;
            $_SESSION['apiKey'] = '';
            $msg = $user->message('Operation Successfully', 'Your has been registered!', 'success');
        } else {
            $msg = $user->message('Operation Failed', 'The email that you has sent already exists, try again.', 'error');
        }
        echo $msg;
        break;
    case 'logout':
        $user->change_signed_status($_SESSION['userID']);
        //It clean variables session
        session_unset();
        //We destroy the session
        session_destroy();
        //Redirect to the login page
        header("Location: ../login.php");
        break;
    case 'logout-external':
        $res = $user->change_signed_status($userID);
        if ($res) {
            $msg = $user->message('Operation Sucessfully', 'The user has been signed out', 'success');
        } else {
            $msg = $user->message('Operation Failed', 'It is not possible to sign out the user', 'error');
        }
        echo $msg;
        break;
    case 'delete':
        $res = $user->delete($userID);
        if ($res) {
            $msg = $user->message('Operation Successfully', 'The user has been deleted successfully', 'success');
            echo $msg;
        } else {
            $msg = $user->message('Operation Failed', 'It is not possible to delete the user', 'error');
            echo $msg;
        }
        break;
    case 'resetPasswordRequest':
        $code = $user->generateResetToken();
        $response = $user->resetPasswordRequest($email, $code);
        if ($response >= 1) {
            include "../view/template/emails/recover_password_email.php";
            $webEmail = WEBSITE_EMAIL;
            $mail = new PHPMailer;
            //Server settings
            $mail->isSMTP(); // Send using SMTP
            $mail->Host = WEBSITE_EMAIL_HOST; // Set the SMTP server to send through

            //Check if is required authenticate in to the email
            if (WEBSITE_EMAIL_SMTPAuth) {
                $mail->SMTPAuth = true;
                $mail->Username = WEBSITE_EMAIL_USERNAME; // SMTP username
                $mail->Password = WEBSITE_EMAIL_PASSWORD; // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption;
            } else {
                $mail->SMTPAuth = false;
                $mail->SMTPAutoTLS = false;
            }
            $mail->Port = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom($webEmail, $projectName);
            $mail->addAddress($email); // Add a recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $projectName . ' - Password Reset';
            $mail->Body = $recover_template_msg;
            if ($mail->send()) {
                $msg = $user->message('Password reset link sent', 'Please check your email', 'success');
                echo $msg;
            } else {
                $msg = $user->message('There was a problem', "It was not possible to send the reset password email. Error:$mail->ErrorInfo", 'error');
                echo $msg;
            }
        } else {
            $msg = $user->message('There was a problem', "The email that you sent doesn't match with any user", 'error');
            echo $msg;
        }
        break;
    case 'resetPassword':
        $passwordHashed = hash("MD5", $password);
        $resetPassword = $user->resetPassword($resetCode, $passwordHashed);
        if ($resetPassword) {
            $msg = $user->message('Password reseted succesfully', 'Your password has been reseted, try to login again with your new password', 'success');
        } else {
            $msg = $user->message('There was a problem', 'Password reset was not possible', 'error');
        }
        echo $msg;
        break;
    case 'updateProfile':
        if ($password != "") {
            $hashPassword = hash("MD5", $password);
        }
        if ($email == $_SESSION['email']) {
            $email = "";
        }
        $res = $user->edit($_SESSION['userID'], $firstName, $lastName, $email, $hashPassword, $_SESSION['type']);
        if ($res) {
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['email'] = $_POST['email'];
            $msg = $user->message('Operation Successfully', 'Your information has been updated', 'success');
        } else {
            $msg = $user->message('Operation Unsuccessfully', 'Your information cannot be updated', 'error');
        }
        echo $msg;
        break;
    case 'updateLastConnection':
        if (!empty($_SESSION['userID'])) {
            $user_selected = $user->show($_SESSION['userID']);
            if (!$user_selected['is_signed']) {
                $msg = $user->message('logout', 'It is required to sign in again', 'warning');
            } else {
                $res = $user->update_last_connection($_SESSION['userID']);
                $msg = $user->message('Session updated', '', 'success');
            }
        } else {
            $msg = $user->message('logout', 'It is required to sign in again', 'warning');
        }
        echo $msg;
        break;
    case 'generate-apiKey':
        if (!isset($_SESSION['userID'])) {
            $msg = $user->message('Operation forbidden', 'You are not authorized to perform this action', 'warning');
        } else {
            $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $input_length = strlen($input);
            $random_string = '';
            for ($i = 0; $i < 60; $i++) {
                $random_character = $input[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }
            $token = $random_string . date("Ymd");
            $res = $user->generateApiKey($_SESSION['userID'], $token);
            if ($res) {
                $_SESSION['apiKey'] = $token;
                $msg = $user->message('Operation Successfully', 'Your <b>API Key</b> has been generated, you can use for connect through your credentials by an external app: <b>' . $token . '</b>', 'success');
            } else {
                $msg = $user->message('Operation Unsuccessfully', 'Your API Key has not been generated', 'error');
            }
        }
        echo $msg;
        break;
    case 'showApiKey':
        if (!isset($_SESSION['userID'])) {
            $msg = $user->message('Operation forbidden', 'You are not authorized to perform this action', 'warning');
            echo $msg;
        } else {
            $res = $user->showApiKey($_SESSION['userID']);
            echo $res['apiKey'];
        }
        break;
}
