<?php

header("Content-Type: application/json");

// Read the incoming JSON data
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
include_once './db/connection.php';

if ($data !== null) {
    // Process the received JSON data
    $id = isset($data['id']) ? intval($data['id']) : 0;
    $f_name = mysqli_real_escape_string($con, $data['firstName']);
    $l_name = mysqli_real_escape_string($con, $data['lastName']);
    $name = $f_name . " " . $l_name;
    $user_name = mysqli_real_escape_string($con, $data['username']);
    $pass = password_hash($data['password'], PASSWORD_DEFAULT); // Use bcrypt or Argon2 for stronger hashing
    $email = mysqli_real_escape_string($con, $data['email']);
    $created_at = date("Y-m-d"); // Use a format compatible with your database

    if ($id > 0) {
        $sql = "UPDATE `user` SET `name`='$name',`user_name`='$user_name',`pass`='$pass',`email`='$email' WHERE id='$id'";
        $message = "User $name Updated Successfully";
    } else {
        $sql = "INSERT INTO `user`(`name`, `user_name`, `pass`, `email`, `created_at`) VALUES ('$name','$user_name','$pass','$email','$created_at')";
        $message = "User Added Successfully";
    }

    if (mysqli_query($con, $sql)) {
        $response = array(
            'error' => false,
            'message' => $message
        );
    } else {
        $response = array(
            'error' => true,
            'message' => 'Error: ' . mysqli_error($con)
        );
    }

    mysqli_close($con);
} else {
    // Error in decoding JSON data
    $response = array(
        'error' => true,
        'message' => 'JSON Should not be empty'
    );
}

// Send JSON response back to the client
echo json_encode($response);
