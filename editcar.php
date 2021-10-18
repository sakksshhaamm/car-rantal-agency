<?php
require('header.php');
if(isset($_POST['listing']))
{
    $id = mysqli_escape_string($db,$_POST['listing']);
    $query = "SELECT * FROM cars where id = '$id'";
    $result = mysqli_query($db, $query);

    $row = mysqli_fetch_assoc($result);
    $model = $row['model'];
    $number = $row['number'];
    $seats = $row['seats'];
    $rent = $row['rent'];
}
if(isset($_POST['submit']))
{
    $id = mysqli_escape_string($db,$_POST['id']);
    $model = mysqli_escape_string($db,$_POST['model']);
    $number = mysqli_escape_string($db,$_POST['vno']);
    $seats = mysqli_escape_string($db,$_POST['seats']);
    $rent = mysqli_escape_string($db,$_POST['rent']); 

    $query = "UPDATE cars SET model = '$model',number = '$number',seats = '$seats',rent = '$rent' WHERE id = '$id'";
    $result = mysqli_query($db, $query);
    print(mysqli_error($db));
    header('location: index.php');

}
?>


<html>
    <head>
        <title>Edit Cars</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body class="bg-light">
        <span class="border">
        <div class="container">
            <h1 class="display-3 text-muted">Edit Entry</h1>
            <hr>
            <form action="editcar.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label text-muted" for="model">Vehicle Model: </label>
                    <input class="form-control" type="text" name="model" id="model" value="<?php echo $model ?>"/>
                </div>
                <div class="form-group">
                    <label class="form-label" for="vno">Vehicle Number: </label>
                    <input class="form-control" type="text" name="vno" id="vno" value="<?php echo $number ?>"/>
                </div>
                <div class="form-group">
                    <label class="form-label text-muted" for="seats">Number of Seats: </label>
                    <input class="form-control" type="number" name="seats" id="seats" value="<?php echo $seats ?>"/>
                </div>
                <div class="form-group">
                    <label class="form-label text-muted" for="rent">Rent per day: </label>
                    <input class="form-control" type="number" name="rent" id="rent" value="<?php echo $rent ?>"/>
                </div>
                <input class="form-control" type="number" name="id" id="id" value="<?php echo $id ?>" hidden/>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
        </div> 
    </span>
    </body>    
</html>
