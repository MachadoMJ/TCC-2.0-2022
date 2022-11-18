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
    { $TpUser = 'Administrador'; 
      $home   = 'index.php';
      $html1  = '<li class="nav-item"><a href="./profile-adm.php" class="nav-link"><i class="nav-icon far fa-plus-square"></i><p> Gerenciar Usuarios </p></a></li>';          
      $html2  = '<li class="nav-header">Armazem</li><li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon far fa-plus-square"></i><p> Gerenciar produtos <i class="fas fa-angle-left right"></i></p></a><ul class="nav nav-treeview"><li class="nav-item"><a href="../../Category.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Categorias</p></a></li><li class="nav-item"><a href="../../products.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Produtos</p></a></li></ul></li>';

    //Table Log  
      $sql = "SELECT * FROM VW_log_hist";
      $stmt = sqlsrv_query($conn, $sql);

    }

  elseif  ( $_SESSION['TpUser'] == 'V' ) 
    { $TpUser = 'Vendedor';
      $home   = 'index.php'; 
      $html1  = '';
      $html2  = '<li class="nav-header">Armazem</li><li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon far fa-plus-square"></i><p> Gerenciar produtos <i class="fas fa-angle-left right"></i></p></a><ul class="nav nav-treeview"><li class="nav-item"><a href="../../Category.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Categorias</p></a></li><li class="nav-item"><a href="../../products.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Produtos</p></a></li></ul></li>';

    //Table Log  
      $sql = "SELECT * FROM VW_log_hist where client = $_SESSION[IdUser]";
      $stmt = sqlsrv_query($conn, $sql);
    } 

  else 
    { $TpUser = 'Usuario'; 
      $home   = 'index3.php'; 
      $html1  = '';
      $html2  = '';

    //Table Log  
      $sql = "SELECT * FROM VW_log_hist where client = $_SESSION[IdUser]";
      $stmt = sqlsrv_query($conn, $sql);
    }
    

//Logout  
  if(isset($_POST['SubLogout'])){
    header ('location: ../../../index.php' );
    session_destroy();
  };
      
//Atualizar Usuario
  if(isset($_POST['UpSub'])){

    $name = $_POST['UpName'];
    $user = $_POST['UpUser'];
    $pass = $_POST['UpPass'];


    if( $_FILES['UpIMG']['name'] ){//Verificando se tem imagem
      if ( substr($_FILES['UpIMG']['type'],0,5) == 'image' ) {//Verificando se o tipo do arquivo é uma imagem
        
        $_FILES['UpIMG']['name'] = $user . '.' . substr($_FILES['UpIMG']['type'],6,null); //renomenado o arquivo

        move_uploaded_file($_FILES['UpIMG']['tmp_name'], "../../../image/user/".$_FILES['UpIMG']['name']);
        $img="image/user/".$_FILES['UpIMG']['name'];


        //atualizar usuario
        $sqlU = " update client
                    set Name	= '$name',
                        Login	= '$user',
                        Pass	= '$pass',
                        Img		= '$img' ,
                        Type	= '$_SESSION[TpUser]'
                    where Id = $_SESSION[IdUser]";

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

//Deletar User
  if(isset($_POST['DelSub'])){
    if ( $_SESSION['TpUser'] == 'A') {

      echo 'USUARIO ADM NÃO PODE SER DELETADO';
    }else {

      $sql = "exec PRC_Delete_user $_SESSION[IdUser]";
      $stmt = sqlsrv_query($conn, $sql);
      if( $stmt === false) { echo 'falha ao cadastrar usuario'; }
  
      $sqlL ="insert into log.tmp_log (Client,action, calendar)
              values ($_SESSION[IdUser], 'Delete user [$user]', 'Client')";
      
      $stmt = sqlsrv_query($conn, $sqlL);
      if( $stmt === false) { echo 'falha ao cadastrar usuario'; }
  
      header ('location: ../../../index.php' );
   
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
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <link rel="icon" href="../../../image/icon.png">
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
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../<?php echo $home; ?>" class="brand-link">
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

            <?php echo $html2; ?>

            <li class="nav-header">Configuração</li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>
                    Profile
                  </p>
                </a>
              </li>

            <?php echo $html1; ?>

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
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../<?php echo $home; ?>">Home</a></li>
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
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../../../<?php echo $img; ?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $name; ?></h3>
                <p class="text-muted text-center"><?php echo $TpUser; ?></p>

                <form method="post">
                  <button type="submit" class="btn btn-primary btn-block btn-danger" name="SubLogout">Sair</button>
                </form>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">

            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">

                  <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link" href="#Update" data-toggle="tab">Atualizar</a></li>
                  <li class="nav-item"><a class="nav-link" href="#Delete" data-toggle="tab">Deletar</a></li>

                </ul>
              </div><!-- /.card-header -->

              
              <div class="card-body">
                <div class="tab-content">

                  
                  <!-- /.tab-pane -->
                  <div class="active tab-pane" id="timeline">
                    <!-- The timeline -->
                    
                      <table id="example1" class="table table-striped projects" style="width: 100%" > <!-- myTABLE -->
                        
                        <thead>

                            <tr><!--class="text-center"-->
                                <th style="width: 1%" >                     #           </th>
                                <th style="width: 15%">                     Id Usuario  </th>
                                <th style="width: 15%">                     Ação Login  </th>
                                <th style="width: 15%">                     Data Ação   </th>
                            </tr>

                        </thead>
                        <tbody>

                            <?php while ( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {?>
                            <tr>
                                <td>#                       </td>
                                <td> <?php echo $row[0]; ?> </td>
                                <td> <?php echo $row[1]; ?> </td>
                                <td> <?php echo $row[2]; ?> </td>
                                
                            </tr>
                            <?php } ?>

                        </tbody>
                    </table>

                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="Update">
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="Name" id="UpName" name="UpName">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Login</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="Login" id="UpUser" name="UpUser">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Senha</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="Senha" id="UpPass" name="UpPass">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="InputFile" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">

                          <div class="custom-file" id="InputFile">
                            <input type="file" class="form-control" id="UpIMG" name="UpIMG">
                            <label class="custom-file-label" for="UpIMG">Foto</label>
                          </div>

                        </div>
                      </div>
                      

                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          
                            <button type="submit" class="btn btn-danger" name="UpSub">Submit</button><!-- update -->
                          
                        </div>
                      </div>

                    </form>
                  </div>
                  <!-- /.tab-pane -->

                  
                  <div class="tab-pane" id="Delete">
                    <form method="post">
                      <button type="submit" class="btn btn-danger" name="DelSub">Submit</button><!-- delete -->
                    </form>
                  </div>
                  <!-- /.tab-pane -->

                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
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
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
