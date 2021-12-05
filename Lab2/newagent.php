<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}
if (isset($_POST["submit"])) {
    include_once("dbconnect.php");
    $name = $_POST["name"];
    $idno = $_POST["idno"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $sqlregister = "INSERT INTO `tbl_agent`(`id`, `name`, `address`,`email`, `phone`) VALUES('$idno', '$name', '$address','$email', '$phone')";
    try {
        $conn->exec($sqlregister);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            uploadImage($idno);
        }
        echo "<script>alert('Registration successful')</script>";
        echo "<script>window.location.replace('mainpage.php')</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Registration failed')</script>";
        echo "<script>window.location.replace('newagent.php')</script>";
    }
}

function uploadImage($id)
{
    $target_dir = "../res/images/";
    $target_file = $target_dir . $id . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
    <title>Nims Choco Tub</title>
</head>

<div class="w3-container w3-margin form-container-reg">
    <div class="w3-card">
        <!-- Insert the title div here -->
        <div class="w3-container w3-brown">
            <p>New Agent Registration</p>
        </div>

        <!-- Insert form section here -->
       <form class="w3-container w3-padding formco" name="registerForm"
       action="newagent.php" method="post" enctype="multipart/form-data">
        <!-- Insert image preview division-->
        <p>
            <div class="w3-container w3-border w3-center w3-padding">
                <img class="w3-image w3-round w3-margin w3-center"
                src="image.png" style="width:50%; max-width:300px"><br>
                <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"></br>
            </div>
        </p>
        <!-- Insert name input division -->
        <p>
            <label>Name</label>
            <input class="w3-input w3-border w3-round" name="name" id="idname" type="text" required>
        </p>
        <!-- Insert id/passport input divison here -->
        <p>
            <label>IC</label>
            <input class="w3-input w3-border w3-round" name="idno" id="idid" type="text" required>
        </p>
        <!-- Insert email input division here -->
        <p>
            <label>Email</label>
            <input class="w3-input w3-border w3-round" name="email" id="idemail" type="email" required>
        </p>
        <!-- Insert phone input division here -->
        <p>
            <label>Phone</label>
            <input class="w3-input w3-border w3-round" name="phone" id="idphone" type="phone" required>
        </p>
        <!-- Insert citizen input division here -->

        <!-- Insert address input division here -->
        <p>
            <label>Address</label>
            <textarea class="w3-input w3-border w3-round" name="address" id="idaddress" row="4" cols="50" width="100%"
            placeholder="Please enter your address" required></textarea>
        </p>
        <!-- Insert button submit -->
        <div class="row">
            <input class="w3-input w3-border w3-block w3-brown w3-round" type="submit"
            name="submit" value="Submit">
        </div>



    </div>
</div>