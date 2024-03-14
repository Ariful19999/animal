<?php

include_once "http.php";

header("Content-Type: application/json");

// Read the incoming JSON data
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
include_once './db/connection.php';

if ($data !== null) {
    // Process the received JSON data

    // Extract username and password from JSON data
    $user_name = isset($data['username']) ? mysqli_real_escape_string($con, $data['username']) : "";
    $password = isset($data['password']) ? $data['password'] : "";

    // Validate input data
    if (!empty($user_name) && !empty($password)) {
        // Hash the password using bcrypt
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Query to check user credentials
        $sql = "SELECT * FROM `user` ";
        $result = mysqli_query($con, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Verify the password
            if (password_verify($password, $row['pass'])) {
                // Password is correct
                $data = array();
                $data['id'] = $row['id'];
                $data['name'] = $row['name'];
                $data['email'] = $row['email'];
                $data['username'] = $row['user_name'];

                $response = array(
                    'error' => false,
                    'message' => 'Login Successful',
                    'user' =>  $data
                );
            } else {
                // Password is incorrect
                $response = array(
                    'error' => true,
                    'message' => 'Incorrect username or password'
                );
            }
        } else {
            // User not found
            $response = array(
                'error' => true,
                'message' => 'User not found'
            );
        }
    } else {
        // Missing username or password
        $response = array(
            'error' => true,
            'message' => 'Username and password are required'
        );
    }

    // Close database connection
    mysqli_close($con);
} else {
    // Error in decoding JSON data
    $response = array(
        'error' => true,
        'message' => 'JSON data is empty'
    );
}

// Send JSON response back to the client
echo json_encode($response);
