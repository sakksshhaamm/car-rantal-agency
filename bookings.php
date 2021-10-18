<?php
require('header.php');
if(!isset($_SESSION['type'])){
    header("Location: login.php");
}
$userid = $_SESSION['user_id'];
if($_SESSION['type']=='customer')
{
    $query = "SELECT bookings.id 'id', custid, carid, status, model,number,seats,rent,filepath from bookings,cars where custid=$userid and cars.id=carid ";
}
else
{
    $query = "SELECT * FROM bookings,cars,users where cars.id = carid and users.id =custid ";
}
$result = mysqli_query($db, $query);
if(isset($_POST['cancel'])){
    $id = $_POST['cancel'];
    $query = "UPDATE bookings SET status = 'CANCELLED' where id = $id";
    mysqli_query($db,$query);
    header('location: bookings.php');
}
print(mysqli_error($db));
?>


<html>
    <head>
        <title>Bookings</title>
    </head>
    <body class="bg-light">
        <span class="border" id="main">
        <div class="container">
            <h1 class="display-3 text-muted">Bookings</h1>
            <hr>
            <?php if(mysqli_num_rows($result)==0){?>
            <p class = "text-muted">No Data Available!</p>
            <?php } else{?>
            <div class="card-deck">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="card">
                        <div>
                            <div class= "embed-responsive embed-responsive-4by3">
                                <img class="card-img-top embed-responsive-item" src = "<?php echo $row['filepath']?>">
                            </div>
                            <div class="container card-body text-muted">
                                <div class="row">
                                    <div class="col-sm"><h5 class="card-title text-center"><?php echo $row["model"]; ?></h5></div>
                                    <?php if(isset($_SESSION['email']) && $_SESSION['type']=='agency'){?>
                                        </div>
                                        <hr>
                                        <div class="col-sm">
                                            <div class="row">
                                            <div class="col-sm"><p class="card-text">Customer ID: </div><div class="col-sm"><?php echo $row['custid'];?></p></div>
                                            </div>
                                            <div class="row">
                                            <div class="col-sm"><p class="card-text">Customer Email: </div><div class="col-sm"><?php echo $row['email'];?></p></div>
                                            </div>
                                        </div>
                                        <div>
                                        
                                    <?php } else if ($row['status']=='PROCESSING'){ ?>
                                        <form action="bookings.php" method="POST">
                                        <div class="col-sm"><button name = "cancel" value = "<?php echo $row['id'] ?>" class="w-100 text-center btn btn-secondary">Cancel Booking</button></div>
                                    <?php } ?>
                                </div>
                                <hr>
                                <div class="row  font-weight-bold"><div class="col-sm ">STATUS: </div><div class="col-sm font-italic"><?php echo $row['status'];?></div></div>
                                <div class="row"><p class="card-text"><div class="col-sm">Vehicle Number: </div><div class="col-sm"><?php echo $row['number'];?></div></p></div>
                                <div class="row"><p class="card-text"><div class="col-sm">Seating Capacity: </div><div class="col-sm"><?php echo $row['seats'];?></div></p></div>
                                <div class="row"><p class="card-text"><div class="col-sm">Rent per day: </div><div class="col-sm"><?php echo $row['rent'];?></div></p></div>
                                <hr>
                            </div>
                        </div>
                        
                    </div>
                    <?php }?>
                </div>  
                <?php } ?>          
            </div> 
        </span>
    </body>    
</html>

<script>
    
    
    function calcAmount(id, rent)
    {
        document.getElementById("amount"+id).innerHTML = document.getElementById("days"+id).value*rent;
    }
    
</script>