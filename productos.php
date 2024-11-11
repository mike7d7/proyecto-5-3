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

$statement = $db->prepare('SELECT * FROM "productos"');
$result = $statement->execute();
$title = 'ciasEnvio';

echo '<h2>Listado de productos</h2>';
echo "<table border='1'>\n";
echo "<tr><th>Descripción</th><th>Precio por litro (MXN)</th></tr>\n";

while ($row = $result->fetchArray(SQLITE3_NUM)) {
    echo "<tr>\n";
    echo '<td>' . htmlspecialchars($row[1]) . "</td>\n";
    echo '<td>' . htmlspecialchars($row[2]) . "</td>\n";
    /* echo '<td style="width: 200px">'; */
    /* echo "<button onclick=\"window.location.href='edit.php?table=ciasEnvio&id=$row[0]';\" >Editar</button>"; */
    /* echo '</td>'; */
    echo "</tr>\n";
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

