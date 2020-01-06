<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include('database.php');

    if (isset($_POST['twack_id']) && isset($_POST['vote_count'])) {
        $twack_id = $_POST['twack_id'];
        $vote_count = $_POST['vote_count'];

        $find = "SELECT vote_count FROM votes_tbl WHERE user_id=".$_SESSION['id']." AND twack_id='$twack_id'";
        $result = $conn->query($find);
        if ($result->num_rows > 0) {
            while($results = $result->fetch_assoc()) {
                if ($vote_count == $results['vote_count']) {
                    $unvote = "DELETE FROM votes_tbl WHERE user_id=".$_SESSION['id']." AND twack_id='$twack_id'";
                    $unvoted = $conn->query($unvote);
                } else if ($vote_count != $results['vote_count']) {
                    $vote = "UPDATE votes_tbl SET vote_count='$vote_count' WHERE user_id=".$_SESSION['id']." AND twack_id='$twack_id'";
                    $voted = $conn->query($vote);
                }
            }
        } else {
            $vote = "INSERT INTO votes_tbl (twack_id, user_id, vote_count) VALUES ('$twack_id',".$_SESSION['id'].",'$vote_count')";
            $voted = $conn->query($vote);
        }


    }
?>
