<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include('database.php');

    $sql = "SELECT content FROM twack_tbl WHERE twack_id=".$_GET['id'];
    $result = $conn->query($sql) or die($conn->error);
    while ($row = $result->fetch_assoc()) {
        if ($row['content'] != null) {
            unlink($row['content']);
        }
    }

    $sql = "DELETE FROM twack_tbl WHERE twack_id=".$_GET['id'];
    $qry = $conn->query($sql);
?>