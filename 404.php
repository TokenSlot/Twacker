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
        echo '<script>location.href="index.php"</script>';
    }
?>

<body>
    <div class="error p-5 mb-3 text-center bg-primary">
        <h1 class="text-white">ERROR: 404 User not found.</h1>
    </div>
    <div class="container text-center">
        <i class="far fa-frown fa-10x mb-2"></i>
        <h2 class="mb-0">AWIT</h2>
        <p class="text-muted">
            <?php echo "$profile_owner" ?> not found
        </p>
        <a href="index.php" class="btn btn-primary">Go back to home</a>
    </div>



</body>

<?php
    include('scripts.php');
?>

</html>