<?php
require_once "../config/connection.php";

class User
{
    // Add a new user into the database
    public function insert($firstName, $lastName, $email, $password, $userType)
    {

        $sql = "INSERT INTO users (firstName, lastName, email, password, type) VALUES('$firstName', '$lastName','$email','$password', '$userType')";
        $query = executeQuery($sql);
        return $query;

    }
    public function register($firstName, $lastName, $email, $password)
    {

        $sql = "INSERT INTO users (firstName, lastName, email, password) VALUES('$firstName','$lastName', '$email', '$password')";
        $query = executeQueryReturnID($sql);
        return $query;

    }
    // Return a list of users
    public function listUsers()
    {

        $sql = "SELECT * FROM users";
        $query = executeQuery($sql);
        return $query;
    }

    // Return a list of users currently signed
    public function listCurrentlySigned()
    {

        $sql = "SELECT *, TIME_TO_SEC(TIMEDIFF(last_connection, CURRENT_TIMESTAMP())) last_connection_seconds
		FROM users HAVING last_connection_seconds >= -120 AND last_connection_seconds <= 0 AND is_signed = 1;";
        $query = executeQuery($sql);
        return $query;

    }

    // Shows a specify user
    public function show($userID)
    {

        $sql = "SELECT * FROM users WHERE userID = $userID";
        $query = executeQueryReturnRow($sql);
        return $query;

    }
    // Edit users
    public function edit($userID, $firstName, $lastName, $email, $password, $userType)
    {

        if ($password == "" and $email == "") {
            $sql = "UPDATE users SET firstName = '$firstName', lastName = '$lastName', type = '$userType' WHERE userID = $userID";
        } else if ($password == "" and $email != "") {
            $sql = "UPDATE users SET firstName = '$firstName', lastName = '$lastName', email = '$email', type = '$userType' WHERE userID = $userID";
        } else if ($password != "" and $email == "") {
            $sql = "UPDATE users SET firstName = '$firstName', lastName = '$lastName', password = '$password', type = '$userType' WHERE userID = $userID";
        } else {
            $sql = "UPDATE users SET firstName = '$firstName', lastName = '$lastName', password = '$password', email = '$email', type = '$userType' WHERE userID = $userID";
        }
        $query = executeQuery($sql);
        return $query;

    }
    // Verify an user that is attempting to sign in
    public function verify($email, $password)
    {

        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $query = executeQuery($sql);
        return $query;

    }
    // Method to request a reset password code
    public function resetPasswordRequest($email, $token)
    {
        $sql = "SELECT COUNT(email) as 'emailNumber' FROM users WHERE email = '$email' ";
        $verifyEmail = executeQueryReturnRow($sql);
        $fetch = (array) $verifyEmail;
        if ($fetch['emailNumber'] == 1) {
            $sql = "UPDATE users SET resetCode ='$token' WHERE email = '$email' ";
            $query = executeQuery($sql);
        } else {
            $query = false;
        }
        return $query;
    }
    //Method to reset the password with the reset code
    public function resetPassword($token, $password)
    {
        $sql = "SELECT COUNT(email) as 'emailNumber' FROM users WHERE resetCode = '$token' ";
        $verifyEmail = executeQueryReturnRow($sql);
        $fetch = (array) $verifyEmail;
        if ($fetch['emailNumber'] == 1) {
            $sql = "UPDATE users SET password = '$password', resetCode = '' WHERE resetCode ='$token' ";
            $query = executeQuery($sql);
        } else {
            $query = false;
        }
        return $query;
    }

    // Change user signed status
    public function change_signed_status($userID, $status = 0)
    {

        $sql = "UPDATE users SET is_signed = $status WHERE userID = $userID";
        $query = executeQuery($sql);
        return $query;

    }

    // Change user signed status
    public function update_last_connection($userID)
    {

        $sql = "UPDATE users SET last_connection = CURRENT_TIMESTAMP() WHERE userID = $userID";
        $query = executeQuery($sql);
        return $query;

    }

    // Change user signed at
    public function update_signed_at($userID)
    {

        $sql = "UPDATE users SET signed_at = CURRENT_TIMESTAMP() WHERE userID = $userID";
        $query = executeQuery($sql);
        return $query;

    }

    // Delete an user from the database
    public function delete($userID)
    {

        $sql = "DELETE FROM users WHERE userID = $userID";
        $query = executeQuery($sql);
        return $query;

    }
    // Generate a new API Key for the user
    public function generateApiKey($userID, $apiKey)
    {

        $sql = "UPDATE users SET api_token = '$apiKey' WHERE userID = $userID";
        $query = executeQuery($sql);
        return $query;

    }
    // Return user API Key
    public function showApiKey($userID)
    {

        $sql = "SELECT api_token AS apiKey FROM users WHERE userID = $userID";
        $query = executeQueryReturnRow($sql);
        return $query;

    }
    public function generateResetToken()
    {
        $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < 16; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        $token = $random_string . date("Ymd");
        return $token;
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
