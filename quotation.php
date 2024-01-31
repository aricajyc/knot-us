<?php
require 'functions.php';
require "db_conn.php"; //database connection

session_start();

//check if user is logged in
if(!isset($_SESSION['user_id'])) {
  //redirect to login page if not logged in
  header("Location: login.php");
} else {
  $user_id = $_SESSION['user_id'];
  $query = "SELECT name FROM user WHERE user_id = '$user_id'";
  $result = mysqli_query($cxn, $query);
  $user = mysqli_fetch_assoc($result);
  $name = $user['name'];
}

$getQuotation = getQuotation();

if (isset($_GET['action']) && $_GET['q_id']) {
  $q_id = $_GET['q_id'];
  if ($_GET['action'] === 'delete') {
    deleteQuotation($q_id);
  } 
} else {
  ?>
  <script>window.href.location = 'quotation.php';</script>
  <?php
}

if (isset($_GET['action']) && $_GET['q_id']) {
  if ($_GET['action'] === 'addToBudgeter') {
    addToBudgeter($q_id);
    header("Location: budgeter.php");
  } 
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Budget Bliss - Quotation</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

          
            <script>
            let subMenu = document.getElementById("subMenu");
            function toggleMenu(event) {
              event.preventDefault();
              subMenu.classList.toggle("open-menu");
            }
            </script>

        <!-- Header -->
        <div class="container">
            <h2 class="my-4" style="color: #272829;">Budget Bliss - Quotation</h2>
            <hr style="border: 1px solid #3D3B40;">
        </div>

        <div class="container mt-3">
            <a class="btn btn-outline-light mb-3" href="quotation_form.php" style="background-color: #cc6c84;"> Add Quotation &nbsp; &#43;</a>
            <div class="card card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Vendor</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Price</th>
                            <th scope="col">Details</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getQuotation as $quotation) { ?>
                            <tr>
                                <td><?= $quotation['vendor_name'] ?></td>
                                <td><?= $quotation['phone'] ?></td>
                                <td>RM <?= number_format($quotation['price'], 2)?></td>
                                <td><?= $quotation ['detail'] ?></td>
                                <td><?= $quotation ['category'] ?></td>
                                <td>
                                  <a href="quotation.php?q_id=<?= $quotation['q_id']; ?>&action=delete" class="btn btn-danger">Delete</a>
                                  <a href="quotation.php?q_id=<?= $quotation['q_id']; ?>&action=addToBudgeter" class="btn btn-success">Add to Budgeter</a>
                                </td>
                            </tr>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
                                
                                    
