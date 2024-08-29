<?php
include 'db.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id) {
    $stmt = $pdo->prepare("SELECT id, username, email FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode($user);
    } else {
        echo json_encode(["message" => "User not found"]);
    }
} else {
    $stmt = $pdo->query("SELECT id, username, email FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($users);
}
?>
