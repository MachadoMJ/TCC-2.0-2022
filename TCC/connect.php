<?php
    session_start();

    $connectionInfo = array( "Database"=>"db_AdmLTE", "UID"=>"APP", "PWD"=>"1234567", "CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( "localhost", $connectionInfo);
    if( $conn === false ){
        echo " ⁕⁕⁕ CONNECTION ERROR ⁕⁕⁕ >  ";
        echo die( print_r( sqlsrv_errors(), true));
    }
?>