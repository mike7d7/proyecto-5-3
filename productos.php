<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['idproducto'];
    $quantity = $_POST['quantity'];
    array_push($_SESSION['cart'], [$productId, $quantity]);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Productos</title>
    <link rel="stylesheet" href="style.css" />
    <script>
      function openPopup(productId) {
        var popup = document.getElementById('popup');
        var overlay = document.getElementById('overlay');
        var input = document.getElementById('quantity');

        overlay.style.display = 'block';
        popup.style.display = 'block';

        input.value = '';
        document.getElementById("idproducto").value = productId

        document.getElementById('submitBtn').onclick = function() {
          var quantity = input.value;
          if (quantity > 0) {
            overlay.style.display = 'none';
            popup.style.display = 'none';
          } else {
            alert('Please enter a valid quantity.');
          }
        };
      }

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
        echo "<table border='1'>";
        echo '<tr><th>Descripción</th><th>Precio por litro (MXN)</th></tr>';

        while ($row = $result->fetchArray(SQLITE3_NUM)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row[1]) . '</td>';
            echo '<td>' . htmlspecialchars($row[2]) . '</td>';
            if (isset($_SESSION['user_id'])) {
                echo '<td style="width: 200px">';
                echo "<button onclick='openPopup(" . $row[0] . ")'>Agregar al carrito</button>";
                echo '</td>';
            }
            echo '</tr>';
        }

        echo '</table>';

        $result->finalize();
    ?>

    <!-- Popup (modal) for quantity input -->
    <div id="overlay" onclick="closePopup()"></div>
    <div id="popup">
      <h3>Ingrese la cantidad</h3>
      <label for="quantity">Cantidad:</label>
      <form action="productos.php" method="POST">
      <input type='hidden' name='idproducto' id='idproducto' value='" . $row['name'] . "'>
      <input type="number" name="quantity" id="quantity" min="1" step="0.01" required />
      <input type="submit" name="submitBtn" id="submitBtn" value="Submit"/>
      <button onclick="closePopup()">Cancelar</button>
      </form>
    </div>

    <hr>
    <hr>
    <hr>
    <hr>
    <?php require_once ('pie.php'); ?>
  </body>
</html>
