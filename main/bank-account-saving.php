<?php
session_start();
include("../server/connection/conn.php");
include("../server/connection/checkLogin.php");
check_login();
$ID = $_SESSION['ID'];
$head = "Bank Account Saving";

if(isset($_POST['addAccount'])) {
    $bankNumber = mysqli_real_escape_string($conn, $_POST['bankNumber']);
    $prefix = $_POST['prefix'];
    $bankOwner = mysqli_real_escape_string($conn, $_POST['bankOwner']);
    $bankName = $_POST['bankName'];
    $status = "available";
    $type = "Saving";

    $insert = "INSERT INTO `bank`(`accID`, `type`, `bankName`, `bankNumber`, `ownerPrefix`, `bankOwner`, `status`) VALUES ('$ID', '$type', '$bankName', '$bankNumber', '$prefix', '$bankOwner', '$status')";
    $result = mysqli_query($conn, $insert);

    if($result) {
        $success = "Saving Account Inserted";
    } else {
        $err = "Error";
    }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include("dist/_partials/head.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <?php include("dist/_partials/navbar.php"); ?>
        <?php include("dist/_partials/sidebar.php"); ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6 d-flex">
                            <h1>Account Saving</h1>
                            <button type="button" class="btn btn-success ml-3 font-weight-bold" data-toggle="modal"
                                data-target="#addSavingAccount">
                                <i class="fas fa-plus"></i> ADD
                            </button>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="bank-account-saving">Bank Account</a></li>
                                <li class="breadcrumb-item active">Account Saving</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Select on any account saving to manage</h3>
                            </div>
                            <div class="card-body">
                                <table id="bankAccountSaving" class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Bank</th>
                                            <th class="text-center">Account No.</th>
                                            <th class="text-center">Owner</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret = "SELECT * FROM `bank` WHERE `accID` = '$ID' AND `type` = 'Saving'";
                                        $stmt = $conn->prepare($ret);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        $cnt = 1;
                                        while ($row = $res->fetch_object()) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $cnt; ?>
                                                </td>
                                                <td>
                                                    <img src="dist/img/bank-logo/<?php echo $row->bankName; ?>.png"
                                                        alt="Bank Logo" style="width: 35px; height: 35px;" class="rounded-circle">
                                                </td>
                                                <td>
                                                    <?php echo $row->bankNumber; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->ownerPrefix . " " . $row->bankOwner; ?>
                                                </td>
                                                <td>
                                                    <?php if ($row->status == 'available') { ?>
                                                        <span class="badge badge-pill badge-success p-2">Available</span>
                                                    <?php } else if ($row->status == 'not available') { ?>
                                                            <span class="badge badge-pill badge-danger p-2">Not Available</span>
                                                    <?php } else { ?>
                                                            <span class="badge badge-pill badge-danger p-2">Error</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-success btn-sm"
                                                        href="bank-account-saving-manage?ID=<?php echo $row->ID; ?>&type=Saving">
                                                        <i class="fas fa-edit"></i>
                                                        Manage
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $cnt = $cnt + 1;
                                        } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="modal fade" id="addSavingAccount">
            <div class="modal-dialog">
                <form method="post" class="need-validation" novalidate>
                    <div class="modal-content">
                        <div class="modal-header align-items-center">
                            <h4 class="modal-title font-weight-bold">Add Saving Account</h4>
                            <button type="button" class="modal-close btn text-lg font-weight-bold text-danger"
                                data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <label for="bankNumber">Account No.</label>
                            <div class="has-validation">
                                <input type="text" class="form-control input-bankNumberSaving" id="bankNumber"
                                    name="bankNumber" placeholder="Account No." autocomplete="off"
                                    onkeypress="return checkNumber(event)" required>
                                <div class="invalid-feedback">
                                    <span class="text-danger p-1">Please enter your Account No.</span>
                                </div>
                            </div>
                            <br>
                            <label for="AccountOwner">Account Owner</label>
                            <div class="has-validation d-flex">
                                <select name="prefix" id="ownerSelectPrefix" class="form-control col-sm-2 mr-2"
                                    style="cursor: pointer;">
                                    <option id="Mr." value="Mr.">Mr.</option>
                                    <option id="Miss" value="Miss">Miss</option>
                                    <option id="Mrs." value="Mrs.">Mrs.</option>
                                </select>
                                <input type="text" class="form-control" id="AccountOwner" name="bankOwner"
                                    placeholder="Account Owner" autocomplete="off" spellcheck="false" required>
                            </div>
                            <br>
                            <div class="has-validation d-flex">
                                <label for="inputBankName">Bank Name</label>
                                <div class="ml-3">
                                    <?php include('dist/_partials/select-bankname.php'); ?>   
                                </div>
                                <div class="invalid-feedback">
                                    <span class="text-danger fw-bold p-1">Please enter Bank Name</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="addAccount" class="btn btn-success font-weight-bold">ADD</button>
                            <button type="button" class="btn btn-default font-weight-bold" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php include("dist/_partials/footer.php"); ?>

        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

    <?php include("dist/_partials/script.php"); ?>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="plugins/bootstrap-select/js/language/defaults-en_US.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="dist/js/demo.js"></script>
    <script src="dist/js/cleave/cleave.min.js"></script>
    <!-- page script -->
    <script>
        $(function () {
            $('#bankAccountSaving').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
            });
        });
    </script>
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
        $(function () {
            $('.selectpicker').selectpicker();
        });
    </script>
    <script type="text/javascript">
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
</body>

</html>