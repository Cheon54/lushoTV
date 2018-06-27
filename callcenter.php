<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="estilos.css" rel="stylesheet">
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <style>
        .container {
                width: 95%;
            }
        </style>
    </head>
    <body>
<div class="container">
   <div class="row">
    <div class="col-md-12">
      <div class="panel panel-login">
        <div class="panel-body">    
          <div class="row">
            <div class="col-lg-12">
                <div class="col-xs-3 form-group pull-right">
                    <input type="button" onclick="location.href='deslogin.php'" value="Cerrar sesión" class="form-control btn btn-login">
                </div>
<?php
ob_start();
session_start();
        if(!$_SESSION['logged']){
            header("Location: Login.php");
            exit;
        }
        if ($_SESSION['Admin']==0) {
            header("Location: index2.php");
            exit;
        }

        include("conexion.php");
        $filtrado = "";
        $filtrado2 ="";
        $ffechax = NULL;
        $ffcomuna =NULL;
        if (isset($_POST['filtrar'])) {

                $ffcomuna = $_POST['ffcomuna'];
                if($ffcomuna== 0){
                  $filtrado = "";
                }
                else if($ffcomuna == 1){
                  $filtrado = "WHERE Comuna='Maipu'";
                }else if($ffcomuna == 2){
                  $filtrado = "WHERE Comuna='La florida'";

                }

                $ffechax = $_POST['ffecha'];
                if($ffechax == NULL){
                  $filtrado2 = " ";
                }else{
                  if($ffcomuna != 0){
                    $filtrado2 = " AND Finstalacion='$ffechax'";
                  }else{
                    $filtrado2 = "WHERE Finstalacion='$ffechax'";
                  }
                  
                }


              }
              if (isset($_POST['nofiltro'])) {

                $ffcomuna = $_POST['ffcomuna'];
                if($ffcomuna== 0){
                  $filtrado = "";
                }
                else if($ffcomuna == 1){
                  $filtrado = " ";
                }else if($ffcomuna == 2){
                  $filtrado = " ";

                }

                $ffechax = $_POST['ffecha'];
                if($ffechax == NULL){
                  $filtrado2 = " ";
                }else{
                  $filtrado2 = " ";
                }


              }
        
        
        
        echo "<h2>DETALLES DE USUARIOS</h2><br><br>";

        echo "<div class='col-md-12 center'>";
        echo "<h1>Filtrado de contratos</h1>";
                echo "<center>";
                echo "<div class='panel panel-default'>";
                echo "<div class='panel-body'>";
        echo "<form method='post'>";
        echo "<label class='label label-default'> Por Comuna =</label>";
        ?>
        <select name='ffcomuna' class='btn'>
                <option value='0'>Todas las comunas</option>
                <option value='1' <?php if($ffcomuna == 1){echo "selected";} ?> >Maipú</option>
                <option value='2' <?php if($ffcomuna == 2){echo "selected";} ?>>La Florida</option>
              </select>
               <?php
              echo "<label class='label label-default'> Por fecha =</label>";
        ?>
      <input name="ffecha" type="text" value="<?php echo $ffechax; ?>" id='datetimepicker1'><br><br>
        <?php

              



         echo "<input type='submit' name='filtrar' value='filtrar' class='btn btn-success'>";
         echo "<input type='submit' name='nofiltro' value='Quitar Filtros' class='btn btn-danger'>";
         echo "</form>";
         
         echo "</div>";
                echo "</div>";
                echo "</center>";



        $sql = 'SELECT * FROM contratos '.$filtrado.''.$filtrado2.' Order by Finstalacion ASC';
        $result = mysqli_query($mysqli, $sql);
        echo "<div class='table-responsive'>";
        echo "<b>";
        echo "<table class='table table-hover'>
               <tr bgcolor=#cccccc>
               <td>Rut</td>
               <td>Fecha Insta</td>
               <td>Hora Insta</td>
               <td>Dirección</td>
               <td>Comuna</td>
               <td>Fono</td>
               <td>|</td>
               <td>Decos</td>
               <td>Adicional</td>
               <td>Estado</td>
               </tr>";

while ( $row = mysqli_fetch_array($result) ) {
    if($row['Depo']==1){
        $Depo = '<b>Sí</b>';
    }else{
        $Depo = '<b>No</b>';
    }
    if($row['CyF']==1){
        $CyF = '<b>Sí</b>';
    }else{
        $CyF = '<b>No</b>';
    }
    if($row['Cultu']==1){
        $Cultu = '<b>Sí</b>';
    }else{
        $Cultu = '<b>No</b>';
    } 

        echo  "<tr>
               <td>".$row['Rut']."</td>
               <td>".$row['Finstalacion']."</td>
               <td>".$row['Hinstalacion']." Hrs</td>
               <td>".$row['Direccion']."</td>
               <td>".$row['Comuna']."</td>
               <td>".$row['Fono']."</td>
               <td>|</td>
               <td>".$row['Decos']."</td>
               <td>";
        echo  "Deportes: ".$Depo."
               - Cine y Familia: ".$CyF."
               - Cultura: ".$Cultu."";



        echo  "</td>
               <td>".$row['Estado']."</td>
               </tr>";
}


        echo "</table>";
        echo "</b>";
        echo "</div>";
        echo "</div>";


                echo "<h1>Modificar Estado</h1>";
                echo "<center>";
                echo "<div class='panel panel-default'>";
                echo "<div class='panel-body'>";
                echo "<form method='post'>";
                echo "<label class='label label-default'>Rut =</label>";
                echo "<input type='text' name='rut' placeholder='Rut' class='btn' required>";
                echo "<label class='label label-default'> Estado =</label>";
                echo "<select name='estado' class='btn'>
                        <option value='0'>Selecionar estado</option>
                        <option value='Pendiente'>Pendiente</option>
                        <option value='En Proceso'>En Proceso</option>
                        <option value='Asignada'>Asignada</option>
                        <option value='CerradaPorUsuario'>Cerrada Por Usuario</option>
                        <option value='Cancelada'>Cancelada</option>
                      </select>";
                      if(isset($_POST['enviar'])){

                      $rut  = $_POST['rut'];
                      $estado = $_POST['estado'];

                      if($estado == '0'){
                          echo "<label>Selecione estado</label>";
                      }else{
                          $modificar = mysqli_query($mysqli ,"UPDATE contratos SET Estado='$estado' WHERE Rut='".$rut."'");

                          if($modificar){
                              echo "<label>Se modifico correctamente</label>";
                              header('refresh: 1; url=refresh.php');
                          }
                      }
                  }
                echo "<input type='submit' name='enviar' value='Modificar' class='btn btn-success'>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "</center>";

            




            ?>
                <div class="col-xs-3 form-group pull-right">
                    <input type="button" onclick="location.href='index2.php'" value="Volver" class="form-control btn btn-login">
                </div>    
        <br><br><br>
            
            </div>
          </div>
        </div>
      </div>
    </div> 
   </div>
</div>
            <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datepicker({ dateFormat: "dd-mm-yy" });
                
            });
            </script>
    </body>
</html>
<?php

ob_end_flush();
?>