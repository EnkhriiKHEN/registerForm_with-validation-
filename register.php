<?php

// 1. Get all inputs and trim spaces
$username = trim($_POST["username"]);
$email = trim($_POST["email"]);
$password = trim($_POST["password"]);
$confirm = trim($_POST["confirm_password"]);

$errors = [];

// 2. Validate username
if (empty($username)) {
    $errors[] = "Username is required";
} else {
    $username = htmlspecialchars($username);
}

// 3. Validate email
if (empty($email)) {
    $errors[] = "Email is required";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
}

// 4. Validate password rules
if (empty($password)) {
    $errors[] = "Password is required";
} else {

    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters";
    }

    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password must contain at least 1 uppercase letter";
    }

    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = "Password must contain at least 1 lowercase letter";
    }

    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must contain at least 1 number";
    }

    if (!preg_match('/[\W]/', $password)) {
        $errors[] = "Password must contain at least 1 special character (!@#$%^&*)";
    }
}

// 5. Confirm password
if ($password !== $confirm) {
    $errors[] = "Passwords do not match";
}

// 6. Show errors OR success
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
    exit;
}

echo "<h3>Registration Successful!</h3>";
echo "Username: $username <br>";
echo "Email: $email <br>";

?>