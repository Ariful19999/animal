<?php

header("Content-Type: application/json");

// Read the incoming JSON data
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
include_once './db/connection.php';

if ($data !== null) {
    // Process the received JSON data

    // INSERT INTO `user`(`id`, `name`, `user_name`, `pass`, `email`,`created_at`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]')

    $id = 0;
    if (isset($data['id'])) {
        $id = (int)$data['id'];
    }




    if ($id > 0) {
        $sql = "SELECT * FROM `user` WHERE id='$id'";
    } else {
        $sql = "SELECT * FROM `user`";
    }


    $ressss = mysqli_query($con, $sql);



    mysqli_close($con);

    // Perform any necessary database or business logic operations here

    // Return a response
    $response = array(
        'error' => false,
        'message' => $message
    );
} else {
    // Error in decoding JSON data
    $response = array(
        'error' => true,
        'message' => 'JSON Should not be empty'
    );
}

// Send JSON response back to the client
echo json_encode($response);
