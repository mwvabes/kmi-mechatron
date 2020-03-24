<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Strefa użytkownika</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="styles/user_zone.css" />
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="index.html">Strona główna</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <main role="main" class="container starter-template">
        <div class="row">
            <div class="col">
                <div id="response"></div>
                <div id="content">
                    <h2>Zgłoś projekt</h2>
                    <form id='application-form'>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required />
                        </div>

                        <div class="form-group">
                            <label for="name">Imię</label>
                            <input type="text" class="form-control" name="name" id="name" required />
                        </div>

                        <div class="form-group">
                            <label for="surname">Nazwisko</label>
                            <input type="text" class="form-control" name="surname" id="surname" required />
                        </div>

                        <div class="form-group">
                            <label for="authors">Pozostali autorzy:</label>
                            <input type="text" class="form-control" name="authors" id="authors" />
                        </div>

                        <div class="form-group">
                            <label for="affiliation">Afiliacja</label>
                            <input type="text" class="form-control" name="affiliation" id="affiliation" required />
                        </div>

                        <div class="form-group">
                            <label for="title">Tytuł</label>
                            <input type="text" class="form-control" name="title" id="title" required />
                        </div>

                        <label for="category">Kategoria</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category" id="categoryradio1" value="projekt IT" checked>
                            <label class="form-check-label" for="categoryradio1">
                                projekt IT
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category" id="categoryradio2" value="freestyle">
                            <label class="form-check-label" for="categoryradio2">
                                freestyle
                            </label>
                        </div>

                        <label for="regulations" style="padding-top: 10px">Oświadczam, że zapoznałem/am się z treścią
                            Regulaminu zamieszczonego na stronie internetowej konferencji **STRONA**, przyjmuję do
                            wiadomości treści w nim zawarte i zobowiązuję się do przestrzegania jego zapisów</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check" type="checkbox" name="regulations" id="regulations" value="zaakceptowane" required>
                            <label class="form-check-label" for="regulations">Tak, oświadczam, że zapoznałem/am się z
                                treścią Regulaminu zamieszczonego na stronie internetowej konferencji mlodzi@urz.pl,
                                przyjmuję do wiadomości treści w nim zawarte i zobowiązuję się do przestrzegania jego
                                zapisów</label>
                        </div>

                        <button type='submit' class='btn btn-primary'>
                            Wyślij
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <script>
        $(document).on('submit', '#application-form', function() {
            var application_form = $(this);
            var form_data = JSON.stringify(application_form.serializeObject());

            $.ajax({
                url: "api/create_application.php",
                type: "POST",
                contentType: 'application/json',
                data: form_data,
                success: function(result) {
                    $('#response').html(
                        "<div class='alert alert-success'>Twoje zgłoszenie zostało zapisane pomyślnie.</div>"
                    );
                    $('#content').html("");
                    application_form.find('input').val('');

                },
                error: function(xhr, resp, text) {
                    $('#response').html(
                        "<div class='alert alert-danger'>Wystąpił błąd podczas wysyłania zgłoszenia.</div>"
                    );
                }
            });

            return false;
        });

        $.fn.serializeObject = function() {

            var o = {};
            var a = this.serializeArray();
            $.each(a, function() {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
    </script>
</body>

</html>