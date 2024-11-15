<?php
session_start();
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

$statement = $db->prepare('SELECT p.id,descripcion,s.nombre,s.direccion,cantidad,precio * cantidad AS subtotal, (precio * cantidad) * 1.16 AS total FROM pedidos p,incluye i,productos pr,sucursales s WHERE usuario = ' . $_SESSION['user_id'] . ' AND p.id = i.pedido AND pr.id = i.producto AND p.sucursal = s.id');
$result = $statement->execute();
$title = 'ciasEnvio';

echo '<h2>Listado de pedidos</h2>';
echo "<table border='1'>";
echo '<tr><th>Pedido</th><th>Producto</th><th>Sucursal</th><th>Dirección</th><th>Cantidad</th><th>Subtotal</th><th>Total</th></tr>';

$pedido_previo = 1;
$total = 0;
while ($row = $result->fetchArray(SQLITE3_NUM)) {
    if (htmlspecialchars($row[0]) != $pedido_previo) {
        echo '<tr>';
        echo '<td style="background-color: #000000; !important"></td>';
        echo '<td style="background-color: #000000; !important"></td>';
        echo '<td style="background-color: #000000; !important"></td>';
        echo '<td style="background-color: #000000; !important"></td>';
        echo '<td style="background-color: #000000; !important"></td>';
        echo '<td style="background-color: #000000; !important"></td>';
        echo '<td>$' . $total . '</td>';
        echo '</tr>';
        $total = 0;
    }
    echo '<tr>';
    echo '<td>' . htmlspecialchars($row[0]) . '</td>';
    echo '<td>' . htmlspecialchars($row[1]) . '</td>';
    echo '<td>' . htmlspecialchars($row[2]) . '</td>';
    echo '<td>' . htmlspecialchars($row[3]) . '</td>';
    echo '<td>' . htmlspecialchars($row[4]) . '</td>';
    echo '<td>$' . htmlspecialchars($row[5]) . '</td>';
    echo '<td>$' . htmlspecialchars($row[6]) . '</td>';
    echo '</tr>';
    $total += htmlspecialchars($row[6]);
    $pedido_previo = htmlspecialchars($row[0]);
}
echo '<tr>';
echo '<td style="background-color: #000000; !important"></td>';
echo '<td style="background-color: #000000; !important"></td>';
echo '<td style="background-color: #000000; !important"></td>';
echo '<td style="background-color: #000000; !important"></td>';
echo '<td style="background-color: #000000; !important"></td>';
echo '<td style="background-color: #000000; !important"></td>';
echo '<td>$' . $total . '</td>';
echo '</tr>';

echo '</table>';

$result->finalize();
?>
<hr>
<hr>
<hr>
<hr>
<?php require_once ('pie.php'); ?>
  </body>
</html>
