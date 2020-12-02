<?php
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
      $msj="Usuario Agregado Exitosamente";
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
?>
<div class="pagina-tiendita"><!--******************************************** -->
  <table> 
      <tr>
          <th>Mail</th>
          <th>Nombre</th>
          <th>Nuevo Psw</th>
          <th>Confirmar</th>
          <th>Permisos</th>
          <th></th>
          <th></th>
      </tr>
      <?php
      /* PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP */
          /************** conectamos a la BD *******************************/
          include("conectadb.php");
          /*** Consultamos el usuario y psw ********************************* */
          $sql = "SELECT * FROM usuarios";
          $resultado=$cnxdb->query($sql);
          while($fila=$resultado->fetch_array(MYSQLI_BOTH)) {
              echo '<tr>';
              echo'
              <form method="POST" action="admin/adminUSRmodifica.php" id="registrar_frm" name="registrar_frm" enctype="application/x-www-form-urlencoded">
              <td> <input type="email" name="usr" id="usr" class="caja-texto" value="'.$fila['mail'].'"></td>
              <td><input type="text" id="nombre" name="nombre" class="caja-texto" value="'.$fila['nombre'].'"></td>
              <td><input type="password" name="psw" id="psw" class="caja-texto" placeholder="Password" required></td>
              <td><input type="password" name="conpsw" id="conpsw" class="caja-texto" placeholder="Confirma Contraseña" required /></td>
              <td><input type="text" id="permisos" name="permisos" class="caja-texto" value="'.$fila['permisos'].'"></td>
              <td><input type="submit" id="enviar" name="enviar" value="Modificar"></td>
              </form>
              ';
              if($_SESSION['usr']!=$fila['mail']){
                  echo '<td><a href="admin/adminUSRelimina.php?mail='.$fila['mail'].'"><button>Borrar</button></a></td>';
              }
              echo '</tr>';
          }

          /** Liberamos resultado y cerramos BD *************************  */
          $resultado->free();
          $cnxdb->close();//cerramos la base de datos
          
      /* PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP */
      ?>
      <tr>
        <form method="POST" action="admin/adminUSRagrega.php" id="agrega_frm" name="agrega_frm" enctype="application/x-www-form-urlencoded">
          <td> <input type="email" name="usr" id="usr" class="caja-texto" placeholder="mail" required ></td>
          <td><input type="text" id="nombre" name="nombre" class="caja-texto" placeholder="Nombre" required></td>
          <td><input type="password" name="psw" id="psw" class="caja-texto" placeholder="Password" required></td>
          <td><input type="password" name="conpsw" id="conpsw" class="caja-texto" placeholder="Confirma Contraseña" required /></td>
          <td><input type="text" id="permisos" name="permisos" class="caja-texto" placeholder="Permisos" required></td>
          <td><input type="submit" id="enviar" name="enviar" value="Agregar"></td>
          </form>
        </tr>
  </table>
</div><!--************************************************************** -->

