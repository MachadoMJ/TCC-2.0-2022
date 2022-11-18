<?php
    include 'login.php';

    $id = $_SESSION['id']?? "";

    $sql = "select * from projeto.reg where id = ".$id;
    $stmt = sqlsrv_query($conn, $sql);

    if( sqlsrv_fetch( $stmt ))
    {
        $response = array (
            "nome" => sqlsrv_get_field( $stmt, 1),
            "user" => sqlsrv_get_field( $stmt, 2),
            "pass" => sqlsrv_get_field( $stmt, 3),
            "city" => sqlsrv_get_field( $stmt, 4),
            "imag" => sqlsrv_get_field( $stmt, 5),
            "gend" => sqlsrv_get_field( $stmt, 6),
            "id" => $id,
        );

        echo json_encode($response);
    }

?>