<?php

include_once "http.php";

header("Content-Type: application/json");

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
include_once './db/connection.php';

if ($data !== null) {
    $user_name = isset($data['username']) ? mysqli_real_escape_string($con, $data['username']) : "";
    $password = isset($data['password']) ? $data['password'] : "";

    if (!empty($user_name) && !empty($password)) {
        $sql = "SELECT * FROM user WHERE user_name='$user_name'";
        $result = mysqli_query($con, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $loginSuccessful = false;
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $row['pass'])) {
                    $loginSuccessful = true;
                    $data = array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'email' => $row['email'],
                        'username' => $row['user_name'],
                    );

                    $response = array(
                        'error' => false,
                        'message' => 'Login Successful',
                        'user' =>  $data
                    );
                    break; // Stop the loop if a match is found
                }
            }

            if (!$loginSuccessful) {
                $response = array(
                    'error' => true,
                    'message' => 'Incorrect username or password'
                );
            }
        } else {
            $response = array(
                'error' => true,
                'message' => 'User not found'
            );
        }
    } else {
        $response = array(
            'error' => true,
            'message' => 'Username and password are required'
        );
    }

    mysqli_close($con);
} else {
    $response = array(
        'error' => true,
        'message' => 'JSON data is empty'
    );
}

echo json_encode($response);
