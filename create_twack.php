<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include('database.php');

    if(isset($_POST["twack"])) {
        $twack_author = $_SESSION['id'];
        $twack_text = $_POST['twack'];
        $twack_content = null;
        if (isset($_POST["filename"])) {
            $twack_content = $_POST["filename"];
        }
        $twack = "INSERT INTO twack_tbl (author, twack, content) VALUES ('$twack_author', '$twack_text', '$twack_content')";
        $twacked = $conn->query($twack);
        echo $conn->insert_id;
    }

?>