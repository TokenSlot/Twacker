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

    if (isset($_POST['login'])) {
        $uname = $_POST['uname'];
        $pword = hash('md5',$_POST['pword']); 
        $find = "SELECT * FROM user_tbl WHERE username='$uname' AND passcode='$pword'";
        $result = $conn->query($find);
        $count = $result->num_rows;
        if ($count == 0) {
            echo "No User Found.";
        } else if ($count > 0) {
            
            while($row = $result->fetch_assoc()) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row["username"];
            }
            echo '<script>location.href="index.php"</script>';
        }
    }
    
?>


<body>
    
    <div class="mt-5 container">
        <div class="box">
            <form class="needs-validation" method="post" novalidate>
                <input type="text" class="top form-control" placeholder="Username" name="uname" required>
                <input type="password" class="bottom form-control" placeholder="Password" name="pword" required>
                <input type="submit" class="btn btn-success btn-block" value="Login" name="login">
                <small class="text-muted mb-0">Don't have an account? <a href="register.php">Register</a></small>
            </form>
        </div>
    </div>
    

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
            });
        }, false);
        })();
    </script>
    <?php
        include('scripts.php');
    ?>
</body>
</html>