<?php include("sesion.php");?>
<?php 
/* PHP PHP PHP PHP  PHP PHP PHP PHP  PHP PHP  PHP PHP  PHP PHP  PHP PHP */
if(!isset($_SESSION['contador'])){$_SESSION['contador'] = 0;}
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
if(isset($_GET['op'])){
    switch($_GET['op']){
        case 1:
            $page="admin/adminUSR.php";
            break;
        case 2:
            $page="admin/adminPRO.php";
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
        <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
        <link rel="stylesheet" href="../css/tiendita.css">
    </head>
    <body><!--***************************************************-->
        <header>        
            <div class="encabezado wrap">
                <p>  Bienvenido: 
                    <span class="nombre" id="usuario"> <?php echo $_SESSION['nombre'];?>  </span>
                    <a class="link" href="cerrarsesion.php">Salir</a>
                    <a class="link oculto" id="modifica" href="usr/USRmodForm.php">modifica</a>
                    <?php
                    if($_SESSION['permisos']!=1){
                        echo '<a class="link oculto" id="elimina" href="usr/USRelimina.php">Elimina</a>';
                    }else{
                        echo '<a class="link" id="usuarios" href="?op=1">Usuarios</a>';
                        echo '<a class="link" id="productos" href="?op=2">Productos</a>';
                    }
                    ?>
                </p>
                <h1>ABARROTES</h1>
                <img src="../img/logoAAA.svg" alt="" class="icono">
            </div>
        </header>
        <div class="carro" id="carrito" name="carrito"></div> <!-- Aqui Va el carrito de compras -->
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
        <script src="../js/jquery-3.2.1.js"></script><!-- Para vista Productos-->
        <script src="../js/script.js"></script>
        <script src="../js/codigo.js"></script>
    </body><!--**************************************************-->
</html>


