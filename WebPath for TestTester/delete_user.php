<?php

$response = array();
$_POST['user_id'] = 2;
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    require 'db_connect.php';

    $db = new DB_CONNECT();
    if (!$db->mysql->connect_errno) {
        if ($stmt = $db->mysql->prepare("DELETE FROM users WHERE id = ?")) {
            if ($stmt->bind_param("i", $user_id)) {
                if ($stmt->execute()) {
                    $response["success"] = 1;
                    $response["message"] = 'User successfully deleted';
                    echo json_encode($response);
                } else {
                    $response["success"] = 0;
                    $response['message'] = 'No user found';
                    echo json_encode($response);
                }
            } else {
                $response["success"] = 0;
                $response['message'] = 'Stmt params binding error';
                echo json_encode($response);
            }
        } else {
            $response["success"] = 0;
            $response['message'] = 'Stmt preparing error';
            echo json_encode($response);
        }
    } else {
        $response["success"] = 0;
        $response['message'] = 'DataBase connection error';
        echo json_encode($response);
    }
} else {
    $response["success"] = 0;
    $response['message'] = 'Required field is missing';
    echo json_encode($response);
}