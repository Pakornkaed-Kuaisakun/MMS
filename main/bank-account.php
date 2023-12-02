<?php
session_start();
include('../server/connection/conn.php');
include('../server/connection/checkLogin.php');
include('dist/function/array-data.php');
check_login();

$ID = $_SESSION['ID'];
$head = "Bank Account";

$bank_main = "SELECT * FROM `bank` WHERE `accID` = '$ID' AND `type` = 'Main'";
$result_main = mysqli_query($conn, $bank_main);

$bank_saving = "SELECT * FROM `bank` WHERE `accID` = '$ID' AND `type` = 'Saving'";
$result_saving = mysqli_query($conn, $bank_saving);

if($result_main) {
    $row_main = mysqli_fetch_assoc($result_main);
    $bankNameMain = $bankList[$row_main['bankName']];
}
if($result_saving) {
    $row_saving = mysqli_fetch_assoc($result_saving);
    $bankNameSaving = $bankList[$row_saving['bankName']];
}

if(isset($_POST['update_bank_main'])) {
    $bankNumber = mysqli_real_escape_string($conn, $_POST['bankNumber']);
    $bankName = $_POST['bankName'];
    $bankOwner = mysqli_real_escape_string($conn, $_POST['bankOwner']);
    $ownerPrefix = $_POST['prefix'];

    $update = "UPDATE `bank` SET `bankName` = '$bankName', `bankNumber` = '$bankNumber', `ownerPrefix` = '$ownerPrefix', `bankOwner` = '$bankOwner' WHERE `accID` = '$ID' AND `type` = 'Main'";
    $result = mysqli_query($conn, $update);

    if($result) {
        header("Refresh: 1");
        $success = "Account Main Updated";
    } else {
        $err = "Somethings went Wrong";
    }
}

if(isset($_POST['update_bank_saving'])) {
    $bankNumber = mysqli_real_escape_string($conn, $_POST['bankNumber']);
    $bankName = $_POST['bankName'];
    $bankOwner = mysqli_real_escape_string($conn, $_POST['bankOwner']);
    $ownerPrefix = $_POST['prefix'];

    $update = "UPDATE `bank` SET `bankName` = '$bankName', `bankNumber` = '$bankNumber', `ownerPrefix` = '$ownerPrefix', `bankOwner` = '$bankOwner' WHERE `accID` = '$ID' AND `type` = 'Saving'";
    $result = mysqli_query($conn, $update);

    if ($result) {
        header("Refresh: 2");
        $success = "Account Saving Updated";
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
                            <h1>Bank Account</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="bank-account.php">Bank Account</a></li>
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
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="bank_Main_page">
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
                                                    <b>Account Type: </b><a class="float-right font-weight-bold text-secondary" style="pointer-events:none;">
                                                        <?php echo $row_main['type']; ?>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="bank_Saving_page">
                                            <div class="text-center">
                                                <img src="dist/img/bank-logo/<?php echo $row_saving['bankName']; ?>.png" alt="Bank logo Image" class="img-fluid">
                                            </div>
                                            <h3 class="profile-username text-center">
                                                <?php echo $row_saving["ownerPrefix"] . " " . $row_saving["bankOwner"]; ?>
                                                <div class="badge badge-secondary text-sm">Owner</div>
                                            </h3>
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <b>Account Number: </b><a class="float-right">
                                                        <?php echo $row_saving['bankNumber']; ?>
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Bank Name: </b><a class="float-right">
                                                        <?php echo $bankNameSaving; ?>
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Account Type: </b><a class="float-right font-weight-bold text-secondary" style="pointer-events:none;">
                                                        <?php echo $row_saving['type']; ?>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#bank_Main"
                                                data-toggle="tab" onclick="change_card1();">Bank Account Main</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#bank_Saving" data-toggle="tab"
                                                onclick="change_card2();">Bank Account Saving</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="bank_Main">
                                            <form method="post" class="form-horizontal needs-validation" novalidate>
                                                <div class="form-group row">
                                                    <label for="inputBankNumber" class="col-sm-2 col-form-label">Account
                                                        Number</label>
                                                    <div class="col-sm-10 has-validation">
                                                        <input type="text" name="bankNumber" required
                                                            class="form-control input-bankNumberMain"
                                                            value="<?php echo $row_main['bankNumber']; ?>"
                                                            id="inputBankNumber" autocomplete="off" spellcheck="false"
                                                            autocorrect="off" autocapitalize="true"
                                                            placeholder="Bank Account Number" onkeypress="return checkNumber(event)">
                                                        <div class="invalid-feedback">
                                                            <span class="text-danger fw-bold p-1">Please enter your Bank
                                                                account number.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputBankOwner" class="col-sm-2 col-form-label">Owner</label>
                                                    <div class="col-sm-10 has-validation d-flex">
                                                        <select value="<?php echo $row_main["ownerPrefix"]; ?>" name="prefix" id="ownerSelectPrefixMain" class="form-control col-sm-2 mr-2">
                                                            <option id="main_Mr." value="Mr.">Mr.</option>
                                                            <option id="main_Miss" value="Miss">Miss</option>
                                                            <option id="main_Mrs." value="Mrs.">Mrs.</option>
                                                        </select>
                                                        <input type="text" name="bankOwner" required class="form-control input-bankOwnerMain" value="<?php echo $row_main["bankOwner"]; ?>" id="inputBankOwner" autocomplete="off" spellcheck="false" autocorrect="off" autocapitalize="true" placeholder="Bank Owner">
                                                        <div class="invalid-feedback">
                                                            <span class="text-danger fw-bold p-1">Please enter Account Owner</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputBankName" class="col-sm-2 col-form-label">Bank
                                                        Name</label>
                                                    <?php include('dist/_partials/select-bankname.php'); ?>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button name="update_bank_main" type="submit"
                                                            class="btn btn-outline-success">Update Account</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="bank_Saving">
                                            <form method="post" class="form-horizontal needs-validation" novalidate>
                                                <div class="form-group row">
                                                    <label for="inputBankNumber" class="col-sm-2 col-form-label">Account
                                                        Number</label>
                                                    <div class="col-sm-10 has-validation">
                                                        <input type="text" name="bankNumber" required
                                                            class="form-control input-bankNumberSaving"
                                                            value="<?php echo $row_saving['bankNumber']; ?>"
                                                            id="inputBankNumber" autocomplete="off" spellcheck="false"
                                                            autocorrect="off" autocapitalize="true"
                                                            placeholder="Bank Account Number" onkeypress="return checkNumber(event)">
                                                        <div class="invalid-feedback">
                                                            <span class="text-danger fw-bold p-1">Please enter your Bank
                                                                account number.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputBankOwner" class="col-sm-2 col-form-label">Owner</label>
                                                    <div class="col-sm-10 has-validation d-flex">
                                                        <select name="prefix" id="ownerSelectPrefixSaving" class="form-control col-sm-2 mr-2">
                                                            <option id="saving_Mr." value="Mr.">Mr.</option>
                                                            <option id="saving_Miss" value="Miss">Miss</option>
                                                            <option id="saving_Mrs." value="Mrs.">Mrs.</option>
                                                        </select>
                                                        <input type="text" name="bankOwner" required class="form-control input-bankSavingMain" value="<?php echo $row_saving["bankOwner"]; ?>" id="inputBankOwner" autocomplete="off" spellcheck="false"
                                                            autocorrect="off" autocapitalize="true" placeholder="Bank Owner">
                                                        <div class="invalid-feedback">
                                                            <span class="text-danger fw-bold p-1">Please enter Account Owner</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputBankName" class="col-sm-2 col-form-label">Bank
                                                        Name</label>
                                                    <?php include('dist/_partials/select-bankname.php'); ?>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button name="update_bank_saving" type="submit"
                                                            class="btn btn-outline-success">Update Account</button>
                                                    </div>
                                                </div>
                                            </form>
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
    <script type="text/javascript">
        function change_card1() {
            document.getElementById("bank_Main_page").classList.add("active");
            document.getElementById("bank_Saving_page").classList.remove("active");
        }
        function change_card2() {
            document.getElementById("bank_Saving_page").classList.add("active");
            document.getElementById("bank_Main_page").classList.remove("active");
        }
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
        var cleave = new Cleave('.input-bankNumberSaving', {
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
            document.getElementById("saving_<?php echo $row_saving["ownerPrefix"]; ?>").selected = "true";
        }
    </script>
</body>

</html>