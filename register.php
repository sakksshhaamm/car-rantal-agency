<?php
    require('header.php');
    require('inc/config.php');
    if(isset($_SESSION['email'])){
        header("Location: index.php");
    }
    if(isset($_POST['submit'])){
        $email_address = mysqli_escape_string($db,$_POST['email']);
        $password = mysqli_escape_string($db,$_POST['password']);
   
        $query = "SELECT * FROM users WHERE email = '$email_address'";
        $result = mysqli_query($db,$query);
   
        if(mysqli_num_rows($result)==0){
            $query = "INSERT INTO users(email,pass,type) VALUES('$email_address','$password','customer')";
            $result = mysqli_query($db,$query);
            print(mysqli_error($db));
            $_SESSION['email'] = $email_address;  
            $_SESSION['user_id'] = $email_address;
            $_SESSION['type'] = 'customer';
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        }
        else{
              echo "<script type='text/javascript'>alert('Failed to Register! Email already exists.')</script>";
        }
    }
?>

<html>
    <head>
        <title>Register</title>
    </head>
    <body class="bg-light">
        <span class="border">
        <div class="container">
            <h1 class="display-3 text-muted">Register</h1>
            <hr>
            <form action="register.php" method="post">
                <div class="form-group">
                    <label class="form-label text-muted" for="email">Email: </label>
                    <input class="form-control" type="email" name="email" id="email"/>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password: </label>
                    <input class="form-control" type="password" name="password" id="password"/>
                </div>
                <div class="form-group">
                    <label class="form-label" for="cpassword">Confirm Password: </label>
                    <input class="form-control" type="password" name="cpassword" id="cpassword" onkeyup="validate()"/>
                </div>
                <div id="message" class="form-group text-muted">
                </div>
                <div class="row">
                    <div class="form-group col">
                        <button type="submit" class="btn btn-secondary w-25" id="submit" name="submit">Register</button>
                    </div>
                    <div class="form-group col-auto text-muted">
                        Already Have an account?
                        <a href="login.php" class="btn btn-warning" name="submit">LOGIN!</a>
                    </div>
                </div>
            </form>
        </div> 
    </span>
    </body>    
</html>

<script>
    document.getElementById("submit").disabled = true;
    function validate()
    {
        if(document.getElementById("password").value != document.getElementById("cpassword").value)
        {
            document.getElementById("message").innerHTML = "Error! Passwords do not match.";
            document.getElementById("submit").disabled = true;
        }
        else
        {
            document.getElementById("message").innerHTML = "";
            document.getElementById("submit").disabled = false;
        }
    }
</script>