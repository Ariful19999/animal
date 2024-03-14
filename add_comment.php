<?php

include_once "http.php";

header("Content-Type: application/json");

// Read the incoming JSON data
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
include_once './db/connection.php';

if ($data !== null) {
    // Process the received JSON data

    // Extract necessary data from JSON
    $text = mysqli_real_escape_string($con, $data['text']);
    $user_id = intval($data['user_id']);
    $animal_id = intval($data['animal_id']);

    // Get current timestamp
    $current_timestamp = date("Y-m-d H:i:s");

    // Prepare and execute the SQL query
    $sql = "INSERT INTO `comment` (`text`, `updated_at`, `created_at`, `user_id`, `animal_id`) VALUES ('$text', '$current_timestamp', '$current_timestamp', $user_id, $animal_id)";

    if (mysqli_query($con, $sql)) {
        $response = array(
            'error' => false,
            'message' => 'Comment added successfully'
        );
    } else {
        // Error in executing the query
        $response = array(
            'error' => true,
            'message' => 'Error: ' . mysqli_error($con)
        );
    }

    // Close the database connection
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
