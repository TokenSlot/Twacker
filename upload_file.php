<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $dir = 'uploads/twacks/twack_'. $_SESSION['id'] . time() . mt_rand() . '_' . $_FILES['file']['name'];

    move_uploaded_file($_FILES['file']['tmp_name'], $dir);

    echo $dir;

?>