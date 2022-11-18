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

//Registrando a venda
  if(isset($_POST['Sub'])){

    $sql  = "exec PRC_Insert_Sale $_SESSION[IdUser], $_GET[IdPrd], $_POST[Qtd]";
    $stmt = sqlsrv_query($conn, $sql);
    if( $stmt === false) { echo 'falha ao Registrar Venda'; }


  //inserir Log
    $sqlL = " insert into log.tmp_log (Client,action, calendar)
              values ($_SESSION[IdUser], 'insert Sale [$_GET[IdPrd]] ', 'Sale')";
            
    $stmt = sqlsrv_query($conn, $sqlL);
    if( $stmt === false) { echo 'falha ao Registrar Log de Venda'; }

  }

//trazendo os dados do produto
  $sql  = "SELECT * FROM VW_Contacts_Product where IdPrd = $_GET[IdPrd]";
  $stmt = sqlsrv_query($conn, $sql);

  if(sqlsrv_fetch( $stmt )) {

    $nameP = sqlsrv_get_field( $stmt, 1);
    $Descr = sqlsrv_get_field( $stmt, 2);
    $Image = sqlsrv_get_field( $stmt, 3);
    $Regis = sqlsrv_get_field( $stmt, 4);
    $Price = sqlsrv_get_field( $stmt, 5);
    $IdPrd = sqlsrv_get_field( $stmt, 7);
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | E-commerce</title>

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
        <a href="../../<?php echo $home; ?>" class="nav-link">Home</a>
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
    <a href="../../<?php echo $home; ?>" class="brand-link">
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
            <a href="../../<?php echo $home; ?>" class="nav-link">
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
            <h1>Produto</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../<?php echo $home; ?>">Home</a></li>
              <li class="breadcrumb-item active">Produto</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">

            
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">teste nome produto</h3>
              <div class="col-12">
                <img src="../../../<?php echo $Image; ?>" class="product-image" alt="Product Image">
              </div>
            </div>


            <div class="col-12 col-sm-6">
              <h3 class="my-3"><?php echo $nameP; ?></h3>
              <p>
                <?php echo $Descr; ?>
              </p>

              <hr>

              <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                  R$ <?php echo $Price; ?>
                </h2>
              </div>

              <form method="post">
                <label for="exampleInputEmail1"></label>
                <input type="number" min="1" step="any" class="form-control" placeholder="Quantidade" name="Qtd" min="2" value="1" onkeydown="if(event.key==='.'){event.preventDefault();}"  oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');">

                <div class="mt-4">
                  
                  <button type="submit" class="btn btn-primary" style="width: 100%;" name="Sub" ><i class="fas fa-cart-plus fa-lg mr-2"></i> Comprar</button>
                </div>
              </form>

              <div class="mt-4 product-share">
                <a href="#" class="text-gray">
                  <i class="fab fa-facebook-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fab fa-twitter-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-envelope-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-rss-square fa-2x"></i>
                </a>
              </div>

            </div>
          </div>

        </div>
        <!-- /.card-body -->
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
<script>
  $(document).ready(function() {
    $('.product-image-thumb').on('click', function () {
      var $image_element = $(this).find('img')
      $('.product-image').prop('src', $image_element.attr('src'))
      $('.product-image-thumb.active').removeClass('active')
      $(this).addClass('active')
    })
  })
</script>
</body>
</html>
