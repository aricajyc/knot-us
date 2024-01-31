<?php

  require "db_conn.php"; //database connection

  session_start();

  //check if user is logged in
  if(!isset($_SESSION['user_id'])) {
    //redirect to login page if not logged in
    header("Location: login.php");
  } else {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM user WHERE user_id = '$user_id'";
    $result = mysqli_query($cxn, $query);
    $user = mysqli_fetch_assoc($result);
    $name = $user['name'];
    $email = $user['email'];
    $password = $user['password'];
  }

  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Edit Profile</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </head>

  <style>
        @import url("https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900");

        body {
            font-family: "Poppins", sans-serif;
            background: url('assets/wallpaper2.jpg'), rgba(0,0,0,0.23);
            background-blend-mode: multiply;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed; /* Add this line */
            overflow: scroll;
        }

        @media (max-width: 991px) {
            .sidebar {
                background-color: rgba(255, 255, 255, 0.2);
                backdrop-filter: blur(10px);
            }
        }

        .user-pic {
            width: 40px;
            border-radius: 50%;
            cursor: pointer;
            margin-left: 30px;
        }

        .sub-menu-wrap {
            position: absolute;
            top: 100%;
            right: 10%;
            width: 320px;
            max-height: 0px;
            overflow: hidden;
            transition: max-height 0.5s;
            z-index: 1;
        }

        .sub-menu-wrap.open-menu {
            max-height: 200px;
        }

        .sub-menu {
            background: #fff;
            padding: 20px;
            margin: 10px;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info h3 {
            font-weight: 300;
        }

        .sub-menu hr {
            border: 0;
            height: 1px;
            width: 100%;
            background: #ccc;
            margin: 10px 0 10px;
        }

        .sub-menu-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #525252;
            margin: 12px 0;
        }

        .sub-menu-link p {
            width: 100%;
        }

        .sub-menu-link img {
            width: 40px;
            background: #e5e5e5;
            border-radius: 50%;
            padding: 8px;
            margin-right: 15px;
        }

        .sub-menu-link span {
            font-size: 22px;
            transition: transform 0.5s;
        }
    
        .sub-menu-link :hover span {
            transform: translateX(5px);
        }

        .sub-menu-link :hover p {
            font-weight: 600;
        }

        .alert {
          padding: 20px;
          background-color: #f44336; 
          color: white;
          margin-bottom: 15px;
          position: fixed; 
          bottom: 20px; 
          left: 50%; 
          transform: translateX(-50%);
          width: 80%;
        }

        .success {
          padding: 20px;
          background-color: #0BDA51;
          color: white;
          margin-bottom: 15px;
          position: fixed; 
          bottom: 20px; 
          left: 50%;
          transform: translateX(-50%); 
          width: 80%; 
        }
  
        .closebtn {
          margin-left: 15px;
          color: white;
          font-weight: bold;
          float: right;
          font-size: 22px;
          line-height: 20px;
          cursor: pointer;
          transition: 0.3s;
        }
  
        .closebtn:hover {
          color: black;
        }

  </style>

  <body class="vh-100 overflow-auto">

    <!-- Nav -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent my-0" style="border-bottom: 1px solid #898484;">
      <div class="container">
                
        <!-- Logo -->
        <img src="assets\logo-1.png" width="10%"/>
              
        <!-- Toggle Button -->
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Sidebar -->
        <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

          <!-- Sidebar Header -->
          <div class="offcanvas-header text-white border-bottom">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
            <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>

          <!-- Sidebar Body -->
          <div class="offcanvas-body d-flex flex-column flex-lg-row p-2 p-lg-0">
            <ul class="navbar-nav justify-content-center align-items-center flex-grow-1 pe-3">
              <li class="nav-item mx-2">
                <a class="nav-link" href="WedCheck.php">WedCheck</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Budget Bliss
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="budgeter.php">Budgeter</a></li>
                  <li><a class="dropdown-item" href="quotation.php">Quotation</a></li>
                </ul>
              </li>
            </ul>

            <!-- Profile -->
            <div class="d-flex justify-content-center flex-column flex-lg-row align-items-center gap-3">
              <img src="assets\profile_5557402.png" class="user-pic" onclick="toggleMenu(event)">
              <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                  <div class="user-info">
                    <center><h2><?php echo $name; ?></h2></center>
                  </div>
                  <hr>
                  <a href="editProfile.php" class="sub-menu-link">
                    <img src="assets\profile.png">
                    <p>Edit Profile</p>
                    <span>></span>
                  </a>
                  <a href="homepage.html" class="sub-menu-link">
                    <img src="assets\logout.png">
                    <p>Logout</p>
                    <span>></span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <div class="container">
      <h2 class="my-4" style="color: #272829;">Edit Profile</h2>
      <hr style="border: 1px solid #3D3B40;">
    </div>

    <div class="container">
	    <div class="row">
        <div class="col-md-9 personal-info">
          <h4>Personal info</h4>
          
          <form class="form-horizontal" action="editProfile.php" method="POST">
            
            <div class="form-group">
              <label class="col-lg-3 control-label">Name: </label>
              <div class="col-lg-8">
                <input required class="form-control" type="text" name="name" value="<?= $name ?>">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-3 control-label">Email:</label>
              <div class="col-lg-8">
                <input required class="form-control" type="email" name="email" value="<?= $email ?>">
              </div>
            </div>
            
            <div class="form-group">
              <label required class="col-md-3 control-label">Password:</label>
              <div class="col-md-8">
                <div class="input-group">
                  <input required class="form-control" type="password" name="password" value="<?= $password ?>">
                  <span class="input-group-text">
                    <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                  </span>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-md-3 control-label">Confirm Password:</label>
              <div class="col-md-8">
                <div class="input-group">
                  <input class="form-control" type="password" name="confirmPassword" value="<?= $password ?>">
                  <span class="input-group-text">
                    <i class="bi bi-eye-slash" id="toggleConfirmPassword" style="cursor: pointer;"></i>
                  </span>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-md-3 control-label"></label>
              <div class="col-md-8">
                <button type="submit" class="btn btn-primary" name="saveProfile">Save Changes</button>
                <span></span>
                <input type="reset" class="btn btn-default" value="Cancel">
              </div>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  
    <script>
      //toggle nav profile icon
      let subMenu = document.getElementById("subMenu");
      function toggleMenu() {
        subMenu.classList.toggle("open-menu");
      }
      
      // Toggle Password Visibility
      const togglePassword = document.querySelector('#togglePassword');
      const password = document.querySelector('[name="password"]');
      togglePassword.addEventListener('click', () => {
        // Toggle the type attribute using getAttribute() method
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        togglePassword.classList.toggle('bi-eye'); // Toggle the eye and bi-eye icon
      });

      // Toggle Confirm Password Visibility
      const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
      const confirmPassword = document.querySelector('[name="confirmPassword"]');
      toggleConfirmPassword.addEventListener('click', () => {
        // Toggle the type attribute using getAttribute() method
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        toggleConfirmPassword.classList.toggle('bi-eye'); // Toggle the eye and bi-eye icon
      });
    </script>

  </body>
</html>

<?php
require 'functions.php';

if (isset($_POST['saveProfile'])) {
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  if ($password !== $confirmPassword) {
    echo '<div class="alert">
          <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
          <strong>Password does not match! Please makes sure the password and confirmation password are the same.</strong>
          </div>';
  } else {
    updateProfile($_POST);
    echo '<div class="success">
          <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
          <strong>Profile updated successfully!</strong>
          </div>';
  }
}

?>
