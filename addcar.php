<?php
require('header.php');
if(!isset($_SESSION['type'])){
    header("Location: login.php");
}
if(isset($_POST['submit']))
{

  
    $model = mysqli_escape_string($db,$_POST['model']);
    $number = mysqli_escape_string($db,$_POST['vno']);
    $seats = mysqli_escape_string($db,$_POST['seats']);
    $rent = mysqli_escape_string($db,$_POST['rent']); 

    $filename = $_FILES['photo']['name'];
    $ext  = (new SplFileInfo($filename))->getExtension();

    $filename = md5(date('Y-m-d H:i:s:u')).".".$ext;
    $tempname = $_FILES['photo']['tmp_name'];
    $path = "image/".$filename;

    move_uploaded_file($tempname, $path);
    $query = "INSERT INTO cars(model,number,seats,rent,filepath) VALUES('$model','$number','$seats',$rent,'$path')";
    $result = mysqli_query($db, $query);
    print(mysqli_error($db));


}
?>


<html>
    <head>
        <title>Add Cars</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body class="bg-light">
        <span class="border">
        <div class="container">
            <h1 class="display-3 text-muted">Add Cars</h1>
            <hr>
            <form action="addcar.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label text-muted" for="photo">Upload Image: </label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="photo" id="photo" accept="image/*">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label text-muted" for="model">Vehicle Model: </label>
                    <input class="form-control" type="text" name="model" id="model"/>
                </div>
                <div class="form-group">
                    <label class="form-label" for="vno">Vehicle Number: </label>
                    <input class="form-control" type="text" name="vno" id="vno"/>
                </div>
                <div class="form-group">
                    <label class="form-label text-muted" for="seats">Number of Seats: </label>
                    <input class="form-control" type="number" name="seats" id="seats"/>
                </div>
                <div class="form-group">
                    <label class="form-label text-muted" for="rent">Rent per day: </label>
                    <input class="form-control" type="number" name="rent" id="rent"/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
        </div> 
    </span>
    </body>    
</html>
