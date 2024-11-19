<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: productos.php');
    die();
}
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = $_POST['idproducto'];
    $quantity = $_POST['quantity'];
    $_SESSION['cart'][$index][1] = $quantity;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Carrito</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="gasoline-svgrepo-com.svg" />
  </head>
  <body>
    <hr>
    <hr>
    <hr>
    <?php require_once ('encabezado.php'); ?>

    <?php
        $db = new SQLite3('db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        $db->enableExceptions(true);

        echo '<h2>Carrito de compras</h2>';
        echo "<table border='1'>\n";
        echo "<tr><th>Producto</th><th>Cantidad (L)</th><th>Subtotal</th></tr>\n";

        $total = 0;
        $index = 0;
        foreach ($_SESSION['cart'] as $row) {
            $statement = $db->prepare("SELECT descripcion FROM productos WHERE id = $row[0]");
            $result = $statement->execute();
            $variable = $result->fetchArray(SQLITE3_NUM);
            $statement2 = $db->prepare("SELECT precio FROM productos WHERE id = $row[0]");
            $result2 = $statement2->execute();
            $variable2 = $result2->fetchArray(SQLITE3_NUM);
            echo "<tr>\n";
            echo '<td>' . htmlspecialchars($variable[0]) . "</td>\n";
            echo '<td><form action="cart.php" method="POST">' . '<input type="hidden" name="idproducto" id="idproducto" value="' . $index . '">' . '<input type="number" name="quantity" id="quantity" min="1" step="0.01" value="' . htmlspecialchars($row[1]) . '" required /><input type="submit" hidden />' . "</form></td>\n";
            echo '<td>$' . htmlspecialchars($variable2[0] * $row[1]) . "</td>\n";
            echo "<td><button style='background-color: #d20f39; border-color: #d20f39;' onclick=\"window.location.href='eliminar_carrito.php?index=$index';\">Eliminar</button></td>";
            echo "</tr>\n";
            $total += $variable2[0] * $row[1];
            $result->finalize();
            $index++;
        }
        echo '</table>';
        echo '<hr>';
        echo '<table>';
        echo "<tr><th>Subtotal</th></tr>\n";
        echo "<tr>\n";
        echo '<td>$' . $total . "</td>\n";
        echo "</tr>\n";
        echo '</table>';

        $iva = $total * 0.16;
        echo '<hr>';
        echo '<table>';
        echo "<tr><th>IVA</th></tr>\n";
        echo "<tr>\n";
        echo '<td>$' . $iva . "</td>\n";
        echo "</tr>\n";
        echo '</table>';

        $total *= 1.16;
        echo '<hr>';
        echo '<table>';
        echo "<tr><th>Total</th></tr>\n";
        echo "<tr>\n";
        echo '<td>$' . $total . "</td>\n";
        echo "</tr>\n";
        echo '</table>';

        if ($_SESSION['cart']) {
            echo '<form action="comprar.php' . '" method="POST">';
            echo '<hr>';
            echo '<h2>Sucursal</h2>';
            $statement3 = $db->prepare('SELECT nombre, direccion FROM sucursales');
            $result3 = $statement3->execute();
            $verify_array = [];
            while ($variable3 = $result3->fetchArray(SQLITE3_NUM)) {
                $verify_array[] = $variable3[0] . ' - ' . $variable3[1];
            }
            echo '<select name="' . 'Sucursal' . '" id="cars"required>';
            foreach ($verify_array as $key => $value) {
                echo "<option value='$key'>$value</option>";
            }
            echo '</select>';
            echo "<input type='hidden' name='total' value='" . $total . "'>";
            echo '<hr>';
            echo '<button type="submit" style="background-color: #40a02b; border-color: #40a02b;">Comprar</button>';
            echo '</form>';
        }

    ?>
    <hr>
    <hr>
    <hr>
    <?php require_once ('pie.php'); ?>
  </body>
</html>
