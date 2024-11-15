<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sucursal = htmlspecialchars($_POST['Sucursal']) + 1;
    $user = $_SESSION['user_id'];
    $db = new SQLite3('db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
    $get_last_index = $db->prepare('SELECT id FROM pedidos ORDER BY id DESC LIMIT 1')->execute()->fetchArray(SQLITE3_NUM);
    $get_last_index_result = $get_last_index[0] + 1;
    $statement = $db->prepare("INSERT INTO pedidos VALUES('$get_last_index_result', '$user', '$sucursal')");
    $result = $statement->execute();

    foreach ($_SESSION['cart'] as $row) {
        $producto = $row[0];
        $cantidad = $row[1];
        $statement2 = $db->prepare("INSERT INTO incluye VALUES('$get_last_index_result', '$producto', '$cantidad')")->execute();
    }
    $_SESSION['cart'] = [];
    header('Location: cart.php');
    die();
}
?>
