<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include('database.php');

    if(isset($_POST["twack"])) {
        $twack_author = $_SESSION['id'];
        $twack_text = $_POST['twack'];
        $twack_content = null;
        $twack_link = $_POST['twack_id'];
        if (isset($_POST["filename"])) {
            $twack_content = $_POST["filename"];
        }
        $twack = "INSERT INTO twack_tbl (author, twack, content, twack_link) VALUES ('$twack_author', '$twack_text', '$twack_content', '$twack_link')";
        $twacked = $conn->query($twack);
    }

?>