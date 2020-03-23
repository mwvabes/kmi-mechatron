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
$stmt = $db->prepare("SELECT @row_number:=@row_number+1 AS num, email, name, surname, authors, affiliation, title, category, regulations FROM application ORDER BY id");
$stmt->execute();
$application = $stmt->fetchAll(PDO::FETCH_ASSOC);

$json = json_encode($application);

?>

<script>
    var data = <?php echo $json; ?>;

    var columns = {
        'num': '#',
        'email': 'Email',
        'name': 'Imię',
        'surname': 'Nazwisko',
        'authors': 'Autorzy',
        'affiliation': 'Afiliacja',
        'title': 'Tytuł',
        'category': 'Kategoria',
        'regulations': 'Regulacje'
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
                    'affiliation': 'Afiliacja',
                    'category': 'Kategoria'
                },
            },
            1000: {
                columns: {
                    'email': 'Email',
                    'title': 'Tytuł',
                    'category': 'Kategoria'
                },
            },
            850: {
                rowsPerPage: 2,
                columns: {
                    'email': 'Email',
                    'title': 'Tytuł'
                },
            }
        }
    });

    $('#changeRows').on('change', function() {
        table.updateRowsPerPage(parseInt($(this).val(), 10));
    })
</script>