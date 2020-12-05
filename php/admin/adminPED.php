<div class="pagina-tiendita"><!--******************************************** -->
<table> 
      <tr>
          <th>id</th>
          <th>Cliente</th>
          <th>Total</th>
          <th>Fecha</th>
          <th>Status</th>
          <th></th>
      </tr>
      <?php
      /* PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP */
          /************** conectamos a la BD *******************************/
          include("conectadb.php");
          /*** Consultamos el usuario y psw ********************************* */
          $sql = "SELECT * FROM nota ORDER BY servido, fecha ASC";
          $resultado=$cnxdb->query($sql);
          while($fila=$resultado->fetch_array(MYSQLI_BOTH)) {
             /* 0= pendiente 1=enviado 2=terminado 3=Cancelado*/
            switch($fila['servido']){
            case 0: $color="rgb(250,255,0)"; $txtservido="Pendiente"; break;
            case 1: $color="rgb(4,217,49)"; $txtservido="Enviado"; break;
            case 2: $color="rgb(7,170,240)"; $txtservido="Terminado"; break;
            case 3: $color="rgb(200,200,200)"; $txtservido="Cancelado"; break;
            default: break;
             }
              echo '<tr style="background-color: '.$color.';" >';
              echo'
              <td>'.$fila['id_nota'].'</td>
              <td>'.$fila['id_usr'].'</td>
              <td>'.$fila['total'].'</td>
              <td>'.$fila['fecha'].'</td>
              <td>'.$txtservido.'</td>
              ';

              if($fila['servido']==0){
                echo '
                <td><a href="admin/adminPEDprocesa.php?op=2&id='.$fila['id_nota'].'"><button>Enviado</button></a></td>
                <td><a href="admin/adminPEDprocesa.php?op=1&id='.$fila['id_nota'].'"><button>Cancela</button></a></td>
                ';
              }
              elseif($fila['servido']==1){
                echo '
                <td><a href="admin/adminPEDprocesa.php?op=3&id='.$fila['id_nota'].'"><button>Terminado</button></a></td>
                <td><a href="admin/adminPEDprocesa.php?op=1&id='.$fila['id_nota'].'"><button>Cancela</button></a></td>
                ';
              }
              elseif($fila['servido']==2){echo '<td></td><td></td>';

              }
              elseif($fila['servido']==3){
                echo '
                <td><a href="admin/adminPEDprocesa.php?op=4&id='.$fila['id_nota'].'"><button>Reactiva</button></a></td>
                <td></td>
                ';
              }

              
              
              echo '</tr>';
          }

          /** Liberamos resultado y cerramos BD *************************  */
          $resultado->free();
          $cnxdb->close();//cerramos la base de datos
          
      /* PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP PHP */
      ?>

  </table>
</div><!--************************************************************** -->