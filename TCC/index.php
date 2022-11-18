<?php
  include 'connect.php';
    
//Verifica Login/pass e redireciona a pagina
  if(isset($_POST['sub'])){
    
    $user = $_POST['u']?? "";
    $pass = $_POST['p']?? "";

    $sql = "SELECT id, Type FROM Client where Login = '$user' and Pass = '$pass'";
    $stmt = sqlsrv_query($conn, $sql);

    if(sqlsrv_fetch( $stmt )) {

      $_SESSION['IdUser'] = sqlsrv_get_field( $stmt, 0);
      $_SESSION['TpUser'] = sqlsrv_get_field( $stmt, 1);

      if ( $_SESSION['TpUser'] == 'A' or $_SESSION['TpUser'] == 'V' ) 
           { header ('location: ./AdminLTE-3.2.0/index.php' ); } //se for Adm ou Vendedor
      else { header ('location: ./AdminLTE-3.2.0/index3.php'); } //se for Usuario

    }else { echo '<button class="btn btn-danger btn-sm">usuario não encontrado </button>';};
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logar</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="./AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./AdminLTE-3.2.0/dist/css/adminlte.min.css">
    <link rel="icon" href="./image/icon.png">

  </head>

  <body class="hold-transition login-page">
    
    <div class="login-box">
      <div class="login-logo">
        <b>Butchery</b> Adm</a>
      </div>
      
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Logue para iniciar sua sessão</p>

          <form method="post"> <!-- action="./AdminLTE-3.2.0/index3.html" method="post" -->
            <div class="input-group mb-3">

              <input type="" class="form-control" placeholder="Usuario" name="u" >

              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">

              <input type="password" class="form-control" placeholder="Password" name="p" >

              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <p class="mb-0">
                    <a href="register.php" class="text-center">Cadastrar-se</a>
                  </p>

                </div>
              </div>

              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block" name="sub">Logar</button>
              </div>
              <!-- /.col -->
            </div>
          </form>


        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="./AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
  </body>
</html>
