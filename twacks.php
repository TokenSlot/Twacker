<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include('database.php');

    $twacks = "SELECT twack_tbl.*,user_tbl.id,user_tbl.username user FROM twack_tbl INNER JOIN user_tbl ON twack_tbl.author=user_tbl.id WHERE twack_link IS NULL ORDER BY date_post DESC";
    $result = $conn->query($twacks);
    if ($result->num_rows==0):
?>
    <p class="text-center text-muted">No Results</p>
<?php
    else:
        while($row = $result->fetch_assoc()):

            $timestamp = new DateTime($row['date_post']);
            $now = new DateTime();
            $what = date_diff($timestamp, $now);
            $output = "";
            if ($what->y > 0 || $what->m > 0 || $what->d > 0) {
                $output = $timestamp->format('h:i A | D, d M Y');
            } else if ($what->y == 0 && $what->m == 0 && $what->d == 0 && $what->h > 0) {
                $p = $what->h == 1 ? "hour" : "hours";
                $output = $what->format("%h $p ago");
            } else if ($what->y == 0 && $what->m == 0 && $what->d == 0 && $what->h == 0 && $what->i > 1) {
                $output = $what->format("%i minutes ago");
            } else if ($what->y == 0 && $what->m == 0 && $what->d == 0 && $what->h == 0 && $what->i <= 1) {
                $output = "Just now";
            }
?>
        <div class='card border-secondary rounded-lg mb-3' >
            <div class="card-body pt-3 pr-3 pl-3 pb-0">
                <h3 class="card-title mb-0"> <a class="twack-deco" href="profile.php?username=<?=$row['user']?>"> <?=$row['user']?> </a> </h3>
                <small class='text-muted'><?= $output; ?></small>
                <p id="p-text-<?=$row['twack_id']?>" class='card-text mt-3'> <?=htmlentities($row['twack'])?> </p>
                <?php if ($row['content'] != null): ?>
                    <img class="twack-img rounded d-block mx-auto mb-1" src="<?=htmlentities($row['content'])?>" alt="<?=htmlentities($row['twack'])?>">
                <?php endif; ?>
                <ul class="list-inline mb-2 border-top pt-1">
                    <li class="vote-slot-<?=$row['twack_id']?> list-inline-item">
                        <ul id="votes-<?=$row['twack_id']?>" class="list-unstyled list-inline">
                            <?php include('votes.php') ?>
                        </ul>
                    </li>
                    <li class="list-inline-item border-left pl-3">
                        <a href="comments.php?twack_id=<?=$row['twack_id']?>" class="btn btn-link m-0 p-0 text-secondary twack-deco"><i class="fas fa-comment"></i> comment </a>
                    </li>
                    <?php if ($row['author'] == $_SESSION['id']): ?>
                    <div class="d-none d-md-inline">
                        <li class="list-inline-item border-left pl-3">
                            <a id="<?=$row['twack_id']?>" onclick="show_edit_modal('<?=$row['twack_id']?>')" class="btn btn-link m-0 p-0 text-secondary twack-deco" data-toggle="modal" data-target="#editTwackModal">
                                <i class="fa fa-edit"></i> edit
                            </a>
                        </li>
                        <li class="list-inline-item border-left pl-3">
                            <a onclick="delete_twack(<?=$row['twack_id']?>)" class="btn btn-link m-0 p-0 text-secondary twack-deco">
                                <i class="fa fa-trash"></i> delete
                            </a>
                        </li>
                    </div>
                    <div class="d-md-none d-inline">
                        <li class="list-inline-item">
                            <div class="dropdown">
                                <button class="btn btn-link text-secondary twack-deco dropdown-toggle p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                <div class="dropdown-menu">
                                    <a id="<?=$row['twack_id']?>"onclick="show_edit_modal('<?=$row['twack_id']?>')" class="dropdown-item text-secondary twack-deco" data-toggle="modal" data-target="#editTwackModal">edit</a>
                                    <button onclick="delete_twack(<?=$row['twack_id']?>)" class="dropdown-item btn btn-link text-secondary twack-deco">
                                        delete
                                    </button>
                                </div>
                            </div>
                        </li>
                    </div>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="modal fade" id="editTwackModal" tabindex="-1" role="dialog" aria-labelledby="editTwackModalLabel" aria-hidden="true"class="modal fade" id="createTwackModal" tabindex="-1" role="dialog" aria-labelledby="createTwackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTwackModalLabel">Edit Twack</h5>
                </div>
                <div class="modal-body">
                    <textarea name="twack-text-edit" class="p-2" id="edit-twackarea" placeholder="What's on your mind?" required></textarea>
                    <input onclick="edit_twack(<?=$row['twack_id']?>)" name="twack-edit" class="btn btn-primary btn-block" id="twackEditbtn" type="button" value="EDIT">
                </div>
            </div>
        </div>
    </div>
<?php
        endwhile;
    endif;
?>

