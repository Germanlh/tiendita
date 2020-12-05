<?php
$msj="";
if(isset($_GET['mensaje'])){
    $mensaje=$_GET['mensaje'];
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
  echo "<h2 class='msj' id='mensajito'>".$msj."</h2>";
  }/*If Mensaje*/

?>
<div class="pagina-tiendita"><!--******************************************** -->
  <table class="tabusr"> 
      <caption>
        ADMINISTRACION DE USUARIOS
      </caption>
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
          $sql = "SELECT * FROM usuarios ORDER BY permisos ASC";
          $resultado=$cnxdb->query($sql);
          $clase_array=array("","");
          while($fila=$resultado->fetch_array(MYSQLI_BOTH)) {
            for($i=0;$i<2;$i++){$clase_array[$i]="";}
            switch($fila['permisos']){
              case 1: $clase_array[0]="selected"; break;
              case 2: $clase_array[1]="selected"; break;
              default: break;
            }

              echo '<tr>';
              echo'
              <form method="POST" action="admin/adminUSRmodifica.php" id="registrar_frm" name="registrar_frm" enctype="application/x-www-form-urlencoded">
              <td> <input type="email" name="usr" id="usr" class="caja-texto" value="'.$fila['mail'].'"></td>
              <td><input type="text" id="nombre" name="nombre" class="caja-texto" value="'.$fila['nombre'].'"></td>
              <td><input type="password" name="psw" id="psw" class="caja-texto" placeholder="Password" required></td>
              <td><input type="password" name="conpsw" id="conpsw" class="caja-texto" placeholder="Confirma Contraseña" required /></td>
              <td>
                <select class="caja-texto" name="permisos" id="permisos">
                  <option value="1" '.$clase_array[0].'>Admin</option>
                  <option value="2" '.$clase_array[1].'>Usr</option>
                </select>
              </td>
              <td><input type="submit" class="botoncito" id="enviar" name="enviar" value="Modificar"></td>
              </form>
              ';
              if($_SESSION['usr']!=$fila['mail']){
                  echo '<td><a href="admin/adminUSRelimina.php?mail='.$fila['mail'].'"><button class="botoncito">Borrar</button></a></td>';
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
          <td>
            <select class="caja-texto" name="permisos" id="permisos">
                  <option value="1">Admin</option>
                  <option value="2" selected>Usr</option>
            </select>
          </td>
          <td><input type="submit" class="botoncito" id="enviar" name="enviar" value="Agregar"></td>
          </form>
        </tr>
  </table>
</div><!--************************************************************** -->

