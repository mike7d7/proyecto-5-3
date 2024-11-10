<div class="pie">
    <p>&copy; <?php echo date("Y"); ?> Texto de pie de página. Todos los derechos reservados.</p>
</div>

<style>
    .pie {
        background-color: #444444;
        color: white;
        text-align: center;
        padding: 10px 0;
        bottom: 0;
        position:fixed;
        width: calc(100% - 430px);
        margin-left: 2px;
        padding-left: 105px;
        padding-right: 105px;
    }
    .pie a {
        color: white;
        text-decoration: none;
        padding: 0 15px;
    }
    .pie a:hover {
        text-decoration: underline;
    }
    .pie-links {
        margin-top: 10px;
    }
</style>
