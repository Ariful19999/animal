<?php

include_once "http.php";

// header("Content-Type: application/json");

// // Read the incoming JSON data
// $jsonData = file_get_contents('php://input');
// $_POST = json_decode($jsonData, true);
include_once './db/connection.php';

if (1) {
    // Process the received JSON data

    // formData . append('petName', petName);
    // formData . append('image', image);
    // formData . append('age', age);
    // formData . append('animalType', animalType);
    // formData . append('breed', breed);
    // formData . append('description', description);
    // formData . append('gender', gender);
    // formData . append('ownerId',  ownerId);

    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $name = mysqli_real_escape_string($con, $_POST['petName']);

    // $image = mysqli_real_escape_string($con, $_POST['image']);

    $age = intval($_POST['age']);
    $animal_type =  mysqli_real_escape_string($con, $_POST['animalType']);
    $breed = mysqli_real_escape_string($con, $_POST['breed']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $owner_id = intval($_POST['ownerId']);
    $created_at = date("Y-m-d");

    $image = "";

    // $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    // $name = mysqli_real_escape_string($con, $_POST['name']);
    // $image = mysqli_real_escape_string($con, $_POST['image']);
    // $age = intval($_POST['age']);
    // $animal_type =  mysqli_real_escape_string($con, $_POST['animal_type']);
    // $breed = mysqli_real_escape_string($con, $_POST['breed']);
    // $description = mysqli_real_escape_string($con, $_POST['description']);
    // $gender = mysqli_real_escape_string($con, $_POST['gender']);
    // $owner_id = intval($_POST['owner_id']);
    // $created_at = date("Y-m-d");

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // File was successfully uploaded
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_name = $_FILES['image']['name'];

        // Move the uploaded file to the desired location
        $upload_directory = 'uploads/';
        $target_path = $upload_directory . basename($file_name);


        if (move_uploaded_file($file_tmp, $target_path)) {
            $image = "http://localhost/animal" . $target_path;
        }
    }

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
