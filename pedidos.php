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

$statement = $db->prepare('SELECT p.id,descripcion,s.nombre,cantidad,precio * cantidad AS subtotal FROM pedidos p,incluye i,productos pr,sucursales s WHERE usuario = ' . $_SESSION['user_id'] . ' AND p.id = i.pedido AND pr.id = i.producto AND p.sucursal = s.id');
$result = $statement->execute();
$title = 'ciasEnvio';

echo '<h2>Listado de pedidos</h2>';
echo "<table border='1'>\n";
echo "<tr><th>Pedido</th><th>Producto</th><th>Sucursal</th><th>Cantidad</th><th>Subtotal</th></tr>\n";

$pedido_previo = 0;
$total = 0;
while ($row = $result->fetchArray(SQLITE3_NUM)) {
    echo "<tr>\n";
    echo '<td>' . htmlspecialchars($row[0]) . "</td>\n";
    echo '<td>' . htmlspecialchars($row[1]) . "</td>\n";
    echo '<td>' . htmlspecialchars($row[2]) . "</td>\n";
    echo '<td>' . htmlspecialchars($row[3]) . "</td>\n";
    echo '<td>$' . htmlspecialchars($row[4]) . "</td>\n";
    echo "</tr>\n";
    $total += htmlspecialchars($row[4]);
    /*if (htmlspecialchars($row[0]) === $pedido_previo) {*/
    /*    echo "<tr>\n";*/
    /*    echo '<td style="">' . '</td>';*/
    /*    echo '<td style="">' . '</td>';*/
    /*    echo '<td style="">' . '</td>';*/
    /*    echo '<td style="">' . '</td>';*/
    /*    echo '<td>' . $total . "</td>\n";*/
    /*    echo "</tr>\n";*/
    /*    $total = 0;*/
    /*    echo "<tr><td></td></tr>";*/
    /*}*/
    /*$pedido_previo = htmlspecialchars($row[0]);*/
}

echo "</table>\n";

$result->finalize();
?>
<hr>
<hr>
<hr>
<hr>
<?php require_once ('pie.php'); ?>
  </body>
</html>

