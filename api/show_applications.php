<script src="api/libs/table-sortable/table-sortable.js"></script>
<link rel="stylesheet" href="api/libs/table-sortable/table-sortable.css" />

<h2>Zgłoszenia</h2>
<div id="table-sortable"></div>

<?php
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
$stmt = $db->prepare("SET @row_number:=0");
$stmt->execute();
$stmt = $db->prepare('SELECT @row_number:=@row_number+1 AS num, application.id as idd, email, firstname, lastname, authors, affiliation, title, category, status FROM application INNER JOIN user ON (application.user_id = user.id)  ORDER BY application.id');
$stmt->execute();
$application = $stmt->fetchAll(PDO::FETCH_ASSOC);

$json = json_encode($application);

?>

<script>
    var data = <?php echo $json; ?>;

    for (var i = 0; i < data.length; i++) {
        data[i].accept = "<form class='acceptButton' id=".concat(data[i].idd, "><button type='submit'", data[i].status == "zaakceptowane" ? 'disabled' : '', ">Akceptuj</button></form>");
        data[i].status = "<p class='statusP' id=".concat(data[i].idd, ">", data[i].status, "</p>");
    }

    var columns = {
        'num': '#',
        'email': 'Email',
        'firstname': 'Imię',
        'lastname': 'Nazwisko',
        'authors': 'Autorzy',
        'affiliation': 'Afiliacja',
        'title': 'Tytuł',
        'category': 'Kategoria',
        'status': 'Status',
        'accept': 'Akceptuj'
    }

    var table = $('#table-sortable').tableSortable({
        data: data,
        columns: columns,
        rowsPerPage: 5,
        pagination: true,
        onPaginationChange: function(nextPage, setPage) {
            setPage(nextPage);
        },
        responsive: {
            1200: {
                columns: {
                    'email': 'Email',
                    'title': 'Tytuł',
                    'category': 'Kategoria',
                    'accept': 'Akceptuj'
                },
            },
            1000: {
                columns: {
                    'email': 'Email',
                    'title': 'Tytuł',
                    'accept': 'Akceptuj'
                },
            },
            850: {
                rowsPerPage: 2,
                columns: {
                    'title': 'Tytuł',
                    'accept': 'Akceptuj'
                },
            }
        }
    });

    $('#changeRows').on('change', function() {
        table.updateRowsPerPage(parseInt($(this).val(), 10));
    })
</script>