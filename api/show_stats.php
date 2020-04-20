<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style>
    canvas {
        width: 100%;
    }

    div.chart {
        position: relative;
        width: 60vw;
        margin: 20px auto;
        height: 80vh;
    }

    #affiliationChart {
        width: 1200px;
    }

    #affiliationChartAxis {
        height: 300px;
        width: 0px;
    }

    h3 {
        padding-top: 10px;
        text-align: center;
    }

    .chart>canvas {
        position: absolute;
        left: 0;
        top: 0;
        pointer-events: none;
    }

    .chartAreaWrapper {
        height: 100%;
        width: 60vw;
        overflow-x: scroll;
    }

    @media screen and (max-width: 750px) {
        div.chart {
            width: 100%;
        }

        .chartAreaWrapper {
            width: 100%;
        }
    }

    @media screen and (max-width: 750px) and (orientation: landscape) {
        div.chart {
            height: 80vh;
        }

        .chartAreaWrapper {
            width: 100%;
        }
    }
</style>

<div class="contentScrollX">
<h2>Statystyki</h2>
<h3>Kategorie projektów</h3>
<div class='chart'><canvas id="categoryChart"></canvas></div>
<h3>Afiliacje</h3>
<div class="chart">
    <div class="chartAreaWrapper">
        <canvas id="affiliationChart"></canvas>
    </div>
    <canvas id="affiliationChartAxis"></canvas>
</div>
<h3>Statusy zgłoszeń</h3>
<div class='chart'><canvas id="statusChart"></canvas></div>
<h3>Zgłoszenia w czasie</h3>
<div class='chart'><canvas id="dateChart"></canvas></div>
</div>
<?php

include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

$stmt = $db->prepare('SELECT category, COUNT(*) AS quantity FROM application GROUP BY category');
$stmt->execute();
$application = $stmt->fetchAll(PDO::FETCH_ASSOC);
$category = json_encode($application);

$stmt = $db->prepare('SELECT affiliation, COUNT(*) AS quantity FROM application GROUP BY affiliation ORDER BY quantity');
$stmt->execute();
$application = $stmt->fetchAll(PDO::FETCH_ASSOC);
$affiliation = json_encode($application);

// $stmt = $db->prepare('SELECT status, COUNT(*) AS quantity FROM application GROUP BY status');
$stmt = $db->prepare('SELECT a.status AS status, MAX(a.quantity) AS quantity FROM ( SELECT status, COUNT(*) AS quantity FROM application GROUP BY status UNION SELECT "zaakceptowane" AS status, 0 AS quantity FROM dual UNION SELECT "złożone" AS status, 0 AS quantity FROM dual UNION SELECT "odrzucone" AS status, 0 AS quantity FROM dual ) a GROUP BY status ORDER BY status');
$stmt->execute();
$application = $stmt->fetchAll(PDO::FETCH_ASSOC);
$status = json_encode($application);

// $stmt = $db->prepare('SELECT DATE(application_date) AS application_date, COUNT(*) AS quantity FROM application GROUP BY application_date');
$stmt = $db->prepare("SELECT a.application_date AS application_date, MAX(a.quantity) AS quantity FROM (SELECT DATE(application_date) AS application_date, COUNT(*) AS quantity FROM application GROUP BY application_date UNION SELECT DATE('2020-03-01') AS application_date, 0 AS quantity FROM dual UNION SELECT DATE('2020-04-27') AS application_date, 0 AS quantity FROM dual) a GROUP BY a.application_date ORDER BY a.application_date");
$stmt->execute();
$application = $stmt->fetchAll(PDO::FETCH_ASSOC);
$dates = json_encode($application);

?>

<script>
    var data = <?php echo $category; ?>;

    var labelCategory = new Array();
    var quantityCategory = new Array();

    for (var i = 0; i < data.length; i++) {
        labelCategory[i] = data[i].category;
        quantityCategory[i] = data[i].quantity;
    }

    var ctxCategory = document.getElementById('categoryChart').getContext('2d');
    var vcategoryChart = new Chart(ctxCategory, {
        type: 'doughnut',
        data: {
            labels: labelCategory,
            datasets: [{
                label: 'Ilość zgłoszeń',
                data: quantityCategory,
                backgroundColor: palette('mpn65', quantityCategory.length).map(function(hex) {
                    return '#' + hex;
                })
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    var data = <?php echo $affiliation; ?>;

    var labelAffiliation = new Array();
    var quantityAffiliation = new Array();

    for (var i = 0; i < data.length; i++) {
        labelAffiliation[i] = data[i].affiliation;
        quantityAffiliation[i] = data[i].quantity;
    }

    var ctxAffiliation = document.getElementById('affiliationChart').getContext('2d');
    var vaffiliationChart = new Chart(ctxAffiliation, {
        type: 'bar',
        data: {
            labels: labelAffiliation,
            datasets: [{
                label: 'Ilość zgłoszeń',
                data: quantityAffiliation,
                backgroundColor: palette('mpn65', quantityAffiliation.length).map(function(hex) {
                    return '#' + hex;
                })
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    ticks: {
                        autoSkip: true,
                        maxRotation: 90,
                        minRotation: 90
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 20
                }
            }
        }
    });

    var data = <?php echo $status; ?>;

    var labelStatus = new Array();
    var quantityStatus = new Array();

    for (var i = 0; i < data.length; i++) {
        labelStatus[i] = data[i].status;
        quantityStatus[i] = data[i].quantity;
    }

    var ctxStatus = document.getElementById('statusChart').getContext('2d');
    var vstatusChart = new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: labelStatus,
            datasets: [{
                label: 'Ilość zgłoszeń',
                data: quantityStatus,
                backgroundColor: ["rgb(255, 0, 41)", "rgb(102, 166, 30)", "rgb(255, 127, 0)"],
                // backgroundColor: palette('mpn65', quantityStatus.length).map(function(hex) {
                //     return '#' + hex;
                // })
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });


    var data = <?php echo $dates; ?>;

    var labelDates = new Array();
    var quantityDates = new Array();

    for (var i = 0; i < data.length; i++) {
        labelDates[i] = data[i].application_date;
        quantityDates[i] = data[i].quantity;
    }

    var ctxDates = document.getElementById('dateChart').getContext('2d');
    var vdateChart = new Chart(ctxDates, {
        type: 'line',
        data: {
            labels: labelDates,
            datasets: [{
                label: 'Ilość zgłoszeń',
                data: quantityDates,
                backgroundColor: "rgb(55, 126, 184)"
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
        }
    });
</script>