<?php
  include '../../../connect.php';

//Nome e Foto  
  $sql = "SELECT name, img FROM Client where id = $_SESSION[IdUser]";
  $stmt = sqlsrv_query($conn, $sql);
    
  if(sqlsrv_fetch( $stmt )) {
  
    $name = sqlsrv_get_field( $stmt, 0); //nome do usuario
    $img  = sqlsrv_get_field( $stmt, 1); //imagem
  }

//trazendo informações
  $sql = "SELECT name, Login, pass FROM Client where id = $_GET[IdUser];";
  $stmt = sqlsrv_query($conn, $sql);

  if(sqlsrv_fetch( $stmt )) {
  
    $UpName = sqlsrv_get_field( $stmt, 0);
    $UpUser = sqlsrv_get_field( $stmt, 1);
    $UpPass = sqlsrv_get_field( $stmt, 2);
  }

//Atualizando Usuario
  if(isset($_POST['UpSub'])){

    $nameU = $_POST['UpName'];
    $user = $_POST['UpUser'];
    $pass = $_POST['UpPass'];
    $type = $_POST['UpType'];

    if( $_FILES['UpIMG']['name'] ){//Verificando se tem imagem
      if ( substr($_FILES['UpIMG']['type'],0,5) == 'image' ) {//Verificando se o tipo do arquivo é uma imagem
        
        $_FILES['UpIMG']['name'] = $user . '.' . substr($_FILES['UpIMG']['type'],6,null); //renomenado o arquivo

        move_uploaded_file($_FILES['UpIMG']['tmp_name'], "../../../image/user/".$_FILES['UpIMG']['name']);
        $imgU="image/user/".$_FILES['UpIMG']['name'];


        //atualizar usuario
        $sqlU = " update client
                    set Name	= '$nameU',
                        Login	= '$user',
                        Pass	= '$pass',
                        Img		= '$imgU' ,
                        Type	= '$type'
                    where Id = $_GET[IdUser]";

        $stmt = sqlsrv_query($conn, $sqlU);
        if( $stmt === false) { $errors = sqlsrv_errors(); 
          foreach( $errors as $error ) { if ($error[ 'code'] == '2627') { echo 'usuario com esse login já existe';} break; } }//se o usuario já existir vai retornar erro


        //inserir Log
        $sqlL = " insert into log.tmp_log (Client,action, calendar)
                    values ($_SESSION[IdUser], 'Update in user [$user] ', 'Client')";
                    
        $stmt = sqlsrv_query($conn, $sqlL);
        if( $stmt === false) { echo 'falha ao cadastrar usuario'; }

      }else {
        echo 'o arquivo deve ser uma imagem';
      }
    }else {
      echo 'imagem com erro';
    }
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | User Profile</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="./profile.php" class="nav-link">Profile</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><b>Butchery</b> Adm</a></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../../<?php echo $img; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $name; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- ICONES DO MENU -->


          <li class="nav-item">
            <a href="../../index.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          
          <li class="nav-header">Loja</li>

            <li class="nav-item">
              <a href="../gallery.html" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Produtos
                </p>
              </a>
            </li>

            <li class="nav-header">Armazem</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon far fa-plus-square"></i>
                  <p>
                    Gerenciar produtos
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>

                <ul class="nav nav-treeview">              

                  <li class="nav-item">
                    <a href="../../category.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Categorias</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="../../product.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Produtos</p>
                    </a>
                  </li>    

                </ul>
              </li>

            <li class="nav-header">Configuração</li>

              <li class="nav-item">
                <a href="./profile.php" class="nav-link">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>
                    Profile
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./profile-adm.php" class="nav-link">
                  <i class="nav-icon far fa-plus-square"></i>
                  <p>
                    Gerenciar Usuarios
                  </p>
                </a>
              </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile-Adm Edit User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          
          <div class="col-md-12">
            <div class="card card-default">

              <div class="card-header">
                CADASTRO
              </div>

              <div class="card-body">
                  <form method="post" enctype="multipart/form-data">
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nome Usuario</label>
                    <input type="text" class="form-control" placeholder="<?php echo $UpName ?>" name="UpName" >
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Nome Login</label>
                    <input type="text" class="form-control" placeholder="<?php echo $UpUser ?>" name="UpUser" >
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Senha</label>
                    <input type="text" class="form-control" placeholder="<?php echo $UpPass ?>" name="UpPass" >
                  </div>

                  <div class="form-group row">
                    <label for="InputFile" class="col col-form-label">Foto</label>
                    <div class="col-sm-12">

                      <div class="custom-file" id="InputFile">
                        <input type="file" class="custom-file-input" name="UpIMG">
                        <label class="custom-file-label">Foto</label>
                      </div>

                    </div>
                  </div>

                  <label for="exampleInputEmail1">Tipo</label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="UpType" value="A">
                        <label class="form-check-label">Administrador</label>

                        <br>

                        <input class="form-check-input" type="radio" name="UpType" value="V">
                        <label class="form-check-label">Vendedor</label>

                        <br>
                      
                        <input class="form-check-input" type="radio" name="UpType" value="U" checked>
                        <label class="form-check-label">Usuario</label>
                      </div>

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary" style="width: 100%;" name="UpSub">Submit</button>
                  </div>
                </form>
              </div>

            </div>
          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
