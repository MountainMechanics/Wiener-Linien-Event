<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <!-- START: Bootstrap requires this -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/formStyles.css">
        <script src="scripts/form-validation.js"></script>
        <!-- END: Bootstrap requires this -->

        <title>Event erstellen</title>
    </head>
    <body>

    <!-- unified navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <img src="imgs/Logo.svg" id="logo">
                    <a class="nav-item nav-link " href="index_old.html">Übersichtsseite</a>
                    <a class="nav-item nav-link active" href="editor.php">Editor</a>
                </div>
            </div>
        </nav>
    <!-- unified navbar END-->
        <div class="allContent">
            <div class="editor">
                <form name="eventCreator" class="needs-validation" novalidate>

                    <!-- Event erstellung -------------------------------------------------- -->
                    <header class="row">
                        <div class="col">
                            <h2 class="heading">Erstellen Sie ihr Event</h2>
                            <span class="subheading">Hier können Sie ihr Event erstellen</span>
                        </div>
                    </header>
                    <div class="col" id="content">

                        <!-- Event titel -->
                        <div class="e-spacing" >
                            <label for="eventTitel">Event-Titel</label><br>
                            <input type="text" id="eventTitel" placeholder="Title your event" name="eventTitel" required>
                            <div class="invalid-feedback">
                                Ein Event braucht einen Namen
                            </div>
                        </div>

                        <!-- Event untertitel -->
                        <div class="e-spacing" >
                            <label for="eventUTitel">Event-Untertitel</label><br>
                            <input type="text" id="eventUTitel" placeholder="Add a subheading" name="eventUTitel">
                        </div>

                        <!-- Datepicker -->

                        <div class="e-spacing col">
                            <label for="pickDate">Wählen Sie ein Datum aus</label><br>
                            Datum: <span class="dateTimeWrapper"><input name="date" id="pickDate" type="date" class="dateTime" required></span>
                            Beginn: <span class="dateTimeWrapper"><input name="date" id="pickBeginTime" type="time" class="dateTime" required></span>
                            Ende: <span class="dateTimeWrapper"><input name="date" id="pickEndTime" type="time" class="dateTime" required></span>
                        </div>

                        <!-- File upload -->
                        <div class="e-text">
                            <label class="fileLabel" for="validatedCustomFile">Wählen Sie ein Bild aus</label><br>
                            <div class="custom-file mx-auto fileupload">
                                <input type="file" class="custom-file-input" id="validatedCustomFile" name="event-picture" accept="image/*" required>
                                <label class="custom-file-label" for="validatedCustomFile">Datei auswählen...</label>
                                <div class="invalid-feedback">Es wurde keine Datei ausgew&auml;hlt.</div>
                            </div>
                        </div>

                        <div class="e-text" >
                            <label class="agendaLabel" for="agendaCustomFile">Wählen Sie eine Agenda aus</label><br>
                            <div class="custom-file mx-auto fileupload">
                                <input type="file" class="custom-file-input" id="agendaCustomFile" name="event-agenda" required>
                                <label class="custom-file-label" for="validatedCustomFile">Datei auswählen...</label>
                                <div class="invalid-feedback">Es wurde keine Datei ausgew&auml;hlt.</div>
                            </div>
                        </div>

                        <!-- Fileupload ende -->


                        <!-- Event Beschreibung -->
                        <div class="event-info">
                            <!-- Adressaten -->
                            <div class="e-text">
                                <label class="agendaLabel" for="agendaCustomFile">Wählen Sie ein Excel-File mit Teilnehmern</label><br>
                                <div class="custom-file mx-auto fileupload">
                                    <input type="file" class="custom-file-input" id="sendTo" name="event-agenda" accept=".xlsx, .xlsm, .xls, .xlsb" required>
                                    <label class="custom-file-label" for="sendTo">Datei auswählen...</label>
                                    <div class="invalid-feedback">Es wurde keine Datei ausgew&auml;hlt.</div>
                                </div>
                            </div>

                            <div class="col">
                                <label>Eventbeschreibung</label><br>
                                <textarea class="form-check-label" id="eventDescription" name="event-descr" placeholder="Write a description here" ></textarea>
                                <div class="invalid-feedback">
                                    Bitte geben Sie eine Eventbeschreibung an.
                                </div>
                            </div>
                        </div>

                        <div class="detail-wrapper">
                            <label>Email-Details</label><br>
                            <textarea class="form-check-label" id="event-details" name="event-detail" placeholder="Geben Sie hier die Email-Details an" ></textarea>
                            <div class="invalid-feedback">
                                Bitte geben Sie Details an.
                            </div>
                        </div>
                    </div>
                    <!-- Reminder section ------------
                    <div class="row">
                        Toggle (on/off)
                        Datepicker
                        Message
                    </div>


                    <div class="form-group"> Date input
                    <label class="control-label" for="date">Date</label>
                    <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text"/>
                    </div>
                    ---------------------------------- -->


                    <div>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d10639.38577350909!2d16.40391135!3d48.190310049999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sde!2sat!4v1557234275790!5m2!1sde!2sat" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>


                    <div>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        <button type="reset" class="btn btn-info btn-sm">Reset</button>
                    </div>
                </form>
            </div>
            <div class="live-view">
                 lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem
            </div>
        </div>

        <!-- Bootstrap scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </body>
</html>