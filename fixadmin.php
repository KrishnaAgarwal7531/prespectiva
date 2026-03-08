<?php
include "config/db.php";

// Generate hash
$password = "admin123";
$hash = password_hash($password, PASSWORD_DEFAULT);

// Update admin password directly
$stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = 'admin'");
$stmt->bind_param("s", $hash);
$stmt->execute();

echo "Done! Password updated to: admin123<br>";
echo "Hash used: " . $hash . "<br>";

// Verify it works
$stmt2 = $conn->prepare("SELECT password FROM users WHERE username = 'admin'");
$stmt2->execute();
$result = $stmt2->get_result();
$user = $result->fetch_assoc();

if (password_verify($password, $user['password'])) {
    echo "<br><strong style='color:green'>Password verified successfully! You can now login.</strong>";
} else {
    echo "<br><strong style='color:red'>Something is still wrong.</strong>";
}
?>

