<?php
include "config/db.php";

$username = "admin";

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    echo "User found!<br>";
    echo "Username: " . $user['username'] . "<br>";
    echo "Role: " . $user['role'] . "<br>";
    echo "Password hash: " . $user['password'] . "<br>";
    
    // Test password
    if (password_verify("password", $user['password'])) {
        echo "Password is CORRECT!";
    } else {
        echo "Password is WRONG!";
    }
} else {
    echo "User NOT found in database!";
}
?>
```

Open:
```
http://localhost/prepectiva/test.php