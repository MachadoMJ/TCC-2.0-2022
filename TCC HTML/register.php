<?php
  include 'connect.php';

// Cadastrar Usuario
if(isset($_POST['sub'])){

    $name = $_POST['name'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];


    if( $_FILES['file']['name'] ){// Verificando se tem imagem
      if ( substr($_FILES['file']['type'],0,5) == 'image' ) {// Verificando se o tipo do arquivo é uma imagem
        
        $_FILES['file']['name'] = $user . '.' . substr($_FILES['file']['type'],6,-1); //renomenado o arquivo

        move_uploaded_file($_FILES['file']['tmp_name'], "image/user/".$_FILES['file']['name']);
        $img="image/user/".$_FILES['file']['name'];


        //inserir usuario
        $sqlU = " insert Client (name, Login, Pass, Img, Type) 
                    values ('$name','$user','$pass','$img','U')";

        $stmt = sqlsrv_query($conn, $sqlU);
        if( $stmt === false) { $errors = sqlsrv_errors(); 
          foreach( $errors as $error ) { if ($error[ 'code'] == '2627') { echo 'usuario com esse nome já existe';} break; } }//se o usuario já existir vai retornar erro


        //inserir Log
        $sqlL = " insert into log.tmp_log (Client,action, calendar)
                    values (1, 'Register.php', 'Client')";
                    
        $stmt = sqlsrv_query($conn, $sqlL);
        if( $stmt === false) { echo 'falha ao cadastrar usuario'; }

      }else {
        echo 'o arquivo deve ser uma imagem';
      }
    }else {
        echo 'imagem com erro';
    }

    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="./AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./AdminLTE-3.2.0/dist/css/adminlte.min.css">

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="http://cdn.jsdelivr.net/g/filesaver.js"></script>
    <script src="register.js" type="text/javascript"></script>
    <title>REGISTRAR</title>
  </head>
  <body class="hold-transition register-page">
    <div class="register-box">
      <div class="register-logo">
        <b>Admin</b>LTE</a>
      </div>

      <div class="card">
        <div class="card-body register-card-body">
          <p class="login-box-msg">Register a new membership</p>

        <form method="post" enctype="multipart/form-data">

            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Nome Completo" name="name" id="name">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>

            
            <!-- <div class="input-group mb-3">
              <input type="file" class="form-control" placeholder="imagem" name="file" id="file">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-file"></span>
                </div>
              </div>
            </div> -->

            <div class="input-group mb-3">
              <div class="input-group-append">
                <div class="custom-file" id="InputFile">
                  <input type="file" class="form-control" name="file" id="file">
                  <label class="custom-file-label" for="file">Foto</label>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Usuario" name="user" id="user">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" name="pass" id="pass">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
          
            
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                  <label for="agreeTerms">
                  I agree to the <a href="#">terms</a>
                  </label>
                </div>
              </div>

              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block" name="sub" >Register</button>
              </div>
              <!-- /.col -->
            </div>
        </form>

          <a href="index.php" class="text-center">Logar</a>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="./AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
  </body>
</html>


