<?php
// Start the session
if(!isset($_SESSION))
{
    session_start();
}

echo '
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Übersichtsseite Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <img src="images/WL_logo.svg" id="logo">
            <a class="nav-item nav-link" href="home.php">Übersichtsseite</a>
            <a class="nav-item nav-link" href="editor.php">Editor</a>
        </div>
    </div>
</nav>
<div id="statusbar">
</div>
    <div class="border" id="formular">

        <form class="needs-validation" novalidate method="post" action="login.php">
            <div class="form-group">

                <div>
                    <div class="formelement" id="formularelementtop">
                        <label for="InputUsername">Username</label>
                        <input type="text" name="username" class="form-control" id="InputUsername" aria-describedby="usernameHelp" placeholder="Username" required>
                    </div>
                    <div class="formelement">
                        <label for="InputPassword">Password</label>
                        <input type="password" name="pw" class="form-control" id="InputPassword" placeholder="Password" required>
                    </div>

                <div class="form-group">

                </div>

                    <div class="formelement">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                </div>
            </div>
        </form>
    </div>

</body>
</html>
';
if(isset($_GET["invalid"]) && $_GET["invalid"] == "true") {
    echo '<script>                    
                var div = document.createElement("div");
                div.textContent = "Username bzw. Passwort falsch!";
                div.setAttribute("class","alert alert-danger");
                div.setAttribute("role","alert");
                document.getElementById("statusbar").appendChild(div);  
            </script>';
}