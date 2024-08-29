<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->username) && isset($data->email) && isset($data->password)) {
    $username = $data->username;
    $email = $data->email;
    $password = password_hash($data->password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $email, $password])) {
        echo json_encode(["message" => "User created successfully"]);
    } else {
        echo json_encode(["message" => "Error creating user"]);
    }
} else {
    echo json_encode(["message" => "Invalid input"]);
}
?>
