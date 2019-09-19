<?php

$response = array();
if (isset($_POST['user_id']) && isset($_POST['user_login']) && isset($_POST['user_email']) && isset($_POST['user_password'])) {

    $user_id = $_POST['user_id'];
    $user_login = $_POST['user_login'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    require 'db_connect.php';

    $db = new DB_CONNECT();
    if (!$db->mysql->connect_errno) {
        if ($stmt = $db->mysql->prepare("UPDATE users SET login = ?, email = ?, password=? WHERE id = ?")) {
            if ($stmt->bind_param("sssi", $user_login, $user_email, $user_password, $user_id)) {
                if ($stmt->execute()) {
                    $response["success"] = 1;
                    $response['message'] = 'User successfully updated';
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
