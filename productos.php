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
    <script>
      // Function to open the popup when the button is clicked
      function openPopup(productId) {
        // Create a popup (using a simple modal)
        var popup = document.getElementById('popup');
        var overlay = document.getElementById('overlay');
        var input = document.getElementById('quantity');
        
        // Show the popup and overlay
        overlay.style.display = 'block';
        popup.style.display = 'block';

        // Reset the input field
        input.value = '';

        // When the submit button is clicked
        document.getElementById('submitBtn').onclick = function() {
          var quantity = input.value;
          if (quantity > 0) {
            // Handle the quantity submission (e.g., add to cart)
            alert('Added ' + quantity + ' units of product ' + productId + ' to the cart.');
            // Close the popup
            overlay.style.display = 'none';
            popup.style.display = 'none';
          } else {
            alert('Please enter a valid quantity.');
          }
        };
      }

      // Close the popup if the overlay is clicked
      function closePopup() {
        var overlay = document.getElementById('overlay');
        var popup = document.getElementById('popup');
        overlay.style.display = 'none';
        popup.style.display = 'none';
      }
    </script>
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
        echo '<td style="width: 200px">';
        echo "<button onclick='openPopup(" . $row[0] . ")'>Agregar al carrito</button>";
        echo '</td>';
        echo "</tr>\n";
    }

    echo "</table>\n";

    $result->finalize();
    ?>

    <!-- Popup (modal) for quantity input -->
    <div id="overlay" onclick="closePopup()"></div>
    <div id="popup">
      <h3>Ingrese la cantidad</h3>
      <label for="quantity">Cantidad:</label>
      <input type="number" id="quantity" min="1" step="0.01" required />
      <button id="submitBtn">Agregar</button>
      <button onclick="closePopup()">Cancelar</button>
    </div>

    <hr>
    <hr>
    <hr>
    <hr>
    <?php require_once ('pie.php'); ?>
  </body>
</html>
