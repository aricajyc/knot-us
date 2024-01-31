<?php 
require 'functions.php';
//Update Task
if(isset($_POST['editTask'])){
    updateTask($_POST);
}
if(isset($_GET['t_id'])){
    $t_id = $_GET['t_id'];
    $todo = getSingleTask($t_id);
    $columnValue = $todo['description']; 
}else{
    ?>
    <script>window.href.location ='WedCheck.php';</script>
    <?php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <title>WedCheck (Edit Task) - Knot.Us</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
            overflow: auto; /* or overflow: scroll; */
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
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="budgeter.php">Budget Bliss</a>
                    </li>
                </ul>

                <!-- Profile -->
                <div class="d-flex justify-content-center flex-column flex-lg-row align-items-center gap-3">
                    <img src="assets\profile_5557402.png" class="user-pic" onclick="toggleMenu()">
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

        <br><br>
      <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Task</h3>
                </div>
                <div class="card-body">
                        <form action="editTask.php" method="POST">
                            <input type="hidden" name="t_id" value="<?= $todo['t_id']; ?>">
                            <div class="mb-3">
                                <input type="text" class="form-control" value="<?= $todo['task']; ?>"  placeholder="Edit your task here" id="task" name="task" style="width: 100%; opacity: 70%;">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" placeholder="Edit description" id="description" name="description" rows="4" cols="50" style="width: 100%; opacity: 70%;"><?php echo $todo['description']; ?></textarea>
                            </div>

                            <button type="submit" name="editTask" class="btn btn-primary">Update</button>
                        </form>
                   </div>
               </div>
              </div>
          
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
