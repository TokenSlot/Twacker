<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Twacker</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<?php
    include('session.php');
    include('database.php');

    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        echo "<script>location.href='index.php'</script>";
    }
?>

<body >

    <div class="container-fluid fill">

        <div class="row d-flex flex-row fill">
        <div class="col-lg order-lg-2 cn fill bg-home">
                <div class="inner text-center">
                    <p class="text-white text-monospace font-weight-bold">Welcome to Twacker</p>
                    <div>
                        <a href="#login" id="show-login" class="btn btn-outline-primary mb-2 px-3"> Login </a>
                        <a href="#register" id="show-register" class="btn btn-primary mb-2"> Register </a>
                    </div>
                </div>
            </div>
            <div class="col-lg order-lg-1 bg-log">
                <div id="login-page" class="d-none mb-3">
                    <?php include("login.php"); ?>
                </div>
            </div>
            <div class="col-lg order-lg-3 bg-reg">
                <div id="register-page" class="d-none mb-3">
                    <?php include("register.php"); ?>
                </div>
            </div>
        </div>
    </div>

    <?php
        include('scripts.php');
    ?>
</body>
</html>