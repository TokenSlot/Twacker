<script src="js/jquery.js"></script>

<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include('database.php');
    if (isset($_POST["twack_id"]))  {
        $twackID = $_POST["twack_id"];
    } else {
        $twackID = $row['twack_id'];
    }

    $get_vote_count = "SELECT vote_count FROM votes_tbl WHERE twack_id='$twackID'";
    $qry = $conn->query($get_vote_count);
    $allVotes = 0;
    while($tally = $qry->fetch_assoc()) {
        $allVotes += $tally['vote_count'];
    }

    $session_vote = "SELECT vote_id, vote_count FROM votes_tbl WHERE user_id=".$_SESSION['id']." AND twack_id='$twackID'";
    $sv_results = $conn->query($session_vote);
    while($sv_result = $sv_results->fetch_assoc()):
        if ($sv_result['vote_count'] == 1):
?>
    <script>
        $(document).ready(function() {
            $("#vote-up-<?=$twackID?>").toggleClass("text-secondary");
            $("#vote-up-<?=$twackID?>").toggleClass("text-success");
            $("#vote-text-<?=$twackID?>").toggleClass("text-secondary");
            $("#vote-text-<?=$twackID?>").toggleClass("text-success");
            $("#vote-text-<?=$twackID?>").toggleClass("text-danger", false);
            $("#vote-down-<?=$twackID?>").toggleClass("text-secondary", true);
            $("#vote-down-<?=$twackID?>").toggleClass("text-danger", false);
        });
    </script>
<?php
        elseif ($sv_result['vote_count'] == -1):
?>
    <script>
        $(document).ready(function() {
            $("#vote-up-<?=$twackID?>").toggleClass("text-secondary", true);
            $("#vote-up-<?=$twackID?>").toggleClass("text-success", false);
            $("#vote-text-<?=$twackID?>").toggleClass("text-secondary");
            $("#vote-text-<?=$twackID?>").toggleClass("text-success", false);
            $("#vote-text-<?=$twackID?>").toggleClass("text-danger");
            $("#vote-down-<?=$twackID?>").toggleClass("text-secondary");
            $("#vote-down-<?=$twackID?>").toggleClass("text-danger");
        });
    </script>
<?php
        endif;
    endwhile;
?>

<li class="list-inline-item">
    <button id="vote-up-<?=$twackID?>" onclick="vote(<?=$twackID?>,1)" class="vote btn btn-link p-0 text-secondary text-decoration-none">
        <i class="fas fa-angle-up fa-lg"></i>
    </button>
</li>
<li class="list-inline-item"> <p id="vote-text-<?=$twackID?>" class="text-secondary d-block m-0"><?=$allVotes?></p> </li>
<li class="list-inline-item">
    <button id="vote-down-<?=$twackID?>" onclick="vote(<?=$twackID?>,-1)" class="vote btn btn-link p-0 text-secondary text-decoration-none">
        <i class="fas fa-angle-down fa-lg"></i>
    </button>
</li>