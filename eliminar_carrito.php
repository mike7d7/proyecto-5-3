<?php
session_start();
if (isset($_GET['index'])) {
    $index = htmlspecialchars($_GET['index']);
    array_splice($_SESSION['cart'], $index, 1);
    header('Location: cart.php');
    die();
} else {
    echo 'not working';
}
?>
