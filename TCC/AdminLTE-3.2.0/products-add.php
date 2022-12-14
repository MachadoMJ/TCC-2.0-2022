<?php
  include '../connect.php';

//Nome e Foto  
  $sql = "SELECT name, img FROM Client where id = $_SESSION[IdUser]";
  $stmt = sqlsrv_query($conn, $sql);

  if(sqlsrv_fetch( $stmt )) {

    $name = sqlsrv_get_field( $stmt, 0); //nome do usuario
    $img  = sqlsrv_get_field( $stmt, 1); //imagem
  }

//Cadastrar produto
  if(isset($_POST['Sub'])){

    $nameI    = $_POST['name'];
    $category = $_POST['category'];
    $desc     = $_POST['desc'];
    $price    = $_POST['price'];

    if( $_FILES['file']['name'] ){//Verificando se tem imagem
      if ( substr($_FILES['file']['type'],0,5) == 'image' ) {//Verificando se o tipo do arquivo é uma imagem
        
        $_FILES['file']['name'] = $nameI . $category . '.' . substr($_FILES['file']['type'],6,null); //renomenado o arquivo

        //print_r($_FILES);
        move_uploaded_file($_FILES['file']['tmp_name'], "../image/product/".$_FILES['file']['name']);
        $imgI="image/product/".$_FILES['file']['name'];


        //inserir usuario
        $sqlU = "exec PRC_Insert_product '$nameI', $category, '$imgI', $price, $_SESSION[IdUser], '$desc' ";

        $stmt = sqlsrv_query($conn, $sqlU);
        if( $stmt === false) { $errors = sqlsrv_errors(); 
          foreach( $errors as $error ) { if ($error[ 'code'] == '2627') { echo 'produto com esse nome já existe';} break; } }//se o usuario já existir vai retornar erro


        //inserir Log
        $sqlL = " insert into log.tmp_log (Client,action, calendar)
                    values ($_SESSION[IdUser], 'insert product [$nameI] ', 'product')";
                    
        $stmt = sqlsrv_query($conn, $sqlL);
        if( $stmt === false) { echo 'falha ao cadastrar usuario Log'; }

      }else {
        echo 'o arquivo deve ser uma imagem';
      }
    }else {
        echo 'imagem com erro';
    }
  }



//Trazendo categorias existentes
  if      ( $_SESSION['TpUser'] == 'A' ) 
  { $sql  = "SELECT * FROM VW_Radio_category";
    $stmt = sqlsrv_query($conn, $sql);

  }

  elseif  ( $_SESSION['TpUser'] == 'V' ) 
  { $sql  = "SELECT * FROM VW_Radio_category where Client = $_SESSION[IdUser]";
    $stmt = sqlsrv_query($conn, $sql);

  }  

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Produtos Add</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="./pages/examples/profile.php" class="nav-link">Profile</a>
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
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../<?php echo $img; ?>" class="img-circle elevation-2" alt="User Image">
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
            <a href="./index.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          
          <li class="nav-header">Loja</li>

            <li class="nav-item">
              <a href="pages/gallery.php" class="nav-link">
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
                  <a href="./Category.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Categorias</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="./products.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Produtos</p>
                  </a>
                </li>    

              </ul>
            </li>

          <li class="nav-header">Configuração</li>

          <li class="nav-item">
            <a href="pages/examples/profile.php" class="nav-link">
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Adicionar produtos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Adicionar produtos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        
        <div class="row">
          
          <div class="col-md-12">
            <div class="card card-default">

              <div class="card-header">
                CADASTRO
              </div>

              <div class="card-body">
                <form method="post" enctype="multipart/form-data" id="InsertProduct">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Nome Produto</label>
                    <input type="text" class="form-control" placeholder="Nome" name="name">
                  </div>

                  <div class="form-group">
                    <label>Nome Categoria</label>
                    <select class="form-control select2" style="width: 100%;" name="category">

                      <?php while ( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {?>
                      <option value="<?php echo $row[2]; ?>"> <?php echo $row[0]; ?> </option>
                      <?php } ?>

                    </select>
                  </div>

                  <div class="form-group">
                    <label>Descrição</label>
                    <textarea class="form-control" maxlength="100" placeholder="Enter ... (100 caracteres)" form="InsertProduct" name="desc"></textarea>
                  </div>

                  <div class="form-group row">
                    <label for="InputFile" class="col col-form-label">Foto</label>
                    <div class="col-sm-12">

                      <div class="custom-file" id="InputFile">
                        <input type="file" class="custom-file-input" id="File" name="file">
                        <label class="custom-file-label" for="exampleInputFile">Foto</label>
                      </div>

                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Preço</label>
                    <input type="number" min="1" step="any" class="form-control" placeholder="Preço" name="price">
                  </div>

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary" style="width: 100%;" name="Sub" >Submit</button>
                  </div>
                </form>
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
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
