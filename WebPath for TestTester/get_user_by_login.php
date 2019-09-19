<?php
$response = array();
if (isset($_GET['user_login'])) {
    $user_login = $_GET['user_login'];
    require 'db_connect.php';
    $db = new DB_CONNECT();
    if (!$db->mysql->connect_errno) {
        if ($stmt = $db->mysql->prepare("SELECT * FROM users WHERE login = ?")) {
            if ($stmt->bind_param("s", $user_login)) {
                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    $response = $result->fetch_assoc();
                    $response["success"] = 1;
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
