<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <?php
        require('db.php');
        // If form valido, invio a db
        if (isset($_REQUEST['username'])) {
            // formattazione sicura per invio a db
            $username = stripslashes($_REQUEST['username']);
            $username = mysqli_real_escape_string($con,$username);
            $email = stripslashes($_REQUEST['email']);
            $email = mysqli_real_escape_string($con,$email);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con,$password);
            $trn_date = date("Y-m-d H:i:s");
            
            $query = "INSERT into `users` (username, password, email, trn_date)
            VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
            $result = mysqli_query($con,$query);
            if($result){
            echo "<div class='form'>
                <h3>You are registered successfully.</h3>
                <br/>Click here to <a href='login.php'>Login</a></div>";
            }

        }
        else {
    ?>
            <section class="retroBox">
                <div class="wrapper">
                    <h1>Registrazione</h1>
                    <form name="registration" action="" method="post">
                        <input type="text" name="username" placeholder="Username" required /><br>
                        <input type="email" name="email" placeholder="Email" required /><br>
                        <input type="password" name="password" placeholder="Password" required /><br><br>
                        <button type="submit" name="submit" class="retroButton">Registrati</button>
                    </form>
                    <p>Sei già registrato? Effettua il <a href="login.php">login</a>!</p>
                </div>
            </section>
    <?php } ?>
    </body>
</html>