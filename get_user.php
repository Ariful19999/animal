<?php

include_once "http.php";

//header("Content-Type: application/json");

// // Read the incoming JSON data
// $jsonData = file_get_contents('php://input');
// $data = json_decode($jsonData, true);
include_once './db/connection.php';

if (1) {
    // Process the received JSON data

    // INSERT INTO `user`(`id`, `name`, `user_name`, `pass`, `email`,`created_at`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]')

    $id = 0;
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
    }

    if ($id > 0) {
        $sql = "SELECT * FROM `user` where id=$id;";
    } else {
        $sql = "SELECT * FROM `user`;";
    }




    $res = mysqli_query($con, $sql);


    $data = array();



    while ($row = mysqli_fetch_assoc($res)) {

        $date_r = array();

        $words = explode(" ", $row['name']);

        $date_r['id'] = $row['id'];
        $date_r['name'] = $row['name'];
        $date_r['username'] = $row['user_name'];
        $date_r['password'] = $row['pass'];
        $date_r['email'] = $row['email'];
        $date_r['first_name'] = $words[0];
        $date_r['last_name'] = $words[1];



        $id = (int)$row['id'];

        $sql_in = "SELECT * FROM `comment` WHERE comment.user_id=$id";
        $res_in = mysqli_query($con, $sql_in);

        $date_cc = array();

        while ($row_in = mysqli_fetch_assoc($res_in)) {

            $date_c = array();
            $date_c['id'] = $row_in['id'];
            $date_c['text'] = $row_in['text'];
            $date_c['updated_at'] = $row_in['updated_at'];
            $date_c['created_at'] = $row_in['created_at'];
            $date_c['post'] = $row_in['animal_id'];
            $date_c['user'] = $row_in['user_id'];

            $date_cc[] = $date_c;
        }
        $date_r['comments'] = $date_cc;



        $sql_in = "SELECT DISTINCT likes.animal_id, user_id,id FROM `likes` WHERE likes.user_id=$id";
        $res_in = mysqli_query($con, $sql_in);

        $date_ll = array();

        while ($row_in = mysqli_fetch_assoc($res_in)) {
            $date_l = array();
            $date_l['id'] = $row_in['id'];
            $date_l['user'] = $row_in['user_id'];
            $date_l['post'] = $row_in['animal_id'];

            $date_ll[] = $date_l;
        }
        $date_r['likes'] = $date_ll;

        $data[] = $date_r;
    }



    mysqli_close($con);

    // Perform any necessary database or business logic operations here

    // Return a response
    $response = array(
        'error' => false,
        'data' => $data
    );
} else {
    // Error in decoding JSON data
    $response = array(
        'error' => true,
        'message' => 'JSON Should not be empty'
    );
}

// Send JSON response back to the client
echo json_encode($data);
