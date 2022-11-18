<?php
  include '../../connect.php';

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
      $html1  = '<li class="nav-header">Armazem</li><li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon far fa-plus-square"></i><p> Gerenciar produtos <i class="fas fa-angle-left right"></i> </p></a><ul class="nav nav-treeview"><li class="nav-item"><a href="../Category.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Categorias</p></a></li><li class="nav-item"><a href="../products.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Produtos</p></a></li></ul></li>';
      $html2  = '';
    }

  elseif  ( $_SESSION['TpUser'] == 'V' ) 
    { $home   = 'index.php'; 
      $html1  = '<li class="nav-header">Armazem</li><li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon far fa-plus-square"></i><p> Gerenciar produtos <i class="fas fa-angle-left right"></i> </p></a><ul class="nav nav-treeview"><li class="nav-item"><a href="../Category.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Categorias</p></a></li><li class="nav-item"><a href="../products.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Produtos</p></a></li></ul></li>';
      $html2  = '';
    } 

  else 
    { $home   = 'index3.php'; 
      $html1  = '';
      $html2  = '';
    }

//trazendo as categorias
  $sql  = "SELECT * FROM VW_Gallery_Category";
  $stmtC = sqlsrv_query($conn, $sql);

//trazendo os ultimos produtos
  $sql  = "SELECT * FROM VW_Gallery_Product";
  $stmtP = sqlsrv_query($conn, $sql);



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Loja</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="../plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
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
        <a href="../<?php echo $home; ?>" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="./examples/profile.php" class="nav-link">Profile</a>
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
    <a href="../<?php echo $home; ?>" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../<?php echo $img; ?>" class="img-circle elevation-2" alt="User Image">
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
            <a href="../<?php echo $home; ?>" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Home
              </p>
            </a>
          </li>

          <li class="nav-header">Loja</li>
          
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Produtos
                </p>
              </a>
            </li>
          
          <?php echo $html1; ?>

          <li class="nav-header">Configuração</li>

          <li class="nav-item">
            <a href="./examples/profile.php" class="nav-link">
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
            <h1>Categorias</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../<?php echo $home; ?>">Home</a></li>
              <li class="breadcrumb-item active">Loja </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">Escolha a Categoria de Produto</h4>
              </div>
              <div class="card-body">
                <div class="row"> <!-- ITENS CATEGORIA -->

                  <?php while ( $row = sqlsrv_fetch_array( $stmtC, SQLSRV_FETCH_NUMERIC) ) {?>
                  <div class="col-sm-2">
                    <a href="./examples/contacts.php?IdCate=<?php echo $row[0]; ?>">
                      <img src="https://via.placeholder.com/300/FFFFFF?text=<?php echo $row[1]; ?>" class="img-fluid mb-2" alt="white sample"/>
                    </a>
                  </div>
                  <?php } ?>
                  
                </div>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">Ultimos Produtos</h4>
              </div>
              <div class="card-body">
                <div class="row"> <!-- ITENS Novos produtos -->

                  <?php while ( $row = sqlsrv_fetch_array( $stmtP, SQLSRV_FETCH_NUMERIC) ) {?>
                  <div class="col-sm-2">
                  <a href="./e-commerce.html">
                    <a href="../../<?php echo $row[2]; ?>" data-toggle="lightbox" data-title="<?php echo $row[1]; ?>" data-gallery="galler">
                      <img src="https://via.placeholder.com/300/FFFFFF?text=<?php echo $row[1]; ?>" class="img-fluid mb-2" alt="white sample" />
                    </a>
                  </a>
                  </div>
                  <?php } ?>

                </div>
              </div>
            </div>
          </div>
        </div>
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
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Ekko Lightbox -->
<script src="../plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Filterizr-->
<script src="../plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>
</body>
</html>
