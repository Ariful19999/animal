<?php

include_once "http.php";

// header("Content-Type: application/json");

// // Read the incoming JSON data
// $jsonData = file_get_contents('php://input');
// $data = json_decode($jsonData, true);
include_once './db/connection.php';

if (1) {
    // Process the received JSON data


    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    $rslt = 0;
    if ($id > 0) {
        $sql = "DELETE  FROM `likes` WHERE likes.id=$id";
        $message = "Remove Success";
        $rslt = mysqli_query($con, $sql);
    } else {
        $message = "Id is not Valid";
    }

    if ($rslt) {
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
