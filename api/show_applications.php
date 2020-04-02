<style>
    .success {
        color: white;
        background-color: #28a745;
        margin-left: 5px;
    }

    .warning {
        color: white;
        background-color: #ffc107;
        margin-left: 5px;
    }

    .danger {
        color: white;
        background-color: #dc3545;
        margin-left: 5px;
    }

    button.fsm {
        border: none;
        background-color: transparent;
    }

    button.fsm i {
        cursor: pointer;
    }

    i.fas.fa-check {
        color: #28a745;
    }

    i.fas.fa-ban,
    i.far.fa-trash-alt {
        color: #dc3545;
    }

    form {
        float: left;
    }

    div.buttons-container {
        width: 100px;
    }
</style>

<h2>Zgłoszenia</h2>
<div id="table-sortable"></div>

<?php
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
$stmt = $db->prepare("SET @row_number:=0");
$stmt->execute();
$stmt = $db->prepare('SELECT @row_number:=@row_number+1 AS num, application.id as idd, email, CONCAT(firstname, " ", lastname) AS author, authors, affiliation, title, category, status FROM application INNER JOIN users ON (application.user_id = users.id)  ORDER BY application.id');
$stmt->execute();
$application = $stmt->fetchAll(PDO::FETCH_ASSOC);

$json = json_encode($application);

?>

<script>
    var data = <?php echo $json; ?>;

    for (var i = 0; i < data.length; i++) {
        var bc;
        switch (data[i].status) {
            case "złożone": {
                bc = "warning";
                break;
            }
            case "zaakceptowane": {
                bc = "success";
                break;
            }
            case "odrzucone": {
                bc = "danger";
                break;
            }
        }
        data[i].title = "<p>".concat(data[i].title, "<span id=", data[i].idd, " class='badge ", bc, "'>", data[i].status, "</span></p>");
        data[i].accept = "<div class='buttons-container'><form class='applicationsAction' data-action='zaakceptowane' id=".concat(data[i].idd, "><button type='submit' class='fsm'><i class='fas fa-check'></i></button></form>",
            "<form class='applicationsAction' data-action='odrzucone' id=", data[i].idd, "><button type='submit' class='fsm'><i class='fas fa-ban'></i></button></form>",
            "<form class='applicationsAction' data-action='delete' id=", data[i].idd, "><button type='submit' class='fsm'><i class='far fa-trash-alt'></i></button></form></div>"
        );
    }
    var columns = {
        'num': '#',
        'email': 'Email',
        'author': 'Autor',
        'authors': 'Zespół',
        'affiliation': 'Afiliacja',
        'category': 'Kategoria',
        'title': 'Tytuł',
        'accept': 'Akcje'
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
                    'category': 'Kategoria',
                    'title': 'Tytuł',
                    'accept': 'Akcje'
                },
            },
            1000: {
                columns: {
                    'email': 'Email',
                    'title': 'Tytuł',
                    'accept': 'Akcje'
                },
            },
            850: {
                rowsPerPage: 2,
                columns: {
                    'title': 'Tytuł',
                    'accept': 'Akcje'
                },
            }
        }
    });

    $('#changeRows').on('change', function() {
        table.updateRowsPerPage(parseInt($(this).val(), 10));
    })
</script>