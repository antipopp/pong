        // if form valido, invio a db
        if (isset($_POST['username']) && isset($_POST['password'])) {

            // formattazione per invio a db
            $username = stripslashes($_POST['username']);
            $username = mysqli_real_escape_string($con,$username);
            $email = stripslashes($_POST['email']);
            $email = mysqli_real_escape_string($con,$email);
            $password = stripslashes($_POST['password']);
            $password = mysqli_real_escape_string($con,$password);
            $cpassword = stripslashes($_POST['cpassword']);
            $cpassword = mysqli_real_escape_string($con,$cpassword);
            $trn_date = date("Y-m-d H:i:s");

            // controllo email
            $validEmailQuery = "SELECT * FROM users WHERE email='$email'";
            $validEmailResult = mysqli_query($con,$validEmailQuery);
            if ($validEmailResult){
                
                $msg = "Email già registrata";

                /*echo "<section class='retroBox'>
                    <div class='wrapper'>
                        <h3>Email già registrata</h3>
                        <br/>Cicca qui per tornare alla <a href='registration.php'>registrazione</a>!
                    </div>
                  </section>";*/
            }
            else if($password != $cpassword){
                
                $msg = "Le password non coincidono";

                /*echo "<section class='retroBox'>
                    <div class='wrapper'>
                        <h3>Le password non corrispondono</h3>
                        <br/>Cicca qui per tornare alla <a href='registration.php'>registrazione</a>!
                    </div>
                  </section>";*/
            }
            else{
                $insertQuery = "INSERT into users (username, password, email, trn_date)
                VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
                $insertResult = mysqli_query($con,$insertQuery);
                if ($insertResult){
                echo "<section class='retroBox'>
                        <div class='wrapper'>
                            <h3>Registrazione avvenuta con successo</h3>
                            <br/>Cicca qui per andare al <a href='login.php'>login</a>!
                        </div>
                      </section>";
                }
            }
        }
        else {
    ?>
            <section class="retroBox">
                <div class="wrapper">
                    <h1>Registrazione</h1>
                    <form name="registration" action="" method="POST">
                        <input type="text" name="username" placeholder="Username" required /><br>
                        <input type="email" name="email" placeholder="Email" required /><br>
                        <input type="password" name="password" placeholder="Password" required /><br>
                        <input type="password" name="cpassword" placeholder="Conferma password" required /><br><br>
                        <button type="submit" name="submit" class="retroButton">Registrati</button>
                    </form>
                    <p>Sei già registrato? Effettua il <a href="login.php">login</a>!</p>
                </div>
            </section>
    <?php } ?>