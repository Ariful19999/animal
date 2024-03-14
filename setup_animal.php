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
    $name = mysqli_real_escape_string($con, $data['name']);
    $image = mysqli_real_escape_string($con, $data['image']);
    $age = intval($data['age']);
    $animal_type =  mysqli_real_escape_string($con, $data['animal_type']);
    $breed = mysqli_real_escape_string($con, $data['breed']);
    $description = mysqli_real_escape_string($con, $data['description']);
    $gender = mysqli_real_escape_string($con, $data['gender']);
    $owner_id = intval($data['owner_id']);
    $created_at = date("Y-m-d");

    if ($id > 0) {
        $sql = "UPDATE `animal` SET `name`='$name',`image`='$image',`age`='$age',`animal_type`='$animal_type',`breed`='$breed',`description`='$description',`gender`='$gender',`owner_id`='$owner_id' WHERE id='$id'";
        $message = "Animal " . $name . " Updated Successfully";
    } else {
        $sql = "INSERT INTO `animal`(`name`, `image`, `age`, `animal_type`, `breed`, `description`, `gender`, `owner_id`, `created_at`) VALUES ('$name','$image','$age','$animal_type','$breed','$description','$gender','$owner_id','$created_at')";
        $message = "Animal Added Successfully";
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
        'message' => 'JSON should not be empty'
    );
}

// Send JSON response back to the client
echo json_encode($response);
