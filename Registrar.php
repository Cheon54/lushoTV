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
              
              var  rut = document.getElementById("rut").value;
              var  correo = document.getElementById("correo").value;
              var fono = document.getElementById("fono").value;

               
              if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rut ))
              {
                  alert("Ingrese rut correctamente");
                  return false;   
              }
              else if (!/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$/.test( correo ))
              {
                  alert("Ingrese un coreo correctamente");
                  return false;   
              }
              else if (!/^[0-9]{9}$/.test( fono ))
              {
                  alert("Ingrese un telefono correctamente");
                  return false;   
              }
          }
        </script>
    </head>
    <body>
        <?php
        ob_start();
        session_start();
        if(isset($_SESSION['logged'])){
            header("Location: index2.php");
            exit;
        }
            include("conexion.php");
            $enviado = FALSE;
            $rut = NULL;
            $nombre = NULL;
            $apellidos = NULL;
            $email = NULL;
            $fono = NULL;
            $direccion = NULL;
            
            if (isset($_POST['submit'])) {
                $enviado = TRUE;
                $rut = $_POST['rut'];
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];
                $email = $_POST['email'];
                $fono = $_POST['fono'];
                $direccion = $_POST['direccion'];
                $contra = $_POST['contra'];
                $recontra = $_POST['recontra'];
                
                if($_POST['rut'] != NULL ){
                    $sql = 'SELECT * FROM usuarios'; 
                    $rec = mysqli_query($mysqli, $sql); 
                    $verificar_usuario = 0; 

                    while($result = mysqli_fetch_object($rec)){ 
                        if($result->Rut == $_POST['rut']){ 
                            $verificar_usuario = 1; 
                        } 
                    }
                }
            }
            //rut, nombre, apellidos, email, fono, direccion, password
        ?>
<div class="container">
   <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-login">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">      
        <form method="post" action="" style="display: block;" onsubmit="return valida()">
            <h2>Registrar</h2>
            <div class="form-group">
                <input name="rut" type="text" placeholder="Rut" value="<?php echo $rut; ?>" class="form-control" id="rut">
            </div>
            <!--=============================================================================================-->
            <div class="form-group">
                <input name="nombre" type="text" placeholder="Nombre" value="<?php echo $nombre; ?>" required class="form-control">
            </div>
            <!--=============================================================================================-->
            <div class="form-group">
                <input name="apellidos" type="text" placeholder="Apellidos" value="<?php echo $apellidos; ?>" required class="form-control">
            </div>
            <!--=============================================================================================-->
            <div class="form-group">
                <input name="email" type="text" placeholder="Email" value="<?php echo $email; ?>" required class="form-control" id="correo">
            </div>
            <!--=============================================================================================-->
            <div class="form-group">
                <input name="fono" type="text" placeholder="Telefono (Ej: 9xxxxxxxx)" value="<?php echo $fono; ?>" required class="form-control" id="fono">
            </div>
            <!--=============================================================================================-->
            <div class="form-group">
                <input name="direccion" type="text" placeholder="Direccion" value="<?php echo $direccion; ?>" required class="form-control">
            </div>
            <!--=============================================================================================-->
            <div class="form-group">
                <input name="contra" type="password" placeholder="Contraseña"  required class="form-control">
            </div>
            <!--=============================================================================================-->
            <div class="form-group">
                <input name="recontra" type="password" placeholder="Repite contraseña"  required class="form-control">
            </div>
            <!--=============================================================================================-->
            <div class="col-xs-6 form-group pull-left checkbox">
                <b>
        <?php
        
            if($enviado){
                if($rut==NULL){
                    echo 'Ingrese Rut válido.';
                }else{
                    if($verificar_usuario == 0){ 
                            if( $contra == $recontra){
                                $sql = "INSERT INTO usuarios(Rut, Nombre, Apellidos, Email, Fono, Direccion, Password, Contrato, Admin) values ('".$rut."', '$nombre', '$apellidos', '$email', '$fono', '$direccion', '$contra', 0, 0)";
                                $result = mysqli_query($mysqli, $sql);
                                echo "¡Gracias! Has sido registrado.\n";
                                header('Refresh: 2;url=Login.php');
                            }else{
                                echo 'Las contraseñas no coinciden.';
                            }
                    }else{
                        echo 'Usuario existente.';
                    }
                }
            }
            ob_end_flush();
        ?>
                </b>
                </div>
                <div class="col-xs-6 form-group pull-right">
                <input name="submit" type="submit" value="Registrar" class="form-control btn btn-login">
            </div>
        </form>
            </div>
          </div>
        </div>
          <div class="panel-heading">
          <div class="row">
            <div class="col-xs-6 tabs">
              <a href="Login.php" id="login-form-link"><div class="login">Ingresar</div></a>
            </div>
            <div class="col-xs-6 tabs">
              <a href="#" class="active" id="register-form-link"><div class="register">Registrar</div></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    </body>
</html>
