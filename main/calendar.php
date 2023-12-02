<?php
session_start();
include('../server/connection/conn.php');
include('../server/connection/checkLogin.php');
check_login();
$head = "Calendar/Events";
$ID = $_SESSION['ID'];

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include("dist/_partials/head.php"); ?>
<link rel="stylesheet" href="dist/css/calendar.css">

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <?php include('dist/_partials/navbar.php'); ?>
        <?php include('dist/_partials/sidebar.php'); ?>
        <div class="content-wrapper" id="isOnlinePage">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark fw-bold">Calendar/Events</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Canlendar & Events</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body p-0">
                            <calendar>
                                <div id="calendar"></div>
                            </calendar>
                        </div>
                    </div>
                </div>
            </section>
            <div id="viewEventModal" class="modal modal-top fade calendar-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h4 class="modal-title"><span class="event-icon"></span><span class="event-title"></span>
                            </h4>
                            <div class="event-body"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="viewEventModal-add" class="modal modal-top fade calendar-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="add-event">
                            <div class="modal-body">
                                <h4>Add Event Detail</h4>
                                <div class="form-group">
                                    <label>Event name</label>
                                    <input type="text" class="form-control" name="ename">
                                </div>
                                <div class="form-group">
                                    <label>Event Date</label>
                                    <input type='text' class="datetimepicker form-control" name="edate">
                                </div>
                                <div class="form-group">
                                    <label>Event Description</label>
                                    <textarea class="form-control" name="edesc"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Event Color</label>
                                    <select class="form-control" name="ecolor">
                                        <option value="fc-bg-default">fc-bg-default</option>
                                        <option value="fc-bg-blue">fc-bg-blue</option>
                                        <option value="fc-bg-lightgreen">fc-bg-lightgreen</option>
                                        <option value="fc-bg-pinkred">fc-bg-pinkred</option>
                                        <option value="fc-bg-deepskyblue">fc-bg-deepskyblue</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Event Icon</label>
                                    <select class="form-control" name="eicon">
                                        <option value="circle">circle</option>
                                        <option value="cog">cog</option>
                                        <option value="group">group</option>
                                        <option value="suitcase">suitcase</option>
                                        <option value="calendar">calendar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include("dist/_partials/offline-page.php"); ?>
    </div>
    <?php include('dist/_partials/script.php'); ?>
    <?php include("dist/_partials/footer.php"); ?>
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="dist/js/adminlte.js"></script>
    <script src="dist/js/demo.js"></script>
    <script src="plugins/fullcalendar/fullcalendar.min.js"></script>

    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('.datetimepicker').datepicker({
                timepicker: true,
                language: 'en',
                range: true,
                multipleDates: true,
                multipleDatesSeparator: " - "
            });
            jQuery("#add-event").submit(function () {
                alert("Submitted");
                var values = {};
                $.each($('#add-event').serializeArray(), function (i, field) {
                    values[field.name] = field.value;
                });
                console.log(
                    values
                );
            });
        });
        (function () {
            'use strict';

            jQuery(function () {
                jQuery('#calendar').fullCalendar({
                    themeSystem: 'bootstrap4',
                    businessHours: false,
                    defaultView: 'month',
                    editable: true,
                    header: {
                        left: 'title',
                        center: 'month,agendaWeek,agendaDay',
                        right: 'today prev,next'
                    },
                    events: [
                        {
                            title: 'Birthday',
                            description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                            start: '2023-09-13',
                            end: '2023-09-14',
                            className: 'fc-bg-default',
                            icon: "birthday-cake"
                        }
                    ],
                    eventRender: function (event, element) {
                        if (event.icon) {
                            element.find(".fc-title").prepend("<i class='fas fa-" + event.icon + "'></i>")
                        }
                    },
                    dayClick: function () {
                        jQuery('#viewEventModal-add').modal();
                    },
                    eventClick: function (event, jsEvent, view) {
                        jQuery('.event-icon').html("<i class='fas fa-" + event.icon + "'></i>");
                        jQuery('.event-title').html(event.title);
                        jQuery('.event-body').html(event.description);
                        jQuery('.eventUrl').attr('href', event.url);
                        jQuery('#viewEventModal').modal();
                    },
                });
            });
        })(jQuery);
    </script>
</body>

</html>