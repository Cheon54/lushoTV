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
        <script type="text/javascript">
          function valida()
          {
              
              var  nombre = document.getElementById("rut").value;
               
              if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( nombre ))
              {
                  alert("Ingrese rut correctamente");
                  return false;   
              }
          }
        </script>
    </head>
    <body>
        <?php
        include("conexion.php");
        session_start();
        if(isset($_SESSION['logged'])){
            header("Location: index2.php");
            exit;
        }
        $rut ="";
        if(isset($_POST['submit'])){
          $rut = $_POST['rut'];

          $sql = 'SELECT * FROM usuarios'; 
          $rec = mysqli_query($mysqli, $sql); 
          $verificar_usuario = 0; 

          while($result = mysqli_fetch_object($rec)){ 
              if($result->Rut == $_POST['rut']){ 
                  $verificar_usuario = 1; 
              } 
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
        <form method="post" action="" style="display: block;" onsubmit="return valida()"> 
            <h2>Ingresar</h2>
            <div class="form-group">
                <input name="rut" type="text" placeholder="Rut (Ej: 12345678-9)" value="<?php echo $rut ?>" required class="form-control" id='rut'>
            </div>
            <!--=============================================================================================-->
            <div class="form-group">
                <input name="contra" type="password" placeholder="Contraseña" required class="form-control">
            </div>
            <!--=============================================================================================-->
            <div class="col-xs-6 form-group pull-left checkbox">
                <b>
        <?php
            if(isset($_POST['submit'])){
              if($verificar_usuario == 1){
                $rut= $_POST['rut'];
                $pass= $_POST['contra'];
                mysqli_set_charset($mysqli, 'utf8');
                $sql = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE Rut='".$rut."' AND Password='$pass' LIMIT 1");
                if(mysqli_num_rows($sql) == 1){

                      $row = mysqli_fetch_array($sql);
                      $_SESSION['Rut'] = $rut;
                      $_SESSION['Admin'] = $row['Admin'];
                      $_SESSION['Direccion'] = $row['Direccion'];
                      $_SESSION['logged'] = TRUE;
                      

                      echo "Haz Logeado correctamente.";
                      header('refresh: 1; url=index2.php');
                      exit;

                }else{ echo "Usuario o contraseña incorrectos";}
              }else{ echo "Usuario no existe";}
            }
            ?>
                </b>
            </div>
                <div class="col-xs-6 form-group pull-right">
                <input name="submit" type="submit" value="Logear" class="form-control btn btn-login">
            </div>
        </form>
            </div>
          </div>
        </div>
          <div class="panel-heading">
          <div class="row">
            <div class="col-xs-6 tabs">
              <a href="#" class="active" id="login-form-link"><div class="login">Ingresar</div></a>
            </div>
            <div class="col-xs-6 tabs">
              <a href="Registrar.php" id="register-form-link"><div class="register">Registrar</div></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    </body>
</html>