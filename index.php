<?php
require('header.php');
$query = "SELECT * FROM cars";
$result = mysqli_query($db, $query);
if(isset($_POST['submit'])){
    if(!isset($_SESSION['email']))
    {
        header('location: login.php');
    }
    if($_POST['startdate'] == "" || $_POST['days'] == "")
    {
        echo "<script type='text/javascript'>alert('Failed to Book! Please fill in the form.')</script>";
    }
    else
    {
        $carid = $_POST['car_id'];
        $userid = $_SESSION['user_id'];
        $startdate = "'".$_POST['startdate']."'";
        $days = $_POST['days'];
        //$startdate = date("Y-m-d",strtotime($startdate));
        //print($startdate);
        $query = "SELECT * FROM bookings WHERE custid=$userid AND carid=$carid AND status='PROCESSING'";

        if(mysqli_num_rows(mysqli_query($db, $query))==0){
            $query = "INSERT INTO bookings(custid,carid,startdate,days) VALUES($userid,$carid,$startdate,$days)";
            mysqli_query($db, $query);
        }
        print(mysqli_error($db));

    }
}
?>


<html>
    <head>
        <title>HOME</title>
    </head>
    <body class="bg-light">
        <span class="border" id="main">
        <div class="container">
            <h1 class="display-3 text-muted">Available Cars to Rent</h1>
            <hr>
            <div class="card-deck">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="card">
                        <div id ="car<?php echo $row["id"] ?>">
                            <div class= "embed-responsive embed-responsive-4by3">
                                <img class="card-img-top embed-responsive-item" src = "<?php echo $row['filepath']?>">
                            </div>
                            <div class="container card-body text-muted">
                                <div class="row">
                                    <div class="col-sm"><h5 class="card-title text-center"><?php echo $row["model"]; ?></h5></div>
                                    <?php if(isset($_SESSION['email']) && $_SESSION['type']=='agency'){?>
                                        <form action="editcar.php" method="POST">
                                            <div class="col-sm"><button type="submit" name = "listing" value = "<?php echo $row['id'] ?>" class="w-100 text-center btn btn-secondary">EDIT LISTING</button></div>    
                                        </form>
                                    <?php } else{ ?>
                                        <div class="col-sm"><button onclick = "rent('<?php echo $row['id'] ?>')" class="w-100 text-center btn btn-secondary">RENT</button></div>
                                    <?php } ?>
                                </div>
                                <hr>
                                <div class="row"><p class="card-text"><div class="col-sm">Vehicle Number: </div><div class="col-sm"><?php echo $row['number'];?></div></p></div>
                                <div class="row"><p class="card-text"><div class="col-sm">Seating Capacity: </div><div class="col-sm"><?php echo $row['seats'];?></div></p></div>
                                <div class="row"><p class="card-text"><div class="col-sm">Rent per day: </div><div class="col-sm"><?php echo $row['rent'];?></div></p></div>
                                <hr>
                            </div>
                        </div>
                        <div class="container" id = "booking<?php echo $row["id"] ?>" style="display:none; padding:4rem">
                            <div class="text-right">
                                <button onclick="goback('<?php echo $row['id'] ?>')" class="btn btn-danger">Go Back</button>
                            </div>  
                            <form action="index.php" method="POST">
                                <div class="form-group">
                                    <label class="form-label text-muted" for="startdate">Booking date: </label>
                                    <input class="form-control" type="date" name="startdate" id="startdate"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="days<?php echo $row["id"] ?>">Number of days: </label>
                                    <input class="form-control" type="number" name="days" id="days<?php echo $row["id"] ?>"  onchange="calcAmount('<?php echo $row['id'] ?>','<?php echo $row['rent'] ?>')"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Amount: </label>
                                    <p id="amount<?php echo $row['id'] ?>">0</p>
                                </div>
                                <input type="number" name="car_id" value="<?php echo $row["id"] ?>" hidden/>
                                <button class="btn btn-secondary w-100" name="submit" type="submit">Book</button>
                            </form>
                        </div>
                    </div>
                    <?php }?>
                </div>            
            </div> 
        </span>
    </body>    
</html>

<script>
    prev = -1;
    function rent(id){
        if(prev==-1)
        {
            document.getElementById("car"+id).style.display="none";
            document.getElementById("booking"+id).style.display="";    
        }
        else
        {
            document.getElementById("car"+prev).style.display="";
            document.getElementById("booking"+prev).style.display="none";
            document.getElementById("car"+id).style.display="none";
            document.getElementById("booking"+id).style.display="";  
        }
        prev = id;
    }
    function goback(id)
    {
        document.getElementById("car"+id).style.display="";
        document.getElementById("booking"+id).style.display="none";
    }
    function calcAmount(id, rent)
    {
        document.getElementById("amount"+id).innerHTML = document.getElementById("days"+id).value*rent;
    }
    
</script>