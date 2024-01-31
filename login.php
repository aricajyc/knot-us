<link rel="stylesheet" href="./account_style.css"/>

<!--<div class="bg">-->
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
                                        
                                        <h4 class="mb-3 pb-3">Log In</h4> <!-- mb=margin bottom, pb=padding bottom -->
                                        <form method="post">
                                        <div class="form-group">
                                            <input type="text" name="user_email" class="form-style"
                                            placeholder="Your Email" id="user_email" autocomplete="off">
                                            <i class="input-icon uil uil-at"></i>
                                        </div>
                                        
                                        <div class="form-group mt-2">
                                            <input type="password" name="user_password" class="form-style"
                                            placeholder="Your Password" id="user_password" autocomplete="off">
                                            <i class="input-icon uil uil-lock-alt"></i>
                                        </div>

                                        <br>
                                        <button type="submit" name="submit" id="submit" class="btn">Submit</button>

                                        <p class="mb-0 mt-3 text-center">
                                            <a href="forgotPassword.php" class="link">Forgot your password?</a>
                                        </p>

                                        <p class="mb-0 mt-1 text-center">
                                            <a href="signup.php" class="link">Don't have an account?</a>
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


<?php
    // Database connection
    require "db_conn.php";

    $error = ''; //empty array

    // Check if form data was submitted via POST
    if (isset($_POST['user_email']) && isset($_POST['user_password'])) {
        // Get form data
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        // Query to check if the user email and password exist in the database
        $query = "SELECT * FROM user WHERE email = '$user_email' AND password = '$user_password'";
        $result = mysqli_query($cxn, $query);

        // Check if query was successful and if the email and password match
        if (mysqli_num_rows($result) == 1) {
            //fetch the user id from the result set
            $row = mysqli_fetch_assoc($result);
            $user_id = $row['user_id'];
            // Start session and store user's name
            session_start();
            $_SESSION['user_id'] = $user_id;

            // Redirect to dashboard or home page
            header('Location: WedCheck.php');
        } else {
            // Set error message if the entered password is incorrect
            $error = 'Invalid email or password. Please try again.';
        }
    }

    // Display error message if it exists
    if (!empty($error)) {
        echo '<div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
        <strong>' . $error . '</strong>
        </div>';
    }

    ?>
