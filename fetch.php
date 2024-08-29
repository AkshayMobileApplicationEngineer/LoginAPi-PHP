<?php
include 'db.php';

// Get the ID from the query parameter
$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id) {
    // Prepare and execute the SQL statement to fetch the user by ID
    $stmt = $pdo->prepare("SELECT id, username, email FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Return the user data as JSON
        echo json_encode($user);
    } else {
        // No user found with the given ID
        echo json_encode(["message" => "User not found"]);
    }
} else {
    // No ID provided
    echo json_encode(["message" => "No ID provided"]);
}
?>
