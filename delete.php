<?php
include 'db.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    if ($stmt->execute([$id])) {
        echo json_encode(["message" => "User deleted successfully"]);
    } else {
        echo json_encode(["message" => "Error deleting user"]);
    }
} else {
    echo json_encode(["message" => "Invalid input"]);
}
?>
