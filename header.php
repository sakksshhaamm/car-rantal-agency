<?php
require('inc/config.php');
session_start();
?>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
    <nav class="navbar navbar-expand-lg fixed-top navbar navbar-dark bg-primary"">
        <a class="navbar-brand" href="#">CAR RENTAL</a>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home </a>
                </li>
                <?php if(isset($_SESSION['type']) && $_SESSION['type']=='agency'){?>
                <li class="nav-item">
                    <a class="nav-link" href="addcar.php">Add Cars</a>
                </li>
                <?php }?>
                <li class="nav-item">
                    <a class="nav-link" href="bookings.php">View Bookings</a>
                </li>
            </ul>
        
            <ul class="navbar-nav ml-auto">
                <?php if(isset($_SESSION['email'])){?>
                    <li class="nav-item align-middle">
                        <a class="nav-link text-light"><?php echo $_SESSION['email']?></a>
                    </li>
                    <li class="nav-item">
                        <a class=" btn btn-secondary active" href="logout.php">LOG OUT</a>
                    </li>
                <?php } else{?>
                    <li class="nav-item">
                    <a  class=" btn btn-secondary active" href="login.php">LOG IN</a>
                    </li>
                <?php } ?>

            </ul>
        </div>
    </nav>
    <br>
    <br>
</body>
</html>


