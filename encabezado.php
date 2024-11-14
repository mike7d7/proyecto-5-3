<div class="encabezado">
    <a href="productos.php">Productos</a>
<?php
if (isset($_SESSION['user_id'])) {
    echo '<a href="pedidos.php">Pedidos</a>';
    echo '<a href="logout.php" class="login">Logout</a>';
    echo '<a href="cart.php" class="login">Carrito</a>';
} else {
    echo '<a href="login.php" class="login">Login</a>';
}
?>
</div>

<style>
    .encabezado {
        top: 0;
        position: fixed;
        background-color: #444444;
        overflow: hidden;
        width: calc(100% - 325px);
        margin-left: 2px;
        padding-right: 105px;
        z-index: 2;
    }
    .encabezado a {
        float: left;
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }
    .encabezado a:hover {
        background-color: #555555;
    }
    .encabezado .login {
        float: right;
    }
</style>
