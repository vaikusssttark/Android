<?php
$response = array();
$_POST['login'] = 'britva';
$_POST['email'] = 'britva@gmail.com';
$_POST['password'] = 'qwerty@asdf@';
if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    require 'db_connect.php';

    $db = new DB_CONNECT();
    if (!$db->mysql->connect_errno) {
        if ($stmt = $db->mysql->prepare("INSERT INTO users(login, email, password) VALUES (?, ?, ?)")) {
            if ($stmt->bind_param("sss", $login, $email, $password)) {
                if ($stmt->execute()) {
                    $response["success"] = 1;
                    $response["message"] = "User successfully created";
                    echo json_encode($response);
                } else {
                    $response["success"] = 0;
                    $response["message"] = "Stmt execute failed";
                    echo json_encode($response);
                }
            } else {
                $response["success"] = 0;
                $response["message"] = "Stmt binding params failed";
                echo json_encode($response);
            }
        } else {
            $response["success"] = 0;
            $response["message"] = "Stmt preparing failed";
            echo json_encode($response);
        }
    } else {
        $response["success"] = 0;
        $response["message"] = "DataBase connection failed";
        echo json_encode($response);
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
    echo json_encode($response);
}