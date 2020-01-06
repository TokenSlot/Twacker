<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Twacker</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<?php
    include('session.php');
    include('database.php');

    if (isset($_GET['username'])) {
        $profile_owner = $_GET['username'];
    } else {
        $profile_owner = $_SESSION['username'];
        echo '<script>location.href="profile.php?username='.$profile_owner.'"</script>';
    }

    $qry = "SELECT display_photo,cover,bio FROM user_tbl WHERE username='$profile_owner'";
    $result = $conn->query($qry);
    if ($result->num_rows == 0):
        echo '<script>location.href="404.php?username='.$profile_owner.'"</script>';
    else:
        while ($row = $result->fetch_assoc()):
            $dp = $row['display_photo'];
?>
<body>
    <?php
        include('header.php');
    ?>
    <div class="container">
        <div class="cover-box">
            d
        </div>
        <a class="profile-box" href="#">
            <div class="img-wrap">
                <img src="uploads/profile/<?= $dp ?>" alt="<?= $profile_owner ?>">
            </div>
            <h4>Upload New</h4>
        </a>
        <h1><?= $profile_owner ?></h1>
    </div>

    <?php
            endwhile;
        endif;
    ?>

</body>

<?php
    include('scripts.php');
?>

</html>