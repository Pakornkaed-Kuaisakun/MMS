<?php
session_start();
include('../server/connection/conn.php');
include('../server/connection/checkLogin.php');
check_login();

$ID = $_SESSION['ID'];
$head = "Account";

$user = "SELECT * FROM `userdata` WHERE `ID` = '$ID'";
$result = mysqli_query($conn, $user);
$row = mysqli_fetch_assoc($result);

$name = $row['Firstname'] . " " . $row['Lastname'];

if (!isset($_SESSION['_password_'])) {
    $precess_otp = false;
} else {
    $precess_otp = true;
}

if (isset($_GET['err'])) {
    $err = $_GET['err'];
}
if (isset($_GET['success'])) {
    $success = $_GET['success'];
}
//update profile
if (isset($_POST['update_profile'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $update = "UPDATE `userdata` SET `Firstname` = '$firstname', `Lastname` = '$lastname', `email` = '$email' WHERE `ID` = '$ID'";
    $result = mysqli_query($conn, $update);
    if ($result) {
        $_SESSION['Firstname'] = $firstname;
        $_SESSION['Lastname'] = $lastname;
        $success = 'Account Updated';
        header("Location: Refresh: 2");
    } else {
        $err = 'Please try again or Try later';
    }
}
//change password
if (isset($_POST['change_password'])) {
    $_password_ = $_SESSION['_password_'];
    $otp = mysqli_real_escape_string($conn, $_POST["OTP-f1"]) . mysqli_real_escape_string($conn, $_POST["OTP-f2"]) . mysqli_real_escape_string($conn, $_POST["OTP-f3"]) . mysqli_real_escape_string($conn, $_POST["OTP-f4"]) . mysqli_real_escape_string($conn, $_POST["OTP-f5"]) . mysqli_real_escape_string($conn, $_POST["OTP-f6"]);
    $time = $_SERVER['REQUEST_TIME'];
    if (($time - $_SESSION['expired']) < 180) {
        if ($otp == $row['OTP']) {
            $update = "UPDATE `userdata` SET `password` = '$_password_', `OTP` = '' WHERE `ID` = '$ID'";
            $result = mysqli_query($conn, $update);
            unset($_SESSION['_password_']);
            unset($_SESSION['expired']);

            if ($result) {
                $success = "Password Updated";
                header("Location: account.php?success=Password Updated");
            } else {
                $err = "Something went Wrong";
            }
        } else {
            $err = "OTP is Wrong";
        }
    } else {
        $update = "UPDATE `userdata` SET `OTP` = '' WHERE `ID` = '$ID'";
        $result = mysqli_query($conn, $update);

        unset($_SESSION['_password_']);

        $err = "OTP was expired";
    }
}

if (isset($_POST['reset'])) {
    $update = "UPDATE `userdata` SET `OTP` = '' WHERE `ID` = '$ID'";
    $result = mysqli_query($conn, $update);
    unset($_SESSION['_password_']);
    unset($_SESSION['expired']);
}


if ($precess_otp) {
    $profile = '';
    $change_password = 'active';
} else {
    $profile = 'active';
    $change_password = '';
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include('dist/_partials/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <?php include('dist/_partials/navbar.php'); ?>
        <?php include('dist/_partials/sidebar.php'); ?>
        <div class="content-wrapper" id="isOnlinePage">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>
                                <?php echo $name; ?> Profile
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="account.php">Profile</a></li>
                                <li class="breadcrumb-item active">
                                    <?php echo $name; ?>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-purple card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <button type="button" class="btn profile-box-img p-0">
                                            <img src="dist/img/user-profile-min.png" alt="Profile Image"
                                                class="img-fluid profile-img" style="background-position: cover;">
                                            <div class="profile-img-overlay rounded-circle">
                                                <i class="fas fa-images profile-icon-hover"></i>
                                            </div>
                                            <style>
                                                .profile-box-img {
                                                    position: relative;
                                                }

                                                .profile-box-img .profile-img {
                                                    display: block;
                                                    width: 100%;
                                                    height: auto;
                                                }

                                                .profile-box-img .profile-img-overlay {
                                                    position: absolute;
                                                    top: 0;
                                                    bottom: 0;
                                                    left: 0;
                                                    right: 0;
                                                    opacity: 0;
                                                    transition: .3s ease;
                                                    background-color: white;
                                                    cursor: pointer;
                                                }

                                                .profile-box-img:hover .profile-img-overlay {
                                                    opacity: .7;
                                                }

                                                .profile-img-overlay .profile-icon-hover {
                                                    color: #007bff;
                                                    font-size: 70px;
                                                    position: absolute;
                                                    top: 50%;
                                                    left: 50%;
                                                    transform: translate(-50%, -50%);
                                                    -ms-transform: translate(-50%, -50%);
                                                    text-align: center;
                                                }
                                            </style>
                                        </button>
                                        <button type="button" class="btn rounded btn-outline-primary mt-3">Choose
                                            Profile
                                            Image</button>
                                    </div>
                                    <h3 class="profile-username text-center mt-3">
                                        <?php echo $name; ?>
                                    </h3>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Email: </b> <a class="float-right">
                                                <?php echo $row['email']; ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link <?php echo $profile; ?>"
                                                href="#update_Profile" data-toggle="tab">Update Profile</a></li>
                                        <li class="nav-item"><a class="nav-link <?php echo $change_password; ?>"
                                                href="#Change_Password" data-toggle="tab">Change Password</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane <?php echo $profile; ?>" id="update_Profile">
                                            <form method="post" class="form-horizontal needs-validation" novalidate>
                                                <div class="form-group row">
                                                    <label for="inputFirstName"
                                                        class="col-sm-2 col-form-label">Firstname</label>
                                                    <div class="col-sm-10 has-validation">
                                                        <input type="text" name="firstname" required
                                                            class="form-control"
                                                            value="<?php echo $row['Firstname']; ?>" id="inputFirstName"
                                                            autocomplete="off" spellcheck="false" autocorrect="off"
                                                            autocapitalize="true" placeholder="Firstname">
                                                        <div class="invalid-feedback">
                                                            <span class="text-danger fw-bold p-1">Please enter your
                                                                Firstname.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputLastName"
                                                        class="col-sm-2 col-form-label">Lastname</label>
                                                    <div class="col-sm-10 has-validation">
                                                        <input type="text" name="lastname" required class="form-control"
                                                            value="<?php echo $row['Lastname']; ?>" id="inputLastName"
                                                            autocomplete="off" spellcheck="false" autocorrect="off"
                                                            autocapitalize="true" placeholder="Lastname">
                                                        <div class="invalid-feedback">
                                                            <span class="text-danger fw-bold p-1">Please enter your
                                                                Lastname.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail"
                                                        class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10 has-validation">
                                                        <input type="text" name="email" required class="form-control"
                                                            value="<?php echo $row['email']; ?>" id="inputEmail"
                                                            autocomplete="off" spellcheck="false" autocorrect="off"
                                                            placeholder="Email">
                                                        <div class="invalid-feedback">
                                                            <span class="text-danger fw-bold p-1">Please enter your
                                                                Email.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group row flex-column align-content-center justify-content-center">
                                                    <span class="text-center font-weight-bold">Select your
                                                        profile</span>
                                                    <dragdroparea>
                                                        <label for="inputImg" id="drop-area">
                                                            <input type="file" name="profileImg" id="inputImg"
                                                                accept="image/*" hidden>
                                                            <div id="imgView" style="">
                                                                <img src="dist/img/upload.png" alt="Upload Icon">
                                                                <div>
                                                                    <p>Drag and Drop or click here <br> to upload image
                                                                    </p>
                                                                    <span>Upload any image from desktop</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <style scoped="dragdroparea">
                                                            #drop-area {
                                                                width: 500px;
                                                                height: 300px;
                                                                padding: 10px;
                                                                text-align: center;
                                                                border-radius: 20px;
                                                            }

                                                            #imgView {
                                                                width: 100%;
                                                                height: 100%;
                                                                border-radius: 20px;
                                                                border: 2px dashed #bbb5ff;
                                                                background: #f7f8ff;
                                                                padding: 30px;
                                                                background-position: center;
                                                                background-size: cover;
                                                                cursor: pointer;
                                                            }

                                                            #imgView img {
                                                                width: 100px;
                                                                height: 100px;
                                                                margin-right: 10px;
                                                            }

                                                            #imgView span {
                                                                display: block;
                                                                font-size: 12px;
                                                                color: #777;
                                                            }
                                                        </style>
                                                    </dragdroparea>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <button name="update_profile" type="submit"
                                                            class="btn btn-outline-success">Update Account</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane <?php echo $change_password; ?>" id="Change_Password">
                                            <?php if (!$precess_otp) { ?>
                                                <form action="../server/function/sendMailOTP.php" method="post"
                                                    class="form-horizontal needs-validation" novalidate>
                                                    <input type="hidden" name="OTP-email"
                                                        value="<?php echo $_SESSION['email']; ?>">
                                                    <input type="hidden" name="OTP-name"
                                                        value="<?php echo $_SESSION['Firstname'] . " " . $_SESSION['Lastname']; ?>">
                                                    <div class="form-group row">
                                                        <label for="inputCurrentPassword"
                                                            class="col-sm-2 col-form-label">Current Password</label>
                                                        <div class="col-sm-10 input-group has-validation">
                                                            <input type="text" name="currentPassword" class="form-control"
                                                                id="inputCurrentPassword" autocapitalize="off"
                                                                autocomplete="off" spellcheck="false" autocorrect="off"
                                                                placeholder="Current Password" required>
                                                            </button>
                                                            <div class="invalid-feedback">
                                                                <span class="text-danger fw-bold p-1">Please enter your
                                                                    current Password.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputNewPassword" class="col-sm-2 col-form-label">New
                                                            Password</label>
                                                        <div class="col-sm-10 input-group has-validation">
                                                            <input type="text" name="newPassword" class="form-control"
                                                                id="inputNewPassword" autocapitalize="off"
                                                                autocomplete="off" spellcheck="false" autocorrect="off"
                                                                placeholder="New Password" required>
                                                            <div class="invalid-feedback">
                                                                <span class="text-dager fw-bold p-1">Please enter your new
                                                                    Password.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputConfirmPassword"
                                                            class="col-sm-2 col-form-label">New Password</label>
                                                        <div class="col-sm-10 input-group has-validation">
                                                            <input type="text" name="confirmPassword" class="form-control"
                                                                id="inputConfirmPassword" autocapitalize="off"
                                                                autocomplete="off" spellcheck="false" autocorrect="off"
                                                                placeholder="Confirm Password" required>
                                                            <div class="invalid-feedback">
                                                                <span class="text-dager fw-bold p-1">Please enter your
                                                                    confirm Password.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="offset-sm-2 col-sm-10">
                                                            <button type="submit" name="confirm_OTP"
                                                                class="btn btn-outline-success">Change Password</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            <?php } else { ?>
                                                <div class="d-flex">
                                                    <form method="post" class="col-sm-10 form-horizontal needs-validation"
                                                        novalidate>
                                                        <div class="form-group row">
                                                            <label for="inputOTP" class="col-sm-2 col-form-label">OTP
                                                            </label>
                                                            <div class="col-sm-7 input-group has-validation">
                                                                <div class="inputfield" id="InputField">
                                                                    <input type="text" inputmode="numberic" id="inputOTP"
                                                                        maxlength="1" class="OTP-input" name="OTP-f1"
                                                                        autocapitalize="off" autocomplete="off"
                                                                        autocorrect="off" spellcheck="false" required />
                                                                    <input type="text" inputmode="numberic" id="inputOTP"
                                                                        maxlength="1" class="OTP-input" name="OTP-f2"
                                                                        autocapitalize="off" autocomplete="off"
                                                                        autocorrect="off" spellcheck="false" required />
                                                                    <input type="text" inputmode="numberic" id="inputOTP"
                                                                        maxlength="1" class="OTP-input" name="OTP-f3"
                                                                        autocapitalize="off" autocomplete="off"
                                                                        autocorrect="off" spellcheck="false" required />
                                                                    <input type="text" inputmode="numberic" id="inputOTP"
                                                                        maxlength="1" class="OTP-input" name="OTP-f4"
                                                                        autocapitalize="off" autocomplete="off"
                                                                        autocorrect="off" spellcheck="false" required />
                                                                    <input type="text" inputmode="numberic" id="inputOTP"
                                                                        maxlength="1" class="OTP-input" name="OTP-f5"
                                                                        autocapitalize="off" autocomplete="off"
                                                                        autocorrect="off" spellcheck="false" required />
                                                                    <input type="text" inputmode="numberic" id="inputOTP"
                                                                        maxlength="1" class="OTP-input" name="OTP-f6"
                                                                        autocapitalize="off" autocomplete="off"
                                                                        autocorrect="off" spellcheck="false" required />
                                                                    <style>
                                                                        .inputfield {
                                                                            width: 100%;
                                                                            display: flex;
                                                                            justify-content: space-around;
                                                                        }

                                                                        .OTP-input {
                                                                            height: 2em;
                                                                            width: 2em;
                                                                            border: 2px solid #dad9df;
                                                                            outline: none;
                                                                            text-align: center;
                                                                            font-size: 1.5em;
                                                                            border-radius: 0.3em;
                                                                            background-color: #ffffff;
                                                                            outline: none;
                                                                            /*Hide number field arrows*/
                                                                            -moz-appearance: textfield;
                                                                        }

                                                                        input[type="number"]::-webkit-outer-spin-button,
                                                                        input[type="number"]::-webkit-inner-spin-button {
                                                                            -webkit-appearance: none;
                                                                            margin: 0;
                                                                        }
                                                                    </style>
                                                                </div>
                                                                <div class="invalid-feedback">
                                                                    <span class="text-dager fw-bold p-1">Please enter your
                                                                        OTP</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="offset-sm-2 col-sm-10 d-flex align-items-center">
                                                                <button type="submit" name="change_password"
                                                                    class="btn btn-outline-success">Confirm</button>
                                                                <a href="dist/function/cancle_otp.php"
                                                                    class="btn btn-outline-danger ml-2">Cancle</a>
                                                                <span class="ml-3 font-weight-bold" id="expired-otp"
                                                                    style="font-size: 16px;">Loading..
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <form action="../server/function/sendMailOTP.php" method="post">
                                                        <input type="hidden" name="OTP-email"
                                                            value="<?php echo $row['email']; ?>">
                                                        <button type="submit" class="btn btn-warning ml-2" name="Re-OTP"
                                                            id="Re-OTP"><i class="fas fa-sync-alt"></i>
                                                            Send Again</button>
                                                    </form>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include("dist/_partials/offline-page.php"); ?>
    </div>
    <script type="text/javascript">
        (function () {
            'use strict'
            var forms = document.querySelectorAll(".needs-validation");
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
    <?php if ($precess_otp && isset($_SESSION['expired'])) { ?>
        <script type="text/javascript">
            var expired_otp = new Date("<?php echo date("M d, Y H:i:s", $_SESSION['expired']); ?>").getTime();

            function checkTime(i) {
                return (i < 10) ? "0" + i : i;
            }

            var x = setInterval(function () {

                let now = new Date().getTime();

                var distance = expired_otp - now;

                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById("expired-otp").innerHTML = checkTime(minutes) + "m " + checkTime(seconds) + "s ";

                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("expired-otp").innerHTML = 'EXPIRED';
                    document.getElementById("expired-otp").classList.add("text-danger");
                }
            }, 1000);
        </script>
        <script type="text/javascript">

        const InputField = document.getElementById("InputField");

        InputField.addEventListener("input", function (e) {
            const target = e.target;
            const val = target.value;

            if (isNaN(val)) {
                target.value = "";
                return;
            }

            if (val != "") {
                const next = target.nextElementSibling;
                if (next) {
                    next.focus();
                }
            }
        });

        InputField.addEventListener("keyup", function (e) {
            const target = e.target;
            const key = e.key.toLowerCase();

            if (key == "backspace" || key == "delete") {
                target.value = "";
                const prev = target.previousElementSibling;
                if (prev) {
                    prev.focus();
                }
                return;
            }
        });
        </script>
    <?php } ?>
    <?php if ($precess_otp && isset($_SESSION['OTP-cooldown'])) { ?>
        <script>
            var OTP_cooldown = new Date("<?php echo date("M d, Y H:i:s", $_SESSION['OTP-cooldown']); ?>").getTime();

            function checkTime(i) {
                return (i < 10) ? "0" + i : i;
            }

            var x = setInterval(function () {
                let now = new Date().getTime();

                var distance = OTP_cooldown - now;

                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById("Re-OTP").innerHTML = checkTime(minutes) + "m " + checkTime(seconds) + "s";
                document.getElementById("Re-OTP").disabled = true;

                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("Re-OTP").innerHTML = '<i class="fas fa-sync-alt"></i> Send Again';
                    document.getElementById("Re-OTP").disabled = false;
                }
            }, 1000);
        </script>
    <?php } ?>
    <?php include('dist/_partials/script.php'); ?>
    <?php include("dist/_partials/footer.php"); ?>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="dist/js/demo.js"></script>
    <script src="dist/js/dragdropImg.js"></script>
</body>

</html>