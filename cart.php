<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Actividad 4</title>
    <link rel="stylesheet" href="style.css" />
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
            echo '<td>' . htmlspecialchars($row[1]) . "</td>\n";
            echo '<td>$' . htmlspecialchars($variable2[0] * $row[1]) . "</td>\n";
            echo "<td><button onclick=\"window.location.href='eliminar_carrito.php?index=$index';\">Eliminar</button></td>";
            echo "</tr>\n";
            $total += $variable2[0] * $row[1];
            $result->finalize();
            $index++;
        }
        echo '</table>';
        echo '<hr>';
        echo '<table>';
        echo "<tr><th>Total</th></tr>\n";
        echo "<tr>\n";
        echo '<td>$' . $total . "</td>\n";
        echo "</tr>\n";
        echo '</table>';

        if ($_SESSION['cart']) {
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
                echo "<option value='$key + 1'>$value</option>";
            }
            echo '</select>';
        }

    ?>
    <hr>
    <hr>
    <hr>
    <?php require_once ('pie.php'); ?>
  </body>
</html>
