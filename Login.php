<?php
session_start();

if (isset($_POST['login'])) {
    include("server/connection/conn.php");
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, sha1(md5($_POST['password'])));

    $sql = "SELECT * FROM `userdata` WHERE `email` = '$email' AND `password` = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['ID'] = $row['ID'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['PASSWORD'] = $row['password'];
        $_SESSION['Firstname'] = $row['Firstname'];
        $_SESSION['Lastname'] = $row['Lastname'];

        $last_login = date("Y-m-d h:i:s", time());
        $update = "UPDATE `USERDATA` SET `lasted_login` = '$last_login'";
        $result = mysqli_query($conn, $update);

        $_SESSION['lasted_login'] = $last_login;

        header("Location: main/dashboard.php");
    } else {
        //header("Location: ../Login.php");
        $err = "Email or Password was Wrong";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="dist/image/ico.ico" sizes="16x16">
    <link rel="stylesheet" href="dist/vendor/bootstrap-show-password-toggle/css/show-password-toggle.min.css">
    <?php if (isset($success)) { ?>
        <script type="text/javascript">
            setTimeout(function() {
                    swal("Success", "<?php echo $success; ?>", "success");
                },
                100);
        </script>

    <?php } ?>

    <?php if (isset($err)) { ?>
        <script type="text/javascript">
            setTimeout(function() {
                    swal("Failed", "<?php echo $err; ?>", "error");
                },
                100);
        </script>

    <?php } ?>
</head>

<body class="login-page">
    <div class="vh-100 d-flex align-items-center py-5 bg-dark">
        <div class="container w-50">
            <div class="col-md-9 col-lg-8 mx-auto">
                <h1 class="login-heading mb-4 fw-bold text-center text-white">Welcome to <span class="text-info">MMS</span></h1>
                <form method="post" class="needs-validation" novalidate>
                    <div class="form-floating mb-3 has-validation">
                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email" required>
                        <label for="floatingInput">Email address</label>
                        <div class="invalid-feedback">
                            <span class="text-danger fw-bold p-1">Please enter your Email.</span>
                        </div>
                    </div>
                    <div class="form-floating mb-3 input-group has-validation">
                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" autocapitalize="off" autocomplete="off" spellcheck="false" autocorrect="off" required>
                        <label for="floatingPassword">Password</label>
                        <div class="invalid-feedback">
                            <span class="text-danger fw-bold p-1">Please enter your Password.</span>
                        </div>
                        <button id="toggle-password" type="button" class="d-none" aria-label="Show password as plain text. Warning: this will display your password on the screen.">
                        </button>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-lg btn-secondary btn-login text-uppercase fw-bold mb-2" type="submit" name="login">Sign in</button>
                        <a href="test.php" class="btn btn-lg text-uppercase btn-primary">test page</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php echo sha1(md5("123")); ?>
    <script type="text/javascript">
        (function() {
            'use strict'
            var forms = document.querySelectorAll(".needs-validation");
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
    <script>
        console.log("<?php echo sha1(md5("123")); ?>");
    </script>
    <script src="dist/vendor/swal.js"></script>
    <script src="dist/vendor/bootstrap-show-password-toggle/js/show-password-toggle.min.js"></script>
</body>

</html>