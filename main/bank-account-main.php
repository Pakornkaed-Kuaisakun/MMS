<?php
session_start();
include('../server/connection/conn.php');
include('../server/connection/checkLogin.php');
include('dist/function/array-data.php');
check_login();

$ID = $_SESSION['ID'];
$head = "Bank Account Main";

$bank_main = "SELECT * FROM `bank` WHERE `accID` = '$ID' AND `type` = 'Main'";
$result_main = mysqli_query($conn, $bank_main);


if ($result_main) {
    $row_main = mysqli_fetch_assoc($result_main);
    $bankNameMain = $bankList[$row_main['bankName']];
}

if (isset($_POST['update_bank_main'])) {
    $bankNumber = mysqli_real_escape_string($conn, $_POST['bankNumber']);
    $bankName = $_POST['bankName'];
    $bankOwner = mysqli_real_escape_string($conn, $_POST['bankOwner']);
    $ownerPrefix = $_POST['prefix'];

    $update = "UPDATE `bank` SET `bankName` = '$bankName', `bankNumber` = '$bankNumber', `ownerPrefix` = '$ownerPrefix', `bankOwner` = '$bankOwner' WHERE `accID` = '$ID' AND `type` = 'Main'";
    $result = mysqli_query($conn, $update);

    if ($result) {
        header("Refresh: 1");
        $success = "Account Main Updated";
    } else {
        $err = "Somethings went Wrong";
    }
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
                            <h1>Bank Account Main</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="bank-account-main.php">Bank Account</a></li>
                                <li class="breadcrumb-item active">Account Main</li>
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
                                        <img src="dist/img/bank-logo/<?php echo $row_main['bankName']; ?>.png"
                                            alt="Bank logo Image" class="img-fluid">
                                    </div>
                                    <h3 class="profile-username text-center">
                                        <?php echo $row_main["ownerPrefix"] . " " . $row_main["bankOwner"]; ?>
                                        <div class="badge badge-secondary text-sm">Owner</div>
                                    </h3>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Account Number: </b><a class="float-right">
                                                <?php echo $row_main['bankNumber']; ?>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Bank Name: </b><a class="float-right">
                                                <?php echo $bankNameMain; ?>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Account Type: </b><a class="float-right font-weight-bold text-secondary"
                                                style="pointer-events:none;">
                                                <?php echo $row_main['type']; ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2 ml-3">
                                    <h3 class="font-weight-bold">Account Main</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post" class="form-horizontal needs-validation" novalidate>
                                        <div class="form-group row">
                                            <label for="inputBankNumber" class="col-sm-2 col-form-label">Account
                                                Number</label>
                                            <div class="col-sm-10 has-validation">
                                                <input type="text" name="bankNumber" required
                                                    class="form-control input-bankNumberMain"
                                                    value="<?php echo $row_main['bankNumber']; ?>" id="inputBankNumber"
                                                    autocomplete="off" spellcheck="false" autocorrect="off"
                                                    autocapitalize="true" placeholder="Bank Account Number"
                                                    onkeypress="return checkNumber(event)">
                                                <div class="invalid-feedback">
                                                    <span class="text-danger fw-bold p-1">Please enter your Bank
                                                        account number.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputBankOwner" class="col-sm-2 col-form-label">Owner</label>
                                            <div class="col-sm-10 has-validation d-flex">
                                                <select value="<?php echo $row_main["ownerPrefix"]; ?>" name="prefix"
                                                    id="ownerSelectPrefixMain" class="form-control col-sm-2 mr-2" style="cursor: pointer;">
                                                    <option id="main_Mr." value="Mr.">Mr.</option>
                                                    <option id="main_Miss" value="Miss">Miss</option>
                                                    <option id="main_Mrs." value="Mrs.">Mrs.</option>
                                                </select>
                                                <input type="text" name="bankOwner" required
                                                    class="form-control input-bankOwnerMain"
                                                    value="<?php echo $row_main["bankOwner"]; ?>" id="inputBankOwner"
                                                    autocomplete="off" spellcheck="false" autocorrect="off"
                                                    autocapitalize="true" placeholder="Bank Owner">
                                                <div class="invalid-feedback">
                                                    <span class="text-danger fw-bold p-1">Please enter Account
                                                        Owner</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputBankName" class="col-sm-2 col-form-label">Bank
                                                Name</label>
                                            <div class="col-sm-10 has-validation">
                                                <?php include('dist/_partials/select-bankname.php'); ?>
                                                <div class="invalid-feedback">
                                                    <span class="text-danger fw-bold p-1">Please enter Bank Name</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button name="update_bank_main" type="submit"
                                                    class="btn btn-outline-success">Update Account</button>
                                            </div>
                                        </div>
                                    </form>
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
    <?php include('dist/_partials/script.php'); ?>
    <?php include("dist/_partials/footer.php"); ?>
    <script src="plugins/bootstrap-select/js/language/defaults-en_US.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="dist/js/demo.js"></script>
    <script src="dist/js/cleave/cleave.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $('.selectpicker').selectpicker();
        });
    </script>
    <script type="text/javascript">
        var cleave = new Cleave('.input-bankNumberMain', {
            delimiters: ['-', '-', '-'],
            blocks: [3, 1, 5, 1],
            uppercase: true
        });
    </script>
    <script type="text/javascript">
        function checkNumber(event) {
            var aCode = event.which ? event.which : event.keyCode;
            if (aCode > 31 && (aCode < 48 || aCode > 57)) return false;
            return true;
        }
    </script>
    <script type="text/javascript">
        window.onload = () => {
            document.getElementById("main_<?php echo $row_main["ownerPrefix"]; ?>").selected = "true";
            selectBank("bank_<?php echo $row_main['bankName']; ?>");
        }
    </script>
</body>

</html>