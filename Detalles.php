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
            $admin = $row['Admin'];
            $email = $row['Email'];
        }
        $sql = 'SELECT * FROM contratos where Rut="'.$rut.'"';
        $result = mysqli_query($mysqli, $sql);
        while($row = mysqli_fetch_array($result)){
            $decos = $row['Decos'];
            $comuna = $row['Comuna'];
            $direccion = $row['Direccion'];
            $deportes = $row['Depo'];
            $cineyfamilia = $row['CyF'];
            $cultura = $row['Cultu'];
        }
        
        echo "<h2>DETALLES DE <b>".$nombre."</b></h2><br><br>";
        echo "<div class='col-md-12 center'>";
        echo "<b>";
        if($contrato == 0){
            echo "no tienes ningun contrato";
        }else{
            echo "Nombre : ".$nombre;
            
            
            echo "<br>";
       ?>
                Comuna: <?php echo $comuna; ?> <br>
                
                Direccion: <?php echo $direccion; ?> <br>
                <br>
                
                Canales de Deportes:  <?php if ($deportes == 1){echo "sí"; }else{echo "no";} ?><br>
                Canales de Cine y Familia:  <?php if ($cineyfamilia == 1){echo "sí"; }else{echo "no";} ?><br>
                Canales de Cultura:  <?php if ($cultura == 1){echo "sí"; }else{echo "no";} ?><br>
                <br>
                <br>
                
            <?php
            echo "</b>";
            echo "</div>";
                 }
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
    </body>
</html>


