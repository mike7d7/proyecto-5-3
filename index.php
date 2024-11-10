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
/*// This file walks you through the most common features of PHP's SQLite3 API.*/
/*// The code is runnable in its entirety and results in an `analytics.sqlite` file.*/
/**/
/*// Create a new database, if the file doesn't exist and open it for reading/writing.*/
/*// The extension of the file is arbitrary.*/
/*$db = new SQLite3('2-act1-2.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);*/
/**/
/*// Errors are emitted as warnings by default, enable proper error handling.*/
/*$db->enableExceptions(true);*/
/**/
/*// Prepare and execute the query to select all rows from the "clientes" table.*/
/*$statement = $db->prepare('SELECT * FROM "ciasEnvio"');*/
/*$result = $statement->execute();*/
/*$title = 'ciasEnvio';*/
/**/
/*echo '<h2>Listado de compañías de envío</h2>';*/
/*echo "<table border='1'>\n";*/
/*echo "<tr><th>id</th><th>Nombre</th></tr>\n";*/
/**/
/*$statement2 = $db->prepare("PRAGMA table_info($title)");*/
/*$result2 = $statement2->execute();*/
/**/
/*$first = false;*/
/*while ($row2 = $result2->fetchArray(SQLITE3_ASSOC)) {*/
/*    if (!$first && $title != 'incluye') {*/
/*        $first = true;*/
/*        $idname = $row2['name'];*/
/*        continue;*/
/*    }*/
/*}*/
/**/
/*$statement3 = $db->prepare('SELECT DISTINCT ciasEnvio FROM pedidos');*/
/*$execute3 = $statement3->execute();*/
/*$result3 = [];*/
/**/
/*while ($row = $execute3->fetchArray(SQLITE3_NUM)) {*/
/*    $result3[] = $row[0];*/
/*}*/
/*/*print_r($result3);*/
/**/
/*while ($row = $result->fetchArray(SQLITE3_NUM)) {*/
/*    echo "<tr>\n";*/
/*    echo '<td>' . htmlspecialchars($row[0]) . "</td>\n";*/
/*    echo '<td>' . htmlspecialchars($row[1]) . "</td>\n";*/
/*    echo '<td style="width: 200px">';*/
/*    echo "<button onclick=\"window.location.href='edit.php?table=ciasEnvio&id=$row[0]';\" >Editar</button>";*/
/*    if (!in_array($row[0], $result3, false)) {*/
/*        echo "<button onclick=\"window.location.href='eliminar.php?table=ciasEnvio&id=$row[0]&idname=$idname';\" >Eliminar</button>";*/
/*    }*/
/*    echo '</td>';*/
/*    echo "</tr>\n";*/
/*}*/
/**/
/*echo "</table>\n";*/
/**/
/*// Free the memory, this is NOT done automatically, while your script is running*/
/*$result->finalize();*/
/**/
/*// Finally, close the database.*/
/*// This is done automatically when the script finishes, though.*/
/*$db->close();*/
?>
<hr>
<hr>
<hr>
<hr>
<?php require_once ('pie.php'); ?>
  </body>
</html>

