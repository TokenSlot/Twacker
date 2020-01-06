<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include('database.php');
    $twack = $_GET['twack'];
    $id = $_GET['id'];
    $sql = "UPDATE `twack_tbl` SET `twack`='$twack' WHERE twack_id=$id";
    $qry = $conn->query($sql);
?>