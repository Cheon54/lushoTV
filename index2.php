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
            //
        session_start();
        if(!$_SESSION['logged']){
            header("Location: Login.php");
            exit;
        }
        include("conexion.php");
        $rut = $_SESSION['Rut'];
        
        
        $sql = 'SELECT * FROM usuarios where Rut="'.$rut.'"';
        $result = mysqli_query($mysqli, $sql);
        while($row = mysqli_fetch_array($result)){
            $contrato = $row['Contrato'];
            $nombre = $row['Nombre'];
            $apellido = $row['Apellidos'];
            $admin = $row['Admin'];
        }
        echo "<h2>BIENVENIDO <b>".$nombre." ".$apellido."</b></h2><br><br>";
        echo "<div class='col-md-6 text-center'>";
        if ($contrato== 0){
            echo "<b>No tienes ningún plan activo. Contratar plan aquí -></b><br>
            <A href='contratar.php'>
            <img src='img/contrata.png' ></a><br><br><br>";
        }else{
            echo "<b>Ver mi plan -></b><br>
            <A href='Detalles.php'>
            <img src='img/ver.png' ></a><br><br><br>";
        }
        echo "</div>";
        echo "<div class='col-md-6 text-center'>";
        if ($admin == 0){
            echo "<img src='img/oferton.png'><br><br><br>";
        }else{
            echo "<h2>Eres Operador</h2><br><input type='button' value='Administrar' onclick='location.href=\"callcenter.php\"' class='btn btn-success'><br><br><br>";
        }
        echo "</div>";
        ?>
        <br><br><br>
            
            </div>
          </div>
        </div>
      </div>
    </div> 
   </div>
</div>
    </body>
</html>
