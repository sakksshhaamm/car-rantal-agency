<?php
    require('header.php');
    require('inc/config.php');
    if(isset($_SESSION['email'])){
        header("Location: index.php");
    }
    if(isset($_POST['submit'])){
        $email_address = mysqli_escape_string($db,$_POST['email']);
        $password = mysqli_escape_string($db,$_POST['password']);
   
        $query = "SELECT * FROM users WHERE email = '$email_address' AND pass= '$password'";
        $result = mysqli_query($db,$query);
   
        if(mysqli_num_rows($result)==1){
              $_SESSION['email'] = $email_address;
              while($row = $result->fetch_assoc()) {
                   $_SESSION['user_id'] = $row['id'];
                   $_SESSION['type'] = $row['type'];
               }
              $_SESSION['success'] = "You are now logged in";
              header('location: index.php');
        }
        else{
              echo "<script type='text/javascript'>alert('Failed to Login! Incorrect Email or Password')</script>";
        }
    }
?>

<html>
    <head>
        <title>Log In</title>
    </head>
    <body class="bg-light">
        <span class="border">
        <div class="container">
            <h1 class="display-3 text-muted">Log In</h1>
            <hr>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label class="form-label text-muted" for="email">Email: </label>
                    <input class="form-control" type="email" name="email" id="email"/>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password: </label>
                    <input class="form-control" type="password" name="password" id="password"/>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <button type="submit" class="btn btn-secondary w-25" name="submit">Log In</button>
                    </div>
                    <div class="form-group col-auto text-muted">
                        Not registered?
                        <a href="register.php" class="btn btn-warning" name="submit">REGISTER!</a>
                        <a href="agencyregister.php" class="btn btn-danger" name="submit">AGENCY REGISTER?</a>
                    </div>
                </div>
            </form>
        </div> 
    </span>
    </body>    
</html>
