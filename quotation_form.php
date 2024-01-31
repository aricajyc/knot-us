<?php
require "db_conn.php"; // database connection
session_start();

if (!isset($_SESSION['user_id'])) {
    // redirect to login page if not logged in
    header("Location: login.php");
} else {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT name FROM user WHERE user_id = '$user_id'";
    $result = mysqli_query($cxn, $query);
    $user = mysqli_fetch_assoc($result);
    $name = $user['name'];
}

if (isset($_POST['save_multiple_data'])) {
    // Empty array for validation errors
    $errors = array();

    // Validate the vendor prices
    if (!isset($_POST['price'])) {
        $errors[] = "Vendor price is required!";
    } else {
        // Check each price for correct format
        foreach ($_POST['price'] as $price) {
            $is_decimal = preg_match('/^\d+(\.\d+)?$/', $price);
            if (!$is_decimal) {
                $errors[] = "Enter a correct format of number for vendor price!";
                break; // Stop checking if one price is invalid
            }
        }
    }

    if (empty($errors)) {
        // Process the form data and insert into the database

        // Get form data
        $vendors = $_POST['vendor'];
        $phones = $_POST['phone'];
        $prices = $_POST['price'];
        $descs = $_POST['desc'];
        $categories  = $_POST['category'];

        // Assuming all arrays have the same length
        $count = count($vendors);

        for ($i = 0; $i < $count; $i++) {
            // Sanitize and escape data to prevent SQL injection
            $user_id = $_SESSION['user_id'];
            $vendor = mysqli_real_escape_string($cxn, $vendors[$i]);
            $phone = mysqli_real_escape_string($cxn, $phones[$i]);
            $price = mysqli_real_escape_string($cxn, $prices[$i]);
            $desc = mysqli_real_escape_string($cxn, $descs[$i]);
        
            // Check if the category exists in the POST data and sanitize it
            $category = isset($categories[$i]) ? mysqli_real_escape_string($cxn, $categories[$i]) : '';
        
            // Insert data into the database
            $query = "INSERT INTO user_quotation (user_id, vendor_name, price, phone, detail, category) 
                      VALUES ('$user_id', '$vendor', '$price', '$phone', '$desc', '$category')";
            mysqli_query($cxn, $query);
        }

        // Redirect after processing all form submissions
        header("Location: quotation.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Budget Bliss - Add Quotation</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </head>

  <style>
      @import url("https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900");

      body {
        font-family: "Poppins", sans-serif;
        background: url('assets/wallpaper2.jpg'), rgba(0,0,0,0.3);
        background-blend-mode: multiply;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
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
    </nav>

          
    <script>
        let subMenu = document.getElementById("subMenu");
        function toggleMenu(event) {
            event.preventDefault();
            subMenu.classList.toggle("open-menu");
        }
    </script>
  
    <div class="container mt-3">
        <div class="card mt-5">
            <div class="card-header">
                <h4>Budget Bliss - Add Quotation
                    <a href="javascript:void(0)" class="add-more-form float-end btn btn-outline-light" style="background-color: #cc6c84;">ADD MORE</a>
                </h4>
            </div>
            <div class="card-body">

                <form action="quotation_form.php" method="POST">
                        
                    <div class="main-form mt-3 border-bottom">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Vendor</label>
                                    <input required type="text" name="vendor[]"  class="form-control" required placeholder="Enter Vendor Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Phone Number</label>
                                    <input required type="text" name="phone[]" class="form-control" required placeholder="Enter Phone Number">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Price</label>
                                    <input required type="text" name="price[]" class="form-control" placeholder="Enter Vendor Price">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="">Description</label>
                                <textarea required class="form-control" placeholder="Add description" name="desc[]" rows="3" style="width: 100%;"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Category</label>
                                <select class="form-select form-select mb-3" aria-label=".form-select-lg example" style="opacity: 80%;" name="category[]" id="category">
                                    <option selected disabled>Select a Category</option>
                                    <option value="Venue">Venue</option>
                                    <option value="Photos & Videos">Photos & Videos</option>
                                    <option value="Food & Drink">Food & Drink</option>
                                    <option value="Attire">Attire</option>
                                    <option value="Music">Music</option>
                                    <option value="Flowers & Decor">Flowers & Decor</option>
                                    <option value="Beauty">Beauty</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>       
                        </div>

                    <div class="paste-new-forms"></div>
                    <button type="submit" name="save_multiple_data" class="btn btn-outline-light mt-2" style="background-color: #cc6c84;">Save Multiple Data</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" ></script>

    <script>
        $(document).ready(function () {

            $(document).on('click', '.remove-btn', function () {
                $(this).closest('.main-form').remove();
            });
            
            $(document).on('click', '.add-more-form', function () {
                $('.paste-new-forms').append('<div class="main-form mt-3 border-bottom">\
                                <div class="row">\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <label for="">Vendor</label>\
                                            <input required type="text" name="vendor[]" class="form-control" required placeholder="Enter Name">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <label for="">Phone Number</label>\
                                            <input required type="text" name="phone[]" class="form-control" placeholder="Enter Phone Number">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <label for="">Price</label>\
                                            <input required type="text" name="price[]" class="form-control" required placeholder="Enter Vendor Price">\
                                        </div>\
                                    </div>\
                                    </div>\
                                    <div class="row">\
                                        <div class="mb-3">\
                                            <label for="">Description</label>\
                                            <textarea class="form-control" placeholder="Add description (optional)" name="desc[]" rows="3" style="width:"></textarea>\
                                        </div>\
                                    </div>\
                                    <div class="row">\
                                        <div class="col-md-4">\
                                            <label for="">Category</label>\
                                            <select class="form-select form-select mb-3" aria-label=".form-select-lg example" style="opacity: 80%;" name="category[]" id="category">\
                                                <option selected disabled>Select a Category</option>\
                                                <option value="Venue">Venue</option>\
                                                <option value="Photos & Videos">Photos & Videos</option>\
                                                <option value="Food & Drink">Food & Drink</option>\
                                                <option value="Attire">Attire</option>\
                                                <option value="Music">Music</option>\
                                                <option value="Flowers & Decor">Flowers & Decor</option>\
                                                <option value="Beauty">Beauty</option>\
                                                <option value="Others">Others</option>\
                                            </select>\
                                        </div>\
                                    </div>\
                                    <div class="row">\
                                        <div class="col-md-4">\
                                            <div class="form-group mb-2">\
                                                <br>\
                                                <button type="button" class="remove-btn btn btn-danger mb-2">Remove</button>\
                                            </div>\
                                        </div>\
                                    </div>\
                            </div>');
            });

        });
    </script>
</body>
</html>
