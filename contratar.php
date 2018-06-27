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
        <script type="text/javascript">
          function valida()
          {
              var fono = document.getElementById("fono").value;
              if (!/^[0-9]{9}$/.test( fono ))
              {
                  alert("Ingrese un telefono correctamente");
                  return false;   
              }
          }
        </script>
        <style>
        .container {
                width: 95%;
            }
        </style>
    
    </head>
    <body>
        <?php
        ob_start();
        session_start();
        if(!$_SESSION['logged']){
            header("Location: Login.php");
            exit;
        }
            include("conexion.php");
            $enviado = FALSE;
            $rut = $_SESSION['Rut'];
            $decos = NULL;
            $finstalacion = NULL;
            $hinstalacion = NULL;
            $direccion = $_SESSION['Direccion'];
            $comuna = NULL;
            $fono = NULL;
            $fpago = NULL;
            
            $deportes = NULL;
            $cineyfamilia = NULL;
            $cultura = NULL;
            
            $sql = 'SELECT * FROM usuarios where Rut="'.$rut.'"';
            $result = mysqli_query($mysqli, $sql);
            while($row = mysqli_fetch_array($result)){
                $contrato = $row['Contrato'];
            }

            if ($contrato == 1){
                header('Refresh: 0;url=index2.php');
                exit;
            }else{
                
            }
            
            if (isset($_POST['submit'])) {
                $enviado = TRUE;
                $rut = $_POST['rut'];
                $decos = $_POST['decos'];
                $finstalacion = $_POST['finstalacion'];
                $hinstalacion = $_POST['hinstalacion'];
                $direccion = $_POST['direccion'];
                $comuna = $_POST['comuna'];
                $fono = $_POST['fono'];
                $fpago = $_POST['fpago'];
                
                $plan = 1;
                if(isset($_POST['deportes'])){
                    $deportes = 1;
                }else{
                    $deportes = 0;
                }
                if(isset($_POST['cineyfamilia'])){
                    $cineyfamilia = 1;
                }else{
                    $cineyfamilia = 0;
                }
                if(isset($_POST['cultura'])){
                    $cultura = 1;
                }else{
                    $cultura = 0;
                }
                
               
            }
        ?>
<div class="container">
   <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-login">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">        
                <form method="post" action="" style="display: block;">
                    <div class="form-group">
            <label for="rut">Rut:</label>
                <input name="rut" type="text" placeholder="EJ: 12.333.444-5" value="<?php echo $rut; ?>" readonly>
                </div>
            <!--=============================================================================================-->
            <div class="form-group">
            <label for="planentrada">Plan Entrada:</label>
                <input name="planentrada" type="checkbox" value="1" checked disabled>
            </div>
            <div class="form-group">
                <label for="otrosplan">Servicios extra:</label>
                <label><input name="deportes" type="checkbox" value="1" <?php if($deportes == 1){echo "checked";} ?>> Deportes</label>
                <label><input name="cineyfamilia" type="checkbox" value="1" <?php if($cineyfamilia == 1){echo "checked";} ?>> Cine y Familia</label>
                <label><input name="cultura" type="checkbox" value="1" <?php if($cultura == 1){echo "checked";} ?>> Cultura</label>
            </div>
            <!--=============================================================================================-->
            <div class="form-group">
            <label for="decos">Cantidad de Decodificadores:</label>
                <select name="decos" required>
                    <?php
                   for($i=1;$i<=5;$i++)
                       {
                       $selected2 = "";
                       if ($decos == $i){
                           $selected2 = "selected";
                       }
                       echo '<option value='.$i.' '.$selected2.'>'.$i.' Deco/s</option>';  
                       }  
                   ?>
                </select>
                </div>
            <!--=============================================================================================--> 
            <div class="form-group">
            <label for="finstalacion">Fecha instalacion:</label>
                <input name="finstalacion" type="text" value="<?php echo $finstalacion; ?>" required id='datetimepicker1'>
                <label for="hinstalacion">Hora:</label>
                <select name="hinstalacion">
                    <option value="0">Selecionar hora</option>
                   <?php
                   for($i=9;$i<=20;$i++)
                       {
                       $selected = "";
                       if ($hinstalacion == $i){
                           $selected = "selected";
                       }
                       echo '<option value='.$i.' '.$selected.'>'.$i.':00 Hrs</option>';  
                       }  
                   ?>
                </select>
            </div>
            <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datepicker({ dateFormat: "dd-mm-yy", minDate: 1 });
                
            });
            </script>
            <!--=============================================================================================-->
            <div class="form-group">
            <label for="direccion">Direccion:</label>
            <input name="direccion" type="text" placeholder="Direccion" value="<?php echo $direccion ?>" required>
            </div>
            <!--=============================================================================================-->
            <div class="form-group">
            <label for="comuna">Comuna:</label>
            <select name="comuna">
                    <option value="0">Selecionar comuna</option>
                    <option value="Maipu" <?php if($comuna == 'Maipu'){echo "selected";} ?> >Maipu</option>
                    <option value="La florida" <?php if($comuna == 'La florida'){echo "selected";} ?> >La florida</option>
            </select>
            </div>
            <!--=============================================================================================-->
            <div class="form-group">
            <label for="fono">Telefono:</label>
            <input name="fono" type="text" placeholder="Telefono" value="<?php echo $fono ?>" required id="fono">
            </div>
            <!--=============================================================================================-->
            <div class="form-group">
            <label for="fpago">Fecha Pago:</label>
            <select name="fpago">
                    <option value="0">Selecionar una fecha de pago</option>
                    <option value="1" <?php if($fpago == 1){echo "selected";} ?> >Primer día hábil</option>
                    <option value="2" <?php if($fpago == 2){echo "selected";} ?> >Quincena</option>
                    <option value="3" <?php if($fpago == 3){echo "selected";} ?> >Último día hábil</option>
            </select>
            </div>
            <!--=============================================================================================-->
            <div class="col-xs-6 form-group pull-left checkbox">
                <b>
        <?php
            if($enviado){
                //validar
                if($hinstalacion != 0){
                    if($comuna != '0'){
                        if($fpago !=0){
                            $sql = "INSERT INTO contratos(Rut, Decos, Finstalacion, Hinstalacion, Direccion, Comuna, Fono, Fpago, Plan, Depo, CyF, Cultu, Estado) values ('".$rut."', '$decos', '$finstalacion', '$hinstalacion', '$direccion', '$comuna', '$fono', '$fpago', '$plan', '$deportes', '$cineyfamilia', '$cultura', 'Pendiente')";
                            $result = mysqli_query($mysqli, $sql);
                            $sql = "UPDATE usuarios SET Contrato='1' WHERE Rut='".$rut."'";
                            $result = mysqli_query($mysqli, $sql);
                            echo "Su contrato está listo.";
                            header('Refresh: 2;url=index2.php');
                        }else{
                            echo "Selecione fecha de pago";
                        }
                    }else{
                        echo "Seleccione comnuna";
                    }
                }else{
                    echo "Selecione hora de instalacion";
                }
            }
            ob_end_flush();
        ?>
                    </b>
                </div>
                <div class="col-xs-6 form-group pull-right">
                <input name="submit" type="submit" value="Contratar" class="form-control btn btn-login">
            </div>
        </form>
            </div>
          </div>
        </div>
          <div class="panel-heading">
          <div class="row">
            <div class="col-xs-6 tabs">
              <a href="#" class="active" id="login-form-link"><div class="login">Contrato</div></a>
            </div>
            <div class="col-xs-6 tabs">
              <a href="index2.php"  id="register-form-link"><div class="register">Cancelar</div></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    </body>
</html>