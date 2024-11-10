<?php
session_start(); // Start the session to store user info

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // TODO replace with db connection 
    $valid_username = 'admin';
    $valid_password = 'admin';

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['username'] = $username;

        header('Location: index.php');
        exit;
    } else {
        $error_message = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
<main>
    <form action="login.php" method="post">
        <h1>Login</h1>
        
        <?php if (isset($error_message)): ?>
            <div style="color: red;"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>
        
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <hr>
        <section>
            <button type="submit">Login</button>
        </section>
    </form>
</main>
</body>
</html>
