<!DOCTYPE html>
<html>
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <title>Registration</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

        <section class="retroBox">
            <div class="wrapper">
                <h1>Registrazione</h1>
                <form name="registration" action="checks.php" method="POST">
                    <input type="text" name="username" placeholder="Username" /><br>
                    <input type="text" name="email" placeholder="Email" /><br>
                    <input type="password" name="password" placeholder="Password" /><br>
                    <input type="password" name="cpassword" placeholder="Conferma password" /><br><br>
                    <?php
                        if (isset($_GET['errorMessage'])){
                            echo '<div class="error">';
                            echo '<p>' . $_GET['errorMessage'] . '</p>';
                            echo '</div>';
                        }
                    ?>
                    <button type="submit" name="submit" class="retroButton">Registrati</button>
                </form>
                <p>Sei già registrato? Effettua il <a href="login.php">login</a>!</p>
            </div>
        </section>
    </body>
</html>