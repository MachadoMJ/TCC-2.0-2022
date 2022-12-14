<?php
  include '../../../connect.php';

//Nome e Foto  
  $sql = "SELECT name, img FROM Client where id = $_SESSION[IdUser]";
  $stmt = sqlsrv_query($conn, $sql);

  if(sqlsrv_fetch( $stmt )) {

    $name = sqlsrv_get_field( $stmt, 0); //nome do usuario
    $img  = sqlsrv_get_field( $stmt, 1); //imagem
  }
//Tipo usuario -- TpUser (função do user) / home (qual home ele deve ser redirecionado)
  if      ( $_SESSION['TpUser'] == 'A' ) 
    { $home   = 'index.php';
      $html1  = '<li class="nav-header">Armazem</li><li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon far fa-plus-square"></i><p> Gerenciar produtos <i class="fas fa-angle-left right"></i> </p></a><ul class="nav nav-treeview"><li class="nav-item"><a href="../../Category.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Categorias</p></a></li><li class="nav-item"><a href="../../products.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Produtos</p></a></li></ul></li>';
      $html2  = '';
    }

  elseif  ( $_SESSION['TpUser'] == 'V' ) 
    { $home   = 'index.php'; 
      $html1  = '<li class="nav-header">Armazem</li><li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon far fa-plus-square"></i><p> Gerenciar produtos <i class="fas fa-angle-left right"></i> </p></a><ul class="nav nav-treeview"><li class="nav-item"><a href="../../Category.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Categorias</p></a></li><li class="nav-item"><a href="../../products.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Produtos</p></a></li></ul></li>';
      $html2  = '';
    } 

  else 
    { $home   = 'index3.php'; 
      $html1  = '';
      $html2  = '';
    }
  
//trazendo os produtos
  $sql  = "SELECT * FROM VW_Contacts_Product where Category = $_GET[IdCate]";
  $stmt = sqlsrv_query($conn, $sql);

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Contacts</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../<?php  echo $home; ?>" class="nav-link">Home</a>
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
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../<?php  echo $home; ?>" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../../<?php echo $img; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $name ?></a>
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
            <a href="../../<?php  echo $home; ?>" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          
          <li class="nav-header">Loja</li>

            <li class="nav-item">
              <a href="../gallery.php" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Produtos
                </p>
              </a>
            </li>

          <?php echo $html1; ?>

          <li class="nav-header">Configuração</li>

          <li class="nav-item">
            <a href="./profile.php" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Profile
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
            <h1>Produtos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Produtos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row">
            
            <?php while ( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {?>
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0"> <?php echo $row[0]; ?> </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b> <?php echo $row[1]; ?> </b></h2>
                      <p class="text-muted text-sm"><b>Descrição: </b> <?php echo $row[2]; ?> </p>

                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"></span><b>Registrado: </b> <?php echo $row[4]; ?></li>
                      </ul>

                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"></span><b>Preço: </b> <?php echo $row[5]; ?></li>
                      </ul>

                    </div>
                    <div class="col-5 text-center">
                      <img src="../../../<?php echo $row[3]; ?>" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="./e-commerce.php?IdPrd=<?php echo $row[7]; ?>" class="btn btn-sm btn-primary">
                      <i class="fas fa-lg fa-building"></i> Visualizar produto
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>

          </div>
        </div>
      </div>
      <!-- /.card -->

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
