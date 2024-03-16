<?php

include_once "http.php";

header("Content-Type: application/json");

// Read the incoming JSON data
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
include_once './db/connection.php';

if ($data !== null) {
    // Process the received JSON data

    $id = isset($data['id']) ? intval($data['id']) : 0;
    $user_id = mysqli_real_escape_string($con, $data['user']);
    $animal_id = mysqli_real_escape_string($con, $data['post']);
    $status = isset($data['status']) ? intval($data['status']) : 1;


    $sql = "SELECT * FROM `likes` WHERE likes.user_id='$user_id'  AND likes.animal_id='$animal_id'";
    $rslt = mysqli_query($con, $sql);

    if (mysqli_num_rows($rslt) > 0) {
        $message = "You Likes this Animal Before";
        $response = array(
            'error' => false,
            'message' => $message
        );
    } else {
        if ($id > 0) {
            $sql = "UPDATE `likes` SET `user_id`='$user_id', `animal_id`='$animal_id', `status`='$status' WHERE id=$id";
            $message = "Likes Updated Successfully";
        } else {
            $sql = "INSERT INTO `likes` (`user_id`, `animal_id`, `status`) VALUES ('$user_id', '$animal_id', '$status')";
            $message = "Likes Added Successfully";
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
