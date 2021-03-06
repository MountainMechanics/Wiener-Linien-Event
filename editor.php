<?php
if(!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["login"]) && $_SESSION["login"]=="true"){
}else{
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">

    <!-- START: Bootstrap requires this -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/formStyles.css">
    <script src="js/form-validation.js"></script>
    <script src="js/auto-preview.js"></script>
    <!-- END: Bootstrap requires this -->

    <title>Event erstellen</title>
</head>
<body>

<!-- unified navbar START-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <img src="images/WL_logo.svg" id="logo">
            <a class="nav-item nav-link " href="home.php">Übersichtsseite</a>
            <a class="nav-item nav-link active" href="editor.php">Editor</a>
            <a class="nav-item nav-link" href="login.php?logout=true">Logout</a>
        </div>
    </div>
</nav>
<!-- unified navbar END-->


<!-- Statusbar navbar START-->
<div id="statusbar">
</div>
<!-- Statusbar navbar END-->

<div class="allContent">
    <div class="editor">
        <form name="eventCreator" class="needs-validation" novalidate method="POST" enctype="multipart/form-data">

            <!-- Event erstellung -------------------------------------------------- -->
            <!--
                This form is made to get information from the User so proper "Events" can be created.
                The information entered gets used in:
                    -the Email (created below this form)
                    -the Login-Website (the one for attendees)
                    -the Event-overview-site (home.php)
             -->
            <header class="row">
                <div class="col">
                    <!-- Heading and subheading -->
                    <h2 class="heading">Erstellen Sie ihr Event</h2>
                    <span class="subheading">Hier können Sie ihr Event erstellen</span>
                </div>
            </header>
            <div class="col" id="content">

                <!-- Event title -->
                <div class="e-spacing" >
                    <label for="eventTitel">Event-Titel</label><br>
                    <input class="custom-file-input" type="text" id="eventTitel" placeholder="Geben Sie Ihrem Event einen Namen" name="eventTitel" required>
                    <div class="invalid-feedback">
                        Ein Event braucht einen Namen
                    </div>
                </div>

                <!-- Event subtitle -->
                <div class="e-spacing" >
                    <label for="eventUTitel">Event-Untertitel</label><br>
                    <input type="text" id="eventUTitel" placeholder="Geben Sie eine Unterüberschrift ein" name="eventUTitel">
                </div>

                <!-- Datepicker for starting and ending dates-->

                <div class="e-spacing col">
                    <label for="pickDate">Wählen Sie ein Datum aus</label><br>
                    Datum:<span class="dateTimeWrapper">
                        <input name="date" id="pickDate" type="date" class="pickDate custom-file-input" required>
                        <div class="invalid-feedback">Bitte f&uuml;llen Sie dieses Feld aus.</div><br>
                    </span>
                    <label for="pickBeginTime">Beginn:</label><span class="dateTimeWrapper">
                        <input name="time-begin" id="pickBeginTime" type="time" class="dateTime custom-file-input" required>
                        <div class="invalid-feedback">Bitte f&uuml;llen Sie dieses Feld aus.</div>
                    </span>
                    <label for="pickEndTime">Ende:</label><span class="dateTimeWrapper">
                        <input name = "time-end" id = "pickEndTime" type="time" class="dateTime custom-file-input" required>
                        <div class="invalid-feedback">Bitte f&uuml;llen Sie dieses Feld aus.</div>
                    </span>
                </div>

                <!-- Geolocation -->
                <div class="col">
                    <label>Adresse</label><br>
                    <input class="geoloc custom-file-input" id="strasse" name="straße" type="text" placeholder="Straße/Gasse" required>
                    <div class="invalid-feedback">Bitte f&uuml;llen Sie dieses Feld aus.</div><br><br>

                    <input class="geoloc custom-file-input" id="hNummer" name="hNummer" type="number" minlength="1" placeholder="Hausnummer" required>
                    <div class="invalid-feedback">Bitte f&uuml;llen Sie dieses Feld aus.</div><br><br>

                    <input class="geoloc custom-file-input" id="plz" name="plz" minlength="4" maxlength="4" size="4" type="number" placeholder="PLZ" required>
                    <div class="invalid-feedback">Bitte f&uuml;llen Sie dieses Feld aus.</div><br><br>

                    <input class="geoloc custom-file-input" id="ort" name="ort" type="text" placeholder="Ort" required>
                    <div class="invalid-feedback">Bitte f&uuml;llen Sie dieses Feld aus.</div>
                </div>

                <!-- Fileuploads START-->

                <!-- Mail-Picture -->
                <div class="e-text">
                    <label class="fileLabel" for="validatedCustomFile">Wählen Sie ein Bild aus</label><br>
                    <div class="custom-file mx-auto fileupload">
                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="event-picture" accept="image/*" required>
                        <label class="custom-file-label" for="validatedCustomFile">Datei auswählen...</label>
                        <div class="invalid-feedback">Es wurde keine Datei ausgew&auml;hlt.</div>
                    </div>
                </div>

                <!-- Agenda -->
                <div class="e-text" >
                    <label class="agendaLabel" for="agendaCustomFile">Wählen Sie eine Agenda aus</label><br>
                    <div class="custom-file mx-auto fileupload">
                        <input type="file" class="custom-file-input" id="agendaCustomFile" name="event-agenda" accept=".pdf" required>
                        <label class="custom-file-label" for="validatedCustomFile">Datei auswählen...</label>
                        <div class="invalid-feedback">Es wurde keine Datei ausgew&auml;hlt.</div>
                    </div>
                </div>

                <!-- Fileuploads ende -->

                <!-- more information -->
                <div class="event-info">
                    <!-- Attendees (as an Excel File)-->
                    <div class="e-text">
                        <label class="agendaLabel" for="agendaCustomFile">Wählen Sie ein Excel-File mit Teilnehmern</label><br>
                        <div class="custom-file mx-auto fileupload">
                            <input type="file" class="custom-file-input" id="sendTo" name="event-users" accept=".xlsx, .xlsm, .xls, .xlsb" required>
                            <label class="custom-file-label" for="sendTo">Datei auswählen...</label>
                            <div class="invalid-feedback">Es wurde keine Datei ausgew&auml;hlt.</div>
                        </div>
                    </div>

                    <!-- textarea for more information about the event -->
                    <div class="col">
                        <label>Eventbeschreibung</label><br>
                        <textarea class="form-check-label" id="eventDescription" name="event-descr" placeholder="Beschreiben Sie Ihr Event" ></textarea>
                        <div class="invalid-feedback">
                            Bitte geben Sie eine Eventbeschreibung an.
                        </div>
                    </div>
                </div>

                <!-- Space for a additional message in the E-mail -->
                <div class="detail-wrapper">
                    <label>Email-Details</label><br>
                    <textarea class="form-check-label" id="event-details" name="event-detail" placeholder="Geben Sie hier die Email-Details an" ></textarea>
                    <div class="invalid-feedback">
                        Bitte geben Sie Details an.
                    </div>
                </div>
            </div>

            <!-- Submit and reset buttons -->
            <div>
                <button type="submit" onclick="setStatusbar()" class="btn btn-primary btn-sm">Senden</button>
                <button type="reset" class="btn btn-info btn-sm">Zurücksetzen</button>
            </div>
        </form>
    </div>

    <!-- Live Preview -->
    <div class="live-view">
        <section>
            <object id="bild" data="images/WL_logo.svg" type="image/svg+xml">Ihr Browser kann leider kein svg darstellen.</object>
            <h5>Pers&ouml;nliche Einladung</h5>
            <h2 class="preview-title">*Titel*</h2>
            <div id="b1">
                <h6 class="preview-date-begin">*Datum Beginn*</h6>
                <h6 class="preview-date-end">*Datum Ende*</h6>
                <h6 class="preview-street">*Straße* *Hausnummer*</h6>
                <h6 class="preview-plz-loc">*PLZ* *Ort*</h6>
            </div>
        </section>
        <br>
        <img class="preview-pic" src="https://leaderonomics.com/wp-content/uploads/2018/07/Double-exposure-concept-with-thinking-businessman-and-city_BUSINESS_BUILDING_USED-770x470.jpg">
        <section>
            <p id="begruessung">Sehr geehrte/r Herr/Frau Max Mustermann,<p>
            <p id="t2" class="preview-opening">*Opening*</p>
        </section>
        <button class="btn btn-primary">Anmeldung & Details</button>
    </div>
    </div>
</div>

<!-- Bootstrap scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>

<?php
require 'src/Mail.php';
require 'DB/UserDatabase.php';
require 'src/Token.php';
require 'src/DBConnector.php';
require 'src/XLSXReader.php';

$config = new \Doctrine\DBAL\Configuration();
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

if(isset($_POST['eventTitel']) && isset($_FILES['event-users']) && isset($_FILES['event-agenda']) && isset($_FILES['event-picture'])){

    DBConnector::createEvent($conn);
    $recipients = XLSXReader::readXlsxFile($_FILES['event-users']['tmp_name']);
    foreach ($recipients as &$recipient){
        $recipient['token'] = WienerLinien\Token::generateToken();
    }

    DBConnector::createParticipants($conn,$recipients);

    Mail::sendMail($recipients);
    echo '<script>                    
                var div = document.createElement("div");
                div.textContent = "Eventeinladungen erfolgreich verschickt";
                div.setAttribute("class","alert alert-success");
                div.setAttribute("role","alert");
                document.getElementById("statusbar").appendChild(div);  
            </script>';

}

?>