<?php

header("Content-Type: application/json");

// Read the incoming JSON data
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
include_once './db/connection.php';

if ($data !== null) {
    // Process the received JSON data

    // Extract username and password from JSON data
    $user_name = isset($data['user_name']) ? mysqli_real_escape_string($con, $data['user_name']) : "";
    $password = isset($data['pass']) ? $data['pass'] : "";

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
                $response = array(
                    'error' => false,
                    'message' => 'Login Successful',
                    'user_id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'user_name' => $row['user_name']
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
