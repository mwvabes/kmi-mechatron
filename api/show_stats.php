<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style>
    canvas {
        width: 100%;
    }

    div.chart {
        position: relative;
        width: 60vw;
        margin: 20px auto;
    }

    h3 {
        padding-top: 10px;
        text-align: center;
    }
</style>

<h2>Statystyki</h2>
<h3>Kategorie projektów</h3>
<div class='chart'><canvas id="categoryChart"></canvas></div>
<h3>Afiliacje</h3>
<div class='chart'><canvas id="affiliationChart"></canvas></div>
<h3>Statusy zgłoszeń</h3>
<div class='chart'><canvas id="statusChart"></canvas></div>
<?php

include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

$stmt = $db->prepare('SELECT category, COUNT(*) AS quantity FROM application GROUP BY category');
$stmt->execute();
$application = $stmt->fetchAll(PDO::FETCH_ASSOC);
$category = json_encode($application);

$stmt = $db->prepare('SELECT affiliation, COUNT(*) AS quantity FROM application GROUP BY affiliation');
$stmt->execute();
$application = $stmt->fetchAll(PDO::FETCH_ASSOC);
$affiliation = json_encode($application);

$stmt = $db->prepare('SELECT status, COUNT(*) AS quantity FROM application GROUP BY status');
$stmt->execute();
$application = $stmt->fetchAll(PDO::FETCH_ASSOC);
$status = json_encode($application);

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
    var categoryChart = new Chart(ctxCategory, {
        type: 'doughnut',
        data: {
            labels: labelCategory,
            datasets: [{
                label: '# of Applications',
                data: quantityCategory,
                backgroundColor: palette('mpn65', quantityCategory.length).map(function(hex) {
                    return '#' + hex;
                })
            }]
        },
        options: {
            responsive: true,
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
    var affiliationChart = new Chart(ctxAffiliation, {
        type: 'bar',
        data: {
            labels: labelAffiliation,
            datasets: [{
                label: '# of Applications',
                data: quantityAffiliation,
                backgroundColor: palette('mpn65', quantityAffiliation.length).map(function(hex) {
                    return '#' + hex;
                })
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: false
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
    var statusChart = new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: labelStatus,
            datasets: [{
                label: '# of Applications',
                data: quantityStatus,
                backgroundColor: palette('mpn65', quantityStatus.length).map(function(hex) {
                    return '#' + hex;
                })
            }]
        },
        options: {
            responsive: true,
        }
    });
</script>