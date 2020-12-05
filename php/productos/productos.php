<?php
        /* PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP */
$msj="";
if(isset($_GET['mensaje'])){
    $mensaje=$_GET['mensaje'];
    switch($mensaje){//evaluamos el tipo de error y enviamos el mensaje de acuerdo  al problema
      case 1: 
        $msj="Su compra se ha registrado Correctamente";
        break;
      case 2: 
        $msj="Compra Cancelado";
        break;
      default: 
        break;
      }
  echo "<h2 class='msj' id='mensajito'>".$msj."</h2>";
    }
?>


<nav class="category_list wrap">
    <a href="#" class="category_item" category="botanas">botanas</a>
    <a href="#" class="category_item" category="bebidas">bebidas</a>
    <a href="#" class="category_item" category="cervezas">Cervezas</a>
    <a href="#" class="category_item" category="limpieza">limpieza</a>
    <a href="#" class="category_item" category="panes">panes y galletas</a>
    <a href="#" class="category_item" category="otros">otros</a>
</nav>

<div class="wrap"><!--******************************************************* -->
    <section class="products-list">
        <?php
        /* PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP */
            /************** conectamos a la BD *******************************/
            include("conectadb.php");
            /*** Consultamos el usuario y psw ********************************* */
            $sql = "SELECT * FROM producto WHERE existencias > 0";
            $resultado=$cnxdb->query($sql);
            while($fila=$resultado->fetch_array(MYSQLI_BOTH)) {
                
                echo '<div class="product-item" category="'.$fila['clase'].'">';
                echo'
                    <div class="item" >
                        <img src="../img/'.$fila['imagen'].'" alt="">
                        <a href="#">'.$fila['nombre'].'</a>
                    </div>
                    <div class="item_precio">
                        <h2>$ '.number_format($fila['precio_unitario'], 2, '.', ',').'</h2>
                        <input type="number" class="cantidad" value="1" max="10" min="1" id="num'.$fila['id_producto'].'">
                        <button  value="'.$fila['id_producto'].'" class="botoncompra">Comprar</button>
                    </div>
                    ';
                echo '</div>';  
                    }
                    // <a href="productos/poncarrito.php?p='.$fila['id_producto'].'" class="botoncompra"><button>Comprar</button></a>
                    /** Liberamos resultado y cerramos BD *************************  */
            $resultado->free();
            $cnxdb->close();//cerramos la base de datos
        /* PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP */
        ?>
    </section>
</div> <!--******************************************************* -->