<?php

include_once "http.php";

header("Content-Type: application/json");

// Read the incoming JSON data
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
include_once './db/connection.php';

if (1) {
    // Process the received JSON data

    // INSERT INTO `user`(`id`, `name`, `user_name`, `pass`, `email`,`created_at`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]')

    $id = 0;
    if (isset($data['id'])) {
        $id = (int)$data['id'];
    }




    if ($id > 0) {
        $sql = "SELECT animal.id,animal.name,animal.image,animal.age,(SELECT animal_category.cat_name  FROM `animal_category` WHERE animal_category.id=animal.animal_type) AS animal_type,animal.breed,animal.description,(SELECT gender.type FROM `gender` WHERE gender.id=animal.gender) as gender,animal.owner_id,animal.created_at FROM `animal` WHERE id=$id";
    } else {
        $sql = "SELECT animal.id,animal.name,animal.image,animal.age,(SELECT animal_category.cat_name  FROM `animal_category` WHERE animal_category.id=animal.animal_type) AS animal_type,animal.breed,animal.description,(SELECT gender.type FROM `gender` WHERE gender.id=animal.gender) as gender,animal.owner_id,animal.created_at FROM `animal` where animal_type=1";
    }



    $res = mysqli_query($con, $sql);


    $data = array();



    while ($row = mysqli_fetch_assoc($res)) {

        $date_r = array();

        $date_r['id'] = $row['id'];
        $date_r['name'] = $row['name'];
        $date_r['age'] = $row['age'];
        $date_r['animal_type'] = $row['animal_type'];
        $date_r['breed'] = $row['breed'];
        $date_r['description'] = $row['description'];
        $date_r['gender'] = $row['gender'];
        $date_r['owner_id'] = $row['owner_id'];
        $date_r['created_at'] = $row['created_at'];

        $id = (int)$row['id'];

        $sql_in = "SELECT * FROM `comment` WHERE comment.id=$id";
        $res_in = mysqli_query($con, $sql_in);

        $date_c = array();

        while ($row_in = mysqli_fetch_assoc($res_in)) {
            $date_c['id'] = $row_in['id'];
            $date_c['text'] = $row_in['text'];
            $date_c['updated_at'] = $row_in['updated_at'];
            $date_c['created_at'] = $row_in['created_at'];
            $date_c['post'] = $row_in['animal_id'];
            $date_c['user'] = $row_in['user_id'];
        }
        $date_r['comments'] = $date_c;



        $sql_in = "SELECT * FROM `likes` WHERE likes.id=$id";
        $res_in = mysqli_query($con, $sql_in);

        $date_l = array();


        while ($row_in = mysqli_fetch_assoc($res_in)) {
            $date_l['id'] = $row_in['id'];
            $date_l['user'] = $row_in['user_id'];
            $date_l['post'] = $row_in['animal_id'];
        }
        $date_r['likes'] = $date_l;

        $data[] = $date_r;
    }



    mysqli_close($con);

    // Perform any necessary database or business logic operations here

    // Return a response
    $response = array(
        $data
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
