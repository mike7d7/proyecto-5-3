<?php
session_start();  // Start the session to store user info

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']) ?? '';
    $password = htmlspecialchars($_POST['password']) ?? '';

    $db = new SQLite3('db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
    $db->enableExceptions(true);
    $statement = $db->prepare("SELECT id,password FROM usuarios WHERE username = '$username'");
    $result = $statement->execute();

    $valid_password = $result->fetchArray(SQLITE3_NUM);

    if ($valid_password) {
        if (password_verify($password, $valid_password[1])) {
            $_SESSION['user_id'] = $valid_password[0];
            header('Location: index.php');
            exit;
        } else {
            $error_message = 'Invalid username or password.';
        }
    } else {
        $error_message = 'Invalid username or password.';
    }
    $result->finalize();
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
        <hr>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <hr>
        <hr>
        <section>
            <button type="button" onclick="history.back()" style="background-color: #d20f39; border-color: #d20f39;">Cancel</button>
            <button type="submit">Login</button>
        </section>
    </form>
</main>
</body>
</html>
