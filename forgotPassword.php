<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knot Us - Forgot Password</title>
    <link rel="stylesheet" href="./account_style.css"/>
</head>
<body>

<div class="section">
   
    <div class="container">
        <div class="row full-height justify-content-center"> 
           
            <div class="col-12 text-center align-self-center py-3"> 
                <div class="section pb-5 pt-5 pt-sm-2 text-center">
                    
                 <a href="homepage.html">
                        <img src="assets\logo-1.png" class="logo logo-custom" alt="logo"/>
                    </a>   
                    
                    <div class="card-3d-wrap mx-auto">
                        <div class="card-3d-wrapper">
                            
                            <div class="card-front">
                                <div class="center-wrap">
                                    <div class="section text-center">

                                        <h4 class="mb-3 pb-3">Forgot Password</h4>
                                        <form method="post" action="forgotPassword.php">

                                            <div class="form-group mt-2">
                                                <input required type="email" name="email" id="email" class="form-style"
                                                placeholder="Enter Existing Email" autocomplete="off">
                                                <i class="input-icon uil uil-at"></i>
                                            </div>

                                            <div class="form-group mt-2">
                                                <input required type="password" name="password" id="password" class="form-style"
                                                placeholder="Enter New Password" autocomplete="off">
                                                <i class="input-icon uil uil-lock-alt"></i>
                                            </div>

                                            <br>
                                            <button type="submit" name="submit" id="submit" class="btn">Submit</button>

                                            <p class="mb-0 mt-3 text-center">
                                                <a href="login.php" class="link">Back</a>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

require "db_conn.php";

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    //check if email exist in database
    $query = "SELECT * FROM `user` WHERE `email` = '$email'";
    $result = mysqli_query($cxn, $query);

    if (mysqli_num_rows($result) == 1) { //if email exist
        if (strlen($password) < 8) {
            echo '<div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
            <strong>New password must be at least 8 characters long!</strong>
            </div>';
        } else {
        $update =  "UPDATE `user` SET `password`= '$password' WHERE `email`='$email'";
        $result = mysqli_query($cxn, $update);
        echo '<div class="success">
          <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
          <strong>Password updated successfully! Head back to login page to continue planning your wedding.</strong>
          </div>';
        }
    } else { //if email doesnt exist
        echo '<div class="alert">
          <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
          <strong>Your email is not signed up yet! Sign up your email today.</strong>
          </div>';
    }
}

?>
