<?php include("sesion.php");?>
<?php 
/* PHP PHP PHP PHP  PHP PHP PHP PHP  PHP PHP  PHP PHP  PHP PHP  PHP PHP */
if($_SESSION['activo']){
    switch($_SESSION['permisos']){
        case 1:
            $page="admin/admin.php";
            break;
        case 2:
            $page="productos/productos.php";
            break;
        default:
            break;
    }
}
/* PHP PHP PHP PHP  PHP PHP PHP PHP  PHP PHP  PHP PHP  PHP PHP  PHP PHP */
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tiendita AAA</title>
        <link rel="stylesheet" href="../css/tiendita.css">
        <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    </head>
    <body><!--***************************************************-->
        <header>
            <p>  Bienvenido: 
                <span class="nombre" id="usuario"> <?php echo $_SESSION['nombre'];?>  </span>
                <a class="link" href="cerrarsesion.php">Salir</a>
                <a class="link oculto" id="modifica" href="usr/USRmodForm.php">modifica</a>
                <?php
                if($_SESSION['permisos']!=1){
                    echo '<a class="link oculto" id="elimina" href="usr/USRelimina.php">Elimina</a>';
                }
                ?>
            </p>
        </header>
        <main>
            <?php include $page;?>
        </main>
        <footer></footer>
        <!-------------------------------------------------------->
        <script>
            const usuario = document.getElementById("usuario");
            usuario.addEventListener("click", ()=>{
                document.getElementById("modifica").classList.toggle("oculto");
                document.getElementById("elimina").classList.toggle("oculto");
            });
        </script><!-------------------------------------------------------->
    </body><!--**************************************************-->
</html>


