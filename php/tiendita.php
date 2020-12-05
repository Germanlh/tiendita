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
        case 3:
            $page="admin/adminPED.php";
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
        <title>Abarrotes AAA</title>
        <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
        <link rel="stylesheet" href="../css/tiendita.css">
        <script src="https://kit.fontawesome.com/a2e8d0339c.js"></script>
    </head>
    <body><!--***************************************************-->
        <header>        
            <div class="encabezado wrap">
                <nav>
                    <i class="menu fas fa-bars" id="menu"></i> <!-- Logo Hamburguesa Fontawesome-->
                    <span class="nombre" id="usuario"> <?php echo $_SESSION['nombre'];?>  </span>
                    <a class="link oculto" id="cierra" href="cerrarsesion.php">Salir</a>
                    <a class="link oculto" id="modifica" href="usr/USRmodForm.php">modifica</a>
                    <?php
                    if($_SESSION['permisos']!=1){
                        echo '<a class="link oculto" id="elimina" href="usr/USRelimina.php">Elimina</a>';
                    }else{
                        echo '<a class="link oculto" id="usr" href="?op=1">Usuarios</a>';
                        echo '<a class="link oculto" id="prod" href="?op=2">Productos</a>';
                        echo '<a class="link oculto" id="ped" href="?op=3">Pedidos</a>';
                    }
                    ?>
                </nav>
                <div>
                    <h1 class="titulo">ABARROTES</h1>
                    <img src="../img/logoAAA.svg" alt="" class="icono">
                </div>
                
                    <?php
                    if($_SESSION['permisos']!=1){
                        echo'<div>
                            <i class="menu fas fa-cart-plus" id="logocarrito"></i>
                        </div>';
                    }
                    ?>
                
            </div>
        </header>
        <div class="carro oculto" id="carrito" name="carrito"></div> <!-- Aqui Va el carrito de compras -->
        <main>
            <?php include $page;?>
        </main>
        <footer></footer>
        <!-------------------------------------------------------->
        <script>
            const usuario = document.getElementById("menu");
            usuario.addEventListener("click", cambia);
            function cambia(){
                document.getElementById("modifica").classList.toggle("oculto");
                document.getElementById("cierra").classList.toggle("oculto");
                if(document.getElementById("elimina")){
                    document.getElementById("elimina").classList.toggle("oculto");
                }
                if(document.getElementById("usr")){
                    document.getElementById("usr").classList.toggle("oculto");
                }
                if(document.getElementById("prod")){
                    document.getElementById("prod").classList.toggle("oculto");
                }
                if(document.getElementById("ped")){
                    document.getElementById("ped").classList.toggle("oculto");
                }                
            }

            if(document.getElementById("logocarrito")){
                const carro = document.getElementById("logocarrito");
                carro.addEventListener("click", aparece);
            }
            function aparece(){
                document.getElementById("carrito").classList.toggle("oculto");            
            }

            if(document.getElementById("mensajito")){
                setTimeout(() => {
                    document.getElementById("mensajito").classList.toggle("oculto");
                }, 5000);
            }
        </script><!-------------------------------------------------------->
        <script src="../js/jquery-3.2.1.js"></script><!-- Para vista Productos-->
        <script src="../js/script.js"></script>
        <script src="../js/codigo.js"></script>
    </body><!--**************************************************-->
</html>


