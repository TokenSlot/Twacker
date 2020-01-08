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

    if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {
        echo '<script>location.href="home.php"</script>';
    }
?>

<body>
    <div id="top"></div>
    <?php
        include('header.php');
    ?>
    <div class="container-fluid">
        <button type="button" class="d-md-none d-block btn btn-primary btn-block mt-3 mb-0" data-toggle="modal" data-target="#createTwackModal">CREATE TWACK</button>

        <div class="row align-items-start">
            <div id="side-nav" class="sticky col-md-3 pr-0">
                <button type="button" class="d-none d-md-block btn btn-primary btn-block my-3" data-toggle="modal" data-target="#createTwackModal">CREATE TWACK</button>
            </div>
            <div class="col" style="max-width:800px;">
                <p class="log"></p>
                <div id="twacks">
                    <?php include('twacks.php') ?>
                </div>
            </div>
        </div>


    </div>

    <div class="modal fade" id="createTwackModal" tabindex="-1" role="dialog" aria-labelledby="createTwackModalLabel" aria-hidden="true"class="modal fade" id="createTwackModal" tabindex="-1" role="dialog" aria-labelledby="createTwackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTwackModalLabel">Create Twack</h5>
                </div>
                <div class="modal-body">
                    <form id="twack-form" method="post" enctype="multipart/form-data">
                        <textarea name="twack-text" class="p-2" id="twackarea" placeholder="What's on your mind?" required></textarea>
                        <button type="button" class="img-vid btn btn-light btn-block mb-1">Upload Image/Video</button>
                        <div id="upload-div" class="custom-file mb-1 d-none">
                            <input type="file" name="uploading" class="upload-file custom-file-input" aria-describedby="custom-file-addon">
                            <label class="custom-file-label" for="uploading">Choose file</label>
                        </div>
                        <input name="twack-submit" class="btn btn-primary btn-block" id="twackbtn" type="submit" value="TWACK">
                    </form>
                </div>
            </div>
        </div>
    </div>




</body>

<?php
    include('scripts.php');
?>
</html>