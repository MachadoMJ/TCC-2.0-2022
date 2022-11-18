<?php
  include '../connect.php';

//Nome e Foto  
  $sql = "SELECT name, img FROM Client where id = $_SESSION[IdUser]";
  $stmt = sqlsrv_query($conn, $sql);
  
  if(sqlsrv_fetch( $stmt )) {

    $name = sqlsrv_get_field( $stmt, 0); //nome do usuario
    $img  = sqlsrv_get_field( $stmt, 1); //imagem
  }

//dashboard01 - MEUS PEDIDOS (table)
  $sqlT = "SELECT * FROM VW_User_Sale where idclient = $_SESSION[IdUser] order by register desc ";
  $Dstmt = sqlsrv_query($conn, $sqlT);

//dashboard02 - MEUS VALORES
  //Total Produtos
  $sql = "SELECT qtdProdutos FROM VW_User_ProductQtd where Client = $_SESSION[IdUser] ";
  $stmt = sqlsrv_query($conn, $sql);
  if(sqlsrv_fetch( $stmt )) { $Qtdprod  = sqlsrv_get_field( $stmt, 0);    }else { $Qtdprod = 0;   }

  //Total Valor
  $sql = "SELECT vlclient FROM VW_User_SaleVl where Client = $_SESSION[IdUser] ";
  $stmt = sqlsrv_query($conn, $sql);
  if(sqlsrv_fetch( $stmt )) { $VlSale  = sqlsrv_get_field( $stmt, 0);     }else { $VlSale = 0;    }

  //Total Quantidade
  $sql = "SELECT QtdAmountProduct FROM VW_User_AmoutQtd where Client = $_SESSION[IdUser] ";
  $stmt = sqlsrv_query($conn, $sql);
  if(sqlsrv_fetch( $stmt )) { $QtdAmount  = sqlsrv_get_field( $stmt, 0);  }else { $QtdAmount = 0; }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link rel="icon" href="../image/icon.png">
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
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
    <a href="#" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><b>Butchery</b> Adm</a></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../<?php echo $img;?>" class="img-circle elevation-2" alt="User Image">
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
            <a href="#" class="nav-link">
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
            <h1 class="m-0">Home User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Home User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Minhas compras</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm"> <!--ADCIONAR DOWLOAD DE RELATORIO-->
                    <i class="fas fa-download"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>

                    <tr>
                      <th>Nome Produto    </th>
                      <th>Valor Unitario  </th>
                      <th>Valor Venda     </th>
                      <th>Informações     </th>
                    </tr>

                  </thead>
                  <tbody>
                    
                    <?php while ( $row = sqlsrv_fetch_array( $Dstmt, SQLSRV_FETCH_NUMERIC) ) {?>
                    <tr>
                      <td>    <?php echo $row[2]; ?> </td>
                      <td> R$ <?php echo $row[3]; ?> </td>
                      <td> R$ <?php echo $row[4]; ?> </td>
                      <td> <a href  ="./pages/examples/e-commerce.php?IdPrd=<?php echo $row[1]; ?>" class="text-muted"><i class="fas fa-search"></i></a> </td>
                    </tr>
                    <?php } ?>
  
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>

          <!-- /.col-md-6 -->
          <div class="col-lg-6">
          

            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Meus Valores</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-sm btn-tool">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-sm btn-tool">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>

              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                  <p class="text-success text-xl"><i class="ion ion-ios-refresh-empty"></i></p>
                  <p class="d-flex flex-column text-right">

                    <span class="font-weight-bold"> <?php echo $Qtdprod; ?> </span>
                    <span class="text-muted">Total de Produtos Comprados</span>

                  </p>
                </div>

                <!-- /.d-flex -->
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                  <p class="text-warning text-xl"><i class="ion ion-ios-cart-outline"></i></p>
                  <p class="d-flex flex-column text-right">

                    <span class="font-weight-bold"> R$ <?php echo $VlSale; ?> </span>
                    <span class="text-muted">Total Valor Comprado</span>

                  </p>
                </div>

                <!-- /.d-flex -->
                <div class="d-flex justify-content-between align-items-center mb-0">
                  <p class="text-danger text-xl"><i class="ion ion-ios-people-outline"></i></p>
                  <p class="d-flex flex-column text-right">

                    <span class="font-weight-bold"> <?php echo $QtdAmount; ?> </span>
                    <span class="text-muted">Total Quantidade Produtos Comprado</span>

                  </p>
                </div>

                <!-- /.d-flex -->
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard3.js"></script>
</body>
</html>
