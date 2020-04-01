<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
<script src="api/libs/table-sortable/table-sortable.js"></script>
<link rel="stylesheet" href="api/libs/table-sortable/table-sortable.css" />

<h2>Moje zgłoszenia</h2>
<div id="response"></div>
<div id="table-sortable"></div>

<?php

include_once 'config/database.php';

$user_id = htmlspecialchars($_COOKIE["uid"]);

$database = new Database();
$db = $database->getConnection();
$stmt = $db->prepare("SET @row_number:=0");
$stmt->execute();
$stmt = $db->prepare('SELECT @row_number:=@row_number+1 AS num, authors, affiliation, title, category, status FROM application WHERE user_id = :user_id');
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$application = $stmt->fetchAll(PDO::FETCH_ASSOC);

$json = json_encode($application);

?>

<script>
    var data = <?php echo $json; ?>;
    if (data.length == 0) {
        $('#response').html(
            "<div class='alert alert-success'>Nie masz jeszcze żadnych zgłoszeń</div>"
        );
    } else {
        for (var i = 0; i < data.length; i++) {
            var bc;
            switch (data[i].status) {
                case "złożone": {
                    bc = "orange";
                    break;
                }
                case "zaakceptowane": {
                    bc = "green";
                    break;
                }
                case "odrzucone": {
                    bc = "red";
                    break;
                }
            }
            data[i].title = "<p>".concat(data[i].title, "<span style='margin-left: 5px; color: white; background-color: ", bc, "' class='badge bagde-primary'>", data[i].status, "</span></p>");
        }

        var columns = {
            'num': '#',
            'authors': 'Zespół',
            'affiliation': 'Afiliacja',
            'title': 'Tytuł',
            'category': 'Kategoria',
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
                        'title': 'Tytuł',
                        'category': 'Kategoria'
                    },
                },
                850: {
                    rowsPerPage: 2,
                    columns: {
                        'title': 'Tytuł'
                    },
                }
            }
        });

    }

    $('#changeRows').on('change', function() {
        table.updateRowsPerPage(parseInt($(this).val(), 10));
    })
</script>