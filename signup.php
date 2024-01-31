<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knot Us - Sign Up</title>
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

                                        <h4 class="mb-3 pb-3">Sign Up</h4>
                                        <form method="post" action="signup.php">

                                            <div class="form-group">
                                            <input required type="text" name="name" class="form-style"
                                            placeholder="Your Full Name" id="name" autocomplete="off">
                                            <i class="input-icon uil uil-user"></i>
                                            </div>

                                            <div class="form-group mt-2">
                                            <input required type="email" name="email" id="email" class="form-style"
                                            placeholder="Your Email" autocomplete="off">
                                            <i class="input-icon uil uil-at"></i>
                                            </div>

                                            <div class="form-group mt-2">
                                            <input required type="password" name="password" id="password" class="form-style"
                                            placeholder="Your Password" autocomplete="off">
                                            <i class="input-icon uil uil-lock-alt"></i>
                                            </div>

                                            <br>
                                            <button type="submit" name="submit" id="submit" class="btn">Submit</button>

                                            <p class="mb-0 mt-3 text-center">
                                                <a href="login.php" class="link">Already have an account?</a>
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
session_start(); //start a new session
require "db_conn.php"; //database connection

//user registration form processing
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {

    //get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //validate user input
    if (empty($name) || empty($email) || empty($password)) {
        echo '<div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
            <strong>Please fill in all fields!</strong>
            </div>';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
            <strong>Please fill in valid email address!</strong>
            </div>';
    } else if (strlen($password) < 8) {
        echo '<div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
            <strong>Password must be at least 8 characters long!</strong>
            </div>';
    } else {
        //check if the user with the same email already exists
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = $cxn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
            <strong>User with this email already exist!</strong>
            </div>';
        } else {
            //protect against SQL injection attacks by using parameterized queries
            $query = "INSERT INTO user (email, name, password) VALUES (?, ?, ?)";
            $stmt = $cxn->prepare($query);
            $stmt->bind_param("sss", $email, $name, $password);
            $stmt->execute();

            //get the user_id of the newly created user
            $user_id = $cxn->insert_id;

            //copy task and category from preset_task to task table
            $query = "INSERT INTO task (user_id, task, description, category, status) SELECT ?, task, description, category, status FROM preset_task";
            $stmt = $cxn->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();

            $_SESSION['user_id'] = $user_id;

            echo '<div class="alert alert-success">User registered successfully.</div>';
            header('Location: WedCheck.php');
        }
    }
}
?>

</body>
</html>
