<?php
session_start();
include('../server/connection/conn.php');
include('../server/connection/checkLogin.php');
check_login();
$ID = $_SESSION['ID'];
$head = "Expenese";

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include("dist/_partials/head.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <?php include("dist/_partials/navbar.php"); ?>
        <?php include("dist/_partials/sidebar.php"); ?>

        <div class="content-wrapper" id="isOnlinePage">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <h1>Expenese</h1>
                                <button type="button" id="add_expenese" data-toggle="modal" data-target="#expeneseModal"
                                    class="btn btn-success ml-3 font-weight-bold"><i class="fas fa-plus"></i>
                                    ADD</button>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="income">Expenese</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="expeneseTable" class="table table-hover table-bordered table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Amount(THB)</th>
                                            <th class="text-center">Comment</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Datetime</th>
                                            <th class="text-center">Created At/Lasted update</th>
                                            <th class="text-center">Edit</th>
                                            <th class="text-center">Delete</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php include("dist/_partials/offline-page.php"); ?>
        </div>

        <!-- Expenese Modal -->
        <div id="expeneseModal" class="modal fade">
            <div class="modal-dialog">
                <form method="post" class="needs-validation" id="expenese-form" enctype="multipart/form-data" novalidate>
                    <div class="modal-content">
                        <div class="modal-header align-items-center">
                            <h4 class="modal-title font-weight-bold" id="expenese-title">Add Expenese</h4>
                            <button type="button" class="modal-close btn text-lg font-weight-bold text-danger"
                                data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <label for="amount">Amount(THB)</label>
                            <div class="has-validation">
                                <input type="text" name="amount" id="amount" class="form-control"
                                    placeholder="Expenese Amount" autocomplete="off" value=""
                                    onkeypress="return checkNumber(event)" required />
                                <div class="invalid-feedback">
                                    <span class="text-danger p-1">Please enter your Expenese amount.</span>
                                </div>
                            </div>
                            <br />
                            <label for="comment">Comment</label>
                            <textarea class="form-control resize-ta" name="comment" id="comment" rows="3" value=""
                                placeholder="Comment(Optional)" autocomplete="off" spellcheck="true"></textarea>
                            <br />
                            <label for="type">Type</label>
                            <div class="has-validation">
                                <select name="type" id="type" class="form-control" required>
                                    <option value="">========== Choose Type ==========</option>
                                    <option value="food">Food</option>
                                    <option value="travel">Travel</option>
                                    <option value="subscription_fee">subscription Fee</option>
                                    <option value="laundry">Laundry</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <br>
                            <label for="datetime">Date</label>
                            <div class="has-validation">
                                <input type="date" name="datetime" id="date" class="form-control" value="" required>
                                <div class="invalid-feedback">
                                    <span class="text-danger p-1">Please enter Date of Expenese.</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="accID" id="accID" value="<?php echo $ID; ?>">
                            <input type="hidden" name="ID" id="ID" />
                            <input type="hidden" name="operation" id="operation" value="Add" />
                            <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="deleteModal" class="modal fade">
            <div class="modal-dialog">
                <form method="post" id="delete-form">
                    <div class="modal-content">
                        <div class="modal-header align-items-center">
                            <h4 class="modal-title font-weight-bold text-danger" id="delete-title"><i
                                    class="fas fa-exclamation-circle"></i> Alert</h4>
                            <button type="button" class="modal-close btn text-lg font-weight-bold text-danger"
                                data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body text-center">
                            <h4>Are you sure you want to delete this?</h4>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="accID" id="accID" value="<?php echo $ID; ?>">
                            <input type="hidden" name="ID" id="delete_ID" />
                            <input type="hidden" name="delete_operation" id="delete_operation" />
                            <input type="submit" name="action" id="action" class="btn btn-danger" value="Delete" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="viewCommentModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header align-items-center">
                        <div class="modal-title font-weight-bold" id="view-title"><i class="fas fa-comments"></i> Comment</div>
                        <button type="button" class="modal-close btn text-lg font-weight-bold text-danger" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <span class="textarea" role="textbox" id="view_comment" contenteditable></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <?php include("dist/_partials/footer.php"); ?>
        

        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

    <?php include("dist/_partials/script.php"); ?>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <script src="plugins/bootstrap/js/popper.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
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
    <script type="text/javascript" language="javascript">
        $(document).ready(function () {
            $('#add-button').click(function () {
                $('#expenese-form')[0].reset();
                $('.modal-title').text("Add Expenese");
                $('#action').val("Add");
                $('#operation').val("Add");
            });

            var dataTable = $('#expeneseTable').DataTable({
                "processing": true,
                "serverSide": true,
                "autoWidth": true,
                "order": [],
                "ajax": {
                    url: "dist/function/table/expenese/get-expeneseTable.php",
                    type: "POST"
                },
                "columnDefs": [
                    {
                        "targets": [0, 2, 6, 7],
                        "orderable": false,
                    },
                ],
            });
            $(document).on('submit', '#expenese-form', function (event) {
                event.preventDefault();
                var amount = $('#amount').val();
                var comment = $('#comment').val();
                var type = $('#type').val();
                var date = $('#date').val();
                if ((amount, type, date) != '') {
                    $.ajax({
                        url: "dist/function/table/expenese/insert.php",
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            setTimeout(function () {
                                swal("Success", data, "success");
                            }, 100);
                            $('#expenese-form')[0].reset();
                            $('#expeneseModal').modal('hide');
                            dataTable.ajax.reload();
                        }
                    });
                }
            });
            $(document).on('submit', '#delete-form', function (event) {
                event.preventDefault();
                $.ajax({
                    url: "dist/function/table/expenese/delete.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        setTimeout(function () {
                            swal("Success", data, "success");
                        }, 100);
                        $('#delete-form')[0].reset();
                        $('#deleteModal').modal('hide');
                        dataTable.ajax.reload();
                    }
                });
            });

            $(document).on('click', '.update', function () {
                var ID = $(this).attr("id");
                $.ajax({
                    url: "dist/function/table/expenese/fetch_single.php",
                    method: "POST",
                    data: { ID: ID },
                    dataType: "json",
                    success: function (data) {
                        $('#expeneseModal').modal('show');
                        $('#amount').val(data.amount);
                        $('#comment').val(data.comment);
                        $('#type').val(data.type);
                        $('#expenese-title').text("Edit Expenese");
                        $('#ID').val(ID);
                        $('#date').val(data.time);
                        $('#action').val("Edit");
                        $('#operation').val("Edit");
                    }
                })
            });

            $(document).on('click', '.delete', function () {
                var ID = $(this).attr("id");
                $.ajax({
                    data: { ID: ID },
                    success: function (data) {
                        $('#delete_operation').val("Delete");
                        $('#delete_ID').val(ID);
                        $('#deleteModal').modal('show');
                    }
                })
            });
            $(document).on('click', '.view', function () {
                var ID = $(this).attr("id");
                $.ajax({
                    url: "dist/function/table/expenese/fetch_single.php",
                    method: "POST",
                    data: {ID : ID},
                    dataType: "json",
                    success: function (data) {
                        $('#viewCommentModal').modal("show");
                        $('#view_comment').text(data.comment);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        function checkNumber(event) {
            var aCode = event.which ? event.which : event.keyCode;
            if (aCode > 31 && (aCode < 48 || aCode > 57)) return false;
            return true;
        }
    </script>
    <script src="dist/js/resize-textarea.js"></script>
</body>

</html> 