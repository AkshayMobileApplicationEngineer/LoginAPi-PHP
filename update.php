<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->id) && isset($data->username) && isset($data->email)) {
    $id = $data->id;
    $username = $data->username;
    $email = $data->email;

    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    if ($stmt->execute([$username, $email, $id])) {
        echo json_encode(["message" => "User updated successfully"]);
    } else {
        echo json_encode(["message" => "Error updating user"]);
    }
} else {
    echo json_encode(["message" => "Invalid input"]);
}
?>
