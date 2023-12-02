<?php
session_start();
include('../server/connection/conn.php');
include('../server/connection/checkLogin.php');
check_login();

$head = "Dashboard";
$ID = $_SESSION['ID'];

//fetch
include('dist/_partials/fetch.php');
include('dist/_partials/expenese-inweek.php');


//last function
include('dist/function/time.php');
include('dist/function/alert_debt.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include("dist/_partials/head.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <?php include('dist/_partials/navbar.php'); ?>
        <?php include('dist/_partials/sidebar.php'); ?>
        <div class="content-wrapper" id="isOnlinePage">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark fw-bold">Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="mb-3 card">
                        <div class="card-header-tab card-header h5">
                            <i class="fas fa-info-circle"></i>&nbsp;&nbsp;All
                        </div>
                        <div class="no-gutter row justify-content-around">
                            <div class="col-12 col-sm-6 col-md-auto mt-2 ml-2">
                                <div class="info-box p-2 shadow-none">
                                    <span class="info-box-icon bg-success rounded-circle elevation-1"><i
                                            class="fas fa-hand-holding-usd"></i></span>
                                    <div class="d-flex flex-column ml-3 mt-1">
                                        <div class="h6">Income</div>
                                        <div class="h4 fw-bold">
                                            <span class="numscroller" data-min="1" data-max="<?php echo $income; ?>"
                                                data-delay="5" data-increment='<?php echo $income / 50; ?>'></span> THB
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-auto mt-2 ml-2">
                                <div class="info-box shadow-none p-2" style="<?php echo $alert_e; ?>">
                                    <span class="info-box-icon bg-warning rounded-circle elevation-1"><i
                                            class="fas fa-coins"></i></span>
                                    <div class="d-flex flex-column ml-3 mt-1">
                                        <div class="h6">Expenese</div>
                                        <div class="h4 fw-bold">
                                            <span class="numscroller" data-min="1" data-max="<?php echo $expenese; ?>"
                                                data-delay="5" data-increment='<?php echo $expenese / 50; ?>'></span>
                                            THB
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-auto mt-2 ml-2">
                                <div class="info-box shadow-none p-2" style="<?php echo $alert_s; ?>">
                                    <span class="info-box-icon bg-primary rounded-circle elevation-1"><i
                                            class="fas fa-piggy-bank"></i></span>
                                    <div class="d-flex flex-column ml-3">
                                        <div class="h6">
                                            Saving
                                            <?php if ($saving == $target_saving) { ?>
                                                <span class="badge badge-success">Full</span>
                                            <?php } ?>
                                        </div>
                                        <div class="h4 fw-bold d-flex align-items-center">
                                            <span class="numscroller" data-min="1" data-max="<?php echo $saving; ?>"
                                                data-delay="5"
                                                data-increment='<?php echo abs($saving / 50); ?>'></span>&nbsp;THB
                                            <span class="d-inline-block p-0 mr-3" tabindex="0" data-toggle="tooltip"
                                                data-html="true"
                                                title="Target: <b><?php echo $target_saving; ?> THB</b>">
                                                <button class="btn" style="pointer-events: none;" type="button"
                                                    disabled><i class="fas fa-info-circle"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-auto mt-2 ml-2">
                                <div class="info-box shadow-none p-2" style="<?php echo $alert_t; ?>">
                                    <span class="info-box-icon bg-info rounded-circle elevation-1"><i
                                            class="fas fa-wallet"></i></span>
                                    <div class="d-flex flex-column ml-3 mt-1">
                                        <div class="h6">Total</div>
                                        <div class="h4 fw-bold">
                                            <span class="numscroller" data-min="1" data-max="<?php echo $total; ?>"
                                                data-delay="5" data-increment='<?php echo abs($total / 50); ?>'></span>
                                            THB
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-auto mt-2 ml-2">
                                <div class="info-box shadow-none p-2" style="<?php echo $alert_m; ?>">
                                    <span class="info-box-icon bg-white rounded-circle elevation-1"><i
                                            class="fas fa-calendar-alt"></i></span>
                                    <div class="d-flex flex-column ml-3">
                                        <div class="h6">Spend per Day</div>
                                        <div class="h4 fw-bold d-flex align-items-center">
                                            <span class="numscroller" data-min="1"
                                                data-max="<?php echo $moneyperDay; ?>" data-delay="3"
                                                data-increment='<?php echo $moneyperDay / 4; ?>'></span>&nbsp;THB
                                            <span class="d-inline-block p-0 mr-3" tabindex="0" data-toggle="tooltip"
                                                data-html="true"
                                                title="To: <b><?php echo date("D, d/m/Y", strtotime("last day of this month", time())); ?></b>">
                                                <button class="btn" style="pointer-events: none;" type="button"
                                                    disabled><i class="fas fa-info-circle"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title fw-bold"><i class="fas fa-chart-pie"></i>&nbsp;&nbsp;Income
                                        Expenese and Total</h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart text-center">
                                        <div id="PieChartAll" class="col-md-6" style="height: 400px; max-width: 500px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header">
                                                    <span class="numscroller" data-min="1"
                                                        data-max="<?php echo $income; ?>" data-delay="5"
                                                        data-increment='<?php echo $income / 50; ?>'></span> THB
                                                </h5>
                                                <span class="description-text">TOTAL INCOME</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right" style="<?php echo $alert_e; ?>">
                                                <h5 class="description-header">
                                                    <span class="numscroller" data-min="1"
                                                        data-max="<?php echo $expenese; ?>" data-delay="5"
                                                        data-increment='<?php echo $expenese / 50; ?>'></span> THB
                                                </h5>
                                                <span class="description-text">TOTAL EXPENESE</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right" style="<?php echo $alert_s; ?>">
                                                <h5 class="description-header">
                                                    <span class="numscroller" data-min="1"
                                                        data-max="<?php echo $saving; ?>" data-delay="5"
                                                        data-increment='<?php echo abs($saving / 50); ?>'></span> THB
                                                </h5>
                                                <span class="description-text">
                                                    Saving
                                                    <?php if ($saving == $target_saving) { ?>
                                                        <span class="badge badge-success">Full</span>
                                                    <?php } ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block" style="<?php echo $alert_t; ?>">
                                                <h5 class="description-header">
                                                    <span class="numscroller" data-min="1"
                                                        data-max="<?php echo $total; ?>" data-delay="5"
                                                        data-increment='<?php echo abs($total / 50); ?>'></span> THB
                                                </h5>
                                                <span class="description-text">TOTAL</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title fw-bold"><i class="fas fa-chart-pie"></i>&nbsp;&nbsp;Type of
                                        expenese</h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart text-center">
                                        <div id="Piechart-Expenese" class="col-md-6"
                                            style="height: 400px; max-width: 500px;"></div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row justify-content-center">
                                        <div class="col-sm-2 col-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header">
                                                    <span class="numscroller" data-min="1"
                                                        data-max="<?php echo $e_food; ?>" data-delay="5"
                                                        data-increment='<?php echo $e_food / 50; ?>'></span> THB
                                                </h5>
                                                <span class="description-text">Food</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header">
                                                    <span class="numscroller" data-min="1"
                                                        data-max="<?php echo $e_travel; ?>" data-delay="5"
                                                        data-increment='<?php echo $e_travel / 50; ?>'></span> THB
                                                </h5>
                                                <span class="description-text">Travel</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header">
                                                    <span class="numscroller" data-min="1"
                                                        data-max="<?php echo $e_laundry; ?>" data-delay="5"
                                                        data-increment='<?php echo $e_laundry / 20; ?>'></span> THB
                                                </h5>
                                                <span class="description-text">Laundry</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-6">
                                            <div class="description-block">
                                                <h5 class="description-header">
                                                    <span class="numscroller" data-min="1"
                                                        data-max="<?php echo $e_subscription_fee; ?>" data-delay="5"
                                                        data-increment='<?php echo $e_subscription_fee / 10; ?>'></span>
                                                    THB
                                                </h5>
                                                <span class="description-text">Sub Fee</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block">
                                                <h5 class="description-header">
                                                    <span class="numscroller" data-min="1"
                                                        data-max="<?php echo $e_other; ?>" data-delay="5"
                                                        data-increment='<?php echo $e_other / 50; ?>'></span> THB
                                                </h5>
                                                <span class="description-text">Other</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title fw-bold">
                                        <i class="fas fa-chart-bar"></i>&nbsp;&nbsp;Statistics
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart text-center">
                                        <div id="Expenese-Line" class="col-md-6"
                                            style="height: 400px; max-width: 500px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        Demo
                                    </h5>
                                </div>
                                <div class="card-body">
                                    Demo
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include("dist/_partials/offline-page.php"); ?>
    </div>
    <?php include('dist/_partials/script.php'); ?>
    <?php include("dist/_partials/footer.php"); ?>
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="dist/js/adminlte.js"></script>
    <script src="dist/js/demo.js"></script>
    <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <script src="plugins/chart.js/Chart.min.js"></script>
    <script src="dist/js/pages/dashboard2.js"></script>
    <script src="plugins/canvasjs.min.js"></script>
    <script src="plugins/fullcalendar/core/main.js" nonce=""></script>
    <script src="plugins/fullcalendar/interaction/main.js" nonce=""></script>
    <script src="plugins/fullcalendar/daygrid/main.js" nonce=""></script>
    <script src="plugins/fullcalendar/timegrid/main.js" nonce=""></script>
    <script src="plugins/fullcalendar/list/main.js" nonce=""></script>

    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
    <script type="text/javascript">
        window.onload = function () {

            var PieChart = new CanvasJS.Chart("PieChartAll", {
                exportEnabled: false,
                animationEnabled: true,
                title: {
                    text: "Income Expenese Saving and Total"
                },
                legend: {
                    cursor: "pointer",
                    itemclick: explodePie
                },
                data: [{
                    type: "pie",
                    showInLegend: true,
                    toolTipContent: "{name}: <strong>{y} THB</strong>",
                    indexLabel: "{name} - {y} THB",
                    dataPoints: [{
                        y: <?php echo $income; ?>,
                        name: "Income",
                        exploded: false
                    },

                    {
                        y: <?php echo $expenese; ?>,
                        name: "Expenese",
                        exploded: false
                    },

                    {
                        y: <?php echo $total; ?>,
                        name: "Total",
                        exploded: false
                    },
                    {
                        y: <?php echo $saving; ?>,
                        name: "Saving",
                        exploded: false
                    }
                    ]
                }]
            });

            var PieExpenese = new CanvasJS.Chart("Piechart-Expenese", {
                exportEnabled: false,
                animationEnabled: true,
                title: {
                    text: "Type of Expenese"
                },
                legend: {
                    cursor: "pointer",
                    itemclick: explodePie
                },
                data: [{
                    type: "pie",
                    showInLegend: true,
                    toolTipContent: "{name}: <strong>{y} THB</strong>",
                    indexLabel: "{name} - {y} THB",
                    dataPoints: [{
                        y: <?php echo $e_food; ?>,
                        name: "Food",
                        exploded: false
                    },
                    {
                        y: <?php echo $e_travel; ?>,
                        name: "Travel",
                        exploded: false
                    },
                    {
                        y: <?php echo $e_subscription_fee; ?>,
                        name: "Subscription Fee",
                        exploded: true
                    },
                    {
                        y: <?php echo $e_laundry; ?>,
                        name: "Laundry",
                        exploded: true
                    },
                    {
                        y: <?php echo $e_other; ?>,
                        name: "Other",
                        exploded: false
                    }
                    ]
                }]
            });

            var ExpeneseLineChart = new CanvasJS.Chart("Expenese-Line", {
                animationEnabled: true,
                title: {
                    text: "Expenese in this week."
                },
                axisY: {
                    title: "Expenese",
                    valueFormatString: "#,###",
                    suffix: "THB"
                },
                data: [{
                    type: "line",
                    dataPoints: <?php echo json_encode($data_eiw, JSON_NUMERIC_CHECK); ?>
                }]
            });

            PieChart.render();
            PieExpenese.render();
            ExpeneseLineChart.render();
        }

        function explodePie(e) {
            if (typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e
                .dataPointIndex].exploded) {
                e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
            } else {
                e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
            }
            e.chart.render();

        }
    </script>
</body>

</html>