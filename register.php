
<?php
    include('database.php');

    if (isset($_POST['register'])) {
        $uname = htmlentities($_POST['uname']);
        $find = "SELECT * FROM user_tbl WHERE username='$uname'";
        $result = $conn->query($find);
        $count = $result->num_rows;
        if ($count > 0) {
            echo "User already exists.";
        } else if ($count == 0) {
            $pword = hash('md5',$_POST['pword']);
            $email = htmlentities($_POST['email']);
            $fname = htmlentities($_POST['fname']);
            $lname = htmlentities($_POST['lname']);
            $dp = "default.jpg";

            $register = "INSERT INTO user_tbl (username, passcode, email, first_name, last_name, display_photo)
                        VALUES ('$uname', '$pword', '$email', '$fname', '$lname', '$dp')";
            $registered = $conn->query($register);
            if (!$registered) {
                echo "<script>alert('Register Failed '".$conn->error.")</script>";
            } else {
                echo "<script>alert('Successfully Registered')</script>";
                $find = "SELECT * FROM user_tbl WHERE username='$uname' AND passcode='$pword'";
                $result = $conn->query($find);
                while($row = $result->fetch_assoc()) {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row["username"];
                }
                echo "<script>location.href='index.php'</script>";
            }
        }
    }

?>

    <div id="register" class="container">
        <div class="mt-5 box">
            <form class="needs-validation" method="post" novalidate>
                <h3 class="text-center">Register</h3>
                <input type="text" class="top form-control" placeholder="Username" name="uname" required>
                <input type="password" class="middle form-control" placeholder="Password" name="pword" required>
                <input type="email" class="middle form-control" placeholder="Email" name="email" required>
                <input type="text" class="middle form-control" placeholder="First Name" name="fname" required>
                <input type="text" class="bottom form-control" placeholder="Last Name" name="lname" required>
                <input type="submit" class="btn btn-success btn-block" value="Register" name="register">
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