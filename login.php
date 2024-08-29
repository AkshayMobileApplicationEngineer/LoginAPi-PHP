<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->username) && isset($data->password)) {
    $username = $data->username;
    $password = $data->password;

    // Prepare a statement to fetch the user by username
    $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Authentication successful
        // Generate a simple token or session ID (for demonstration purposes)
        $token = bin2hex(random_bytes(16)); // Generate a random token

        // Store the token in the database or a session for actual implementation

        echo json_encode([
            "message" => "Login successful",
            "user" => [
                "id" => $user['id'],
                "username" => $user['username']
            ],
            "token" => $token // Return the token
        ]);
    } else {
        // Authentication failed
        echo json_encode(["message" => "Invalid username or password"]);
    }
} else {
    echo json_encode(["message" => "Invalid input"]);
}
?>
