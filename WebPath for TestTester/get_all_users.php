<?php
$response['users'] = array();

require 'db_connect.php';

$db = new DB_CONNECT();

if (!$db->mysql->connect_errno) {
    if ($stmt = $db->mysql->prepare("SELECT * FROM users")) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($raw = $result->fetch_assoc()) {
                array_push($response['users'], $raw);
            }
            $response["success"] = 1;
            echo json_encode($response);
        } else {
            $response["success"] = 0;
            $response['message'] = 'No user found';
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
