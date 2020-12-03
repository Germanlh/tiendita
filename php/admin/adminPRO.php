<?php
/* PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP */
$msj="";
if(isset($_GET['mensaje'])){
    $mensaje=$_GET['mensaje'];
    }
else{$mensaje=0;}
  switch($mensaje){//evaluamos el tipo de error y enviamos el mensaje de acuerdo  al problema
    case 1: 
      $msj="Modificacion Exitosa";
      break;
    case 2: 
      $msj="No coinciden los Password Vuelva a Intentarlo";
      break;
    case 3: 
      $msj="Usuario Existente Cree uno nuevo";
      break;
    case 4: 
      $msj="Producto Agregado Exitosamente";
      break;
    case 5: 
      $msj="Password No coincide o permisos Incorrectos Vuelva a Intentarlo";
      break;
    case 6: 
      $msj="Borrado Exitoso";
      break;
    default: 
      break;
    }
echo "<h2 class='msj'>".$msj."</h2>";
/* PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP */
?>
<div class="pagina-tiendita"><!--******************************************** -->
  <table> 
      <tr>
          <th>Foto</th>
          <th>id</th>
          <th>Nombre</th>
          <th>Clase</th>
          <th>Precio Unit.</th>
          <th>Existencias</th>
          <th>Descripcion</th>
          <th></th>
          <th></th>
      </tr>
      <?php
      /* PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP */
          /************** conectamos a la BD *******************************/
          include("conectadb.php");
          /*** Consultamos el usuario y psw ********************************* */
          $sql = "SELECT * FROM producto";
          $resultado=$cnxdb->query($sql);
          $clase_array=array("","","","","","");
          while($fila=$resultado->fetch_array(MYSQLI_BOTH)) {
              for($i=0;$i<6;$i++){$clase_array[$i]="";}
              switch($fila['clase']){
                case 'botanas':
                  $clase_array[0]="selected";
                  break;
                case 'bebidas':
                  $clase_array[1]="selected";
                  break;
                case 'cervezas':
                  $clase_array[2]="selected";
                  break;
                case 'limpieza':
                  $clase_array[3]="selected";
                  break;
                case 'panes':
                  $clase_array[4]="selected";
                  break;
                case 'otros':
                  $clase_array[5]="selected";
                  break;
                default:
                  break;
              }
              echo '<tr>';
              echo'
              <form method="POST" action="admin/adminPROmodifica.php" id="modificar_frm" name="modificar_frm" enctype="multipart/form-data">
                <td><img src="../img/'.$fila['imagen'].'" class="img-prod-admin" alt=""></td>
                <td>'.$fila['id_producto'].'</td>
                <input type="hidden" name="id" id="id" value="'.$fila['id_producto'].'">
                <td><input type="text" id="nombre" name="nombre" class="caja-texto" value="'.$fila['nombre'].'"></td>
                <td>
                <select class="caja-texto" name="clase" id="clase">
                  <option value="botanas" '.$clase_array[0].'>Botanas</option>
                  <option value="bebidas" '.$clase_array[1].'>Bebidas</option>
                  <option value="cervezas" '.$clase_array[2].'>Cervezas</option>
                  <option value="limpieza" '.$clase_array[3].'>Limpieza</option>
                  <option value="panes" '.$clase_array[4].'>Panes y Galletas</option>
                  <option value="otros" '.$clase_array[5].'>Otros</option>
                </select>
                </td>
                <td><input type="text" id="punit" name="punit" class="caja-texto" value="'.$fila['precio_unitario'].'"></td>
                <td><input type="text" id="existencias" name="existencias" class="caja-texto" value="'.$fila['existencias'].'"></td>   
                <td><input type="text" id="descripcion" name="descripcion" class="caja-texto" value="'.$fila['descripcion'].'"></td>
                <td><input type="submit" id="enviar" name="enviar" value="Modificar"></td>
                <td><input type="file" id="foto" name="foto" value="Imagen"></td>
              </form>
                <td><a href="admin/adminPROelimina.php?id='.$fila['id_producto'].'"><button>Borrar</button></a></td>
              ';
              echo '</tr>';  
          }
          /** Liberamos resultado y cerramos BD *************************  */
          $resultado->free();
          $cnxdb->close();//cerramos la base de datos
          
      /* PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP */
      ?>
  </table>
  <br><hr><br>
<form method="POST" action="admin/adminPROagrega.php" id="agregar_frm" name="agregar_frm" enctype="multipart/form-data">
    <input type="file" id="foto" name="foto" value="Imagen"></td>
    <br><input type="text" id="nombre" name="nombre" class="caja-texto" placeholder="Nombre">
    <select class="caja-texto" name="clase" id="clase">
      <option value="botanas" selected>Botanas</option>
      <option value="bebidas">Bebidas</option>
      <option value="cervezas">Cervezas</option>
      <option value="limpieza">Limpieza</option>
      <option value="panes">Panes y Galletas</option>
      <option value="otros">Otros</option>
    </select>
    <input type="text" id="punit" name="punit" class="caja-texto" placeholder="precio unit">
    <input type="text" id="existencias" name="existencias" class="caja-texto" placeholder="Existencias">
    <textarea name="descripcion" id="descripcion" rows="4" cols="50" placeholder="Descripcion"></textarea>
    <input type="submit" id="enviar" name="enviar" value="Agregar">
</form>
</div><!--************************************************************** -->