<?php
session_start();
include('../server/connection/conn.php');
include('../server/connection/checkLogin.php');
include('dist/function/array-data.php');
check_login();

$ID = $_SESSION['ID'];
$head = "Bank Account Saving Manage";

$savingID = mysqli_real_escape_string($conn, $_GET['ID']);
$type = mysqli_real_escape_string($conn, $_GET['type']);

$bank = "SELECT * FROM `bank` WHERE `ID` = '$savingID' AND `accID` = '$ID' AND `type` = '$type'";
$result = mysqli_query($conn, $bank);


if ($result) {
    $row = mysqli_fetch_assoc($result);
    $bankName = $bankList[$row['bankName']];
    $fullName = $row['ownerPrefix'] . " " . $row['bankOwner'];
}


if(isset($_POST['update_bank_saving'])) {
    $bankNumber = mysqli_real_escape_string($conn, $_POST['bankNumber']);
    $prefix = $_POST['prefix'];
    $bankOwner = mysqli_real_escape_string($conn, $_POST['bankOwner']);
    $bankName = $_POST['bankName'];

    $accountID = $_POST['accountID'];
    $type = $_POST['type'];
    
    if(isset($_POST['status'])) {
        $status = "available";
    } else {
        $status = "not available";
    }

    $update = "UPDATE `bank` SET `bankName`='$bankName', `bankNumber`='$bankNumber', `ownerPrefix`='$prefix',`bankOwner`='$bankOwner', `status`='$status' WHERE `ID` = '$accountID' AND `accID` = '$ID' AND `type` = '$type'";
    $result = mysqli_query($conn, $update);

    if($result) {
        header("Refresh: 1");
        $success = "Account Updated";
    } else {
        $err = "Somethings went wrong.";
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
                            <h1>
                                <?php echo $fullName; ?>
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="bank-account-saving.php">Bank Account</a></li>
                                <li class="breadcrumb-item"><a href="bank-account-saving.php">Account Saving</a></li>
                                <li class="breadcrumb-item active">
                                    <?php echo $fullName; ?>
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
                                        <img src="dist/img/bank-logo/<?php echo $row['bankName']; ?>.png"
                                            alt="Bank logo Image" class="img-fluid">
                                    </div>
                                    <h3 class="profile-username text-center">
                                        <?php echo $fullName; ?>
                                        <div class="badge badge-secondary text-sm">Owner</div>
                                    </h3>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Account Number: </b><a class="float-right">
                                                <?php echo $row['bankNumber']; ?>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Bank Name: </b><a class="float-right">
                                                <?php echo $bankName; ?>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Account Type: </b><a class="float-right font-weight-bold text-secondary"
                                                style="pointer-events:none;">
                                                <?php echo $row['type']; ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2 ml-3">
                                    <h3 class="font-weight-bold">Account Saving</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post" class="form-horizontal needs-validation" novalidate>
                                        <div class="form-group row">
                                            <label for="inputBankNumber" class="col-sm-2 col-form-label">Account
                                                Number</label>
                                            <div class="col-sm-10 has-validation">
                                                <input type="text" name="bankNumber" required
                                                    class="form-control input-bankNumber"
                                                    value="<?php echo $row['bankNumber']; ?>" id="inputBankNumber"
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
                                                <select value="<?php echo $row["ownerPrefix"]; ?>" name="prefix"
                                                    id="ownerSelectPrefix" class="form-control col-sm-2 mr-2"
                                                    style="cursor: pointer;">
                                                    <option id="saving_Mr." value="Mr.">Mr.</option>
                                                    <option id="saving_Miss" value="Miss">Miss</option>
                                                    <option id="saving_Mrs." value="Mrs.">Mrs.</option>
                                                </select>
                                                <input type="text" name="bankOwner" required
                                                    class="form-control input-bankOwner"
                                                    value="<?php echo $row["bankOwner"]; ?>" id="inputBankOwner"
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
                                        <div class="form-group row align-items-center">
                                            <label for="AccountStatus" class="col-sm-2 col-form-label">Account
                                                Status</label>
                                            <div class="d-flex ml-2 mt-1">
                                                <label class="switch">
                                                    <input type="checkbox" name="status" id="inputAccountStatus"
                                                        onclick="showStatus()">
                                                    <span class="switch-slider round"></span>
                                                </label>
                                                <span class="ml-2 mt-1 font-weight-bold" id="status-message"></span>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button name="update_bank_saving" type="submit"
                                                    class="btn btn-outline-success">Update Account</button>
                                                <input type="hidden" name="accountID" value="<?php echo $_GET['ID']; ?>">
                                                <input type="hidden" name="type" value="<?php echo $_GET['type']; ?>">
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
        var cleave = new Cleave('.input-bankNumber', {
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
        function showStatus() {
            var checkBox = document.getElementById("inputAccountStatus");
            var status_message = document.getElementById("status-message");

            if (checkBox.checked == true) {
                status_message.innerText = "Available";
                status_message.style.color = "#28a745";
            } else {
                status_message.innerText = "not Available";
                status_message.style.color = "#dc3545";
            }
        }
    </script>
    <script type="text/javascript">
        window.onload = () => {
            document.getElementById("saving_<?php echo $row["ownerPrefix"]; ?>").selected = "true";
            selectBank("bank_<?php echo $row['bankName']; ?>");
            var checkBox = document.getElementById("inputAccountStatus");
            var status = "<?php echo $row['status']; ?>"

            if (status == "available") {
                checkBox.checked = "true";
            }

            showStatus();
        }
    </script>
</body>

</html>