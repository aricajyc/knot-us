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

if (isset($_POST['setBudget'])) {
  updateMaxBudget($_POST);
}

if(isset($_POST['addExpenses'])) {
  addExpenses($_POST);
}

$getBudgeter = getBudgeter();

if (isset($_GET['action']) && $_GET['b_id']) {
  $b_id = $_GET['b_id'];
  if ($_GET['action'] === 'delete') {
      deleteExpenses($b_id);
  }
} else {
  ?>
  <script>window.href.location = 'budgeter.php';</script>
  <?php
}

$max_budget = getMaxBudget();
$total_expenses = getTotalExpenses();
$balance = getBalance();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <title>Budget Bliss - Budgeter</title>
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

        .flex-space {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .output-container {
            background-color: #E5E1DA;
            opacity: 70%;
            color: #272829;
            border-radius: 0.3em;
            box-shadow: 0 0.6em 1.2em rgba(28, 0, 80, 0.06);
            padding: 1.2em;
        }

        .output-container p {
            font-weight: 500;
            margin-bottom: 0.6em;
        }

        .output-container span {
            display: block;
            text-align: center;
            font-weight: 400;
            color: #272829;
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
            <h2 class="mt-4 mb-3" style="color: #272829;">Budget Bliss - Budgeter</h2>
            
        <!-- Budgeter Details -->
        <div class="output-container flex-space">
          <div>
            <p>Max Budget</p>
            <span id="amount">RM <?= number_format($max_budget, 2); ?></span>
          </div>
          <div>
            <p>Expenses</p>
            <span id="expenditure-value">RM <?= number_format($total_expenses, 2); ?></span>
          </div>
          <div>
            <p>Balance</p>
            <span id="balance-amount">RM <?= number_format($balance, 2); ?></span>
          </div>
        </div>
            <hr style="border: 1px solid #3D3B40;">
        </div>

        <div class="container">
          <!-- Modal Trigger Button: Set Max Budget -->
          <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#setbudgetmodal" style="background-color: #cc6c84;">
                Set Max Budget
          </button>
          <!-- Modal -->
          <div class="modal fade" id="setbudgetmodal" tabindex="-1" aria-labelledby="setbudgetmodal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Set Max Budget</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="budgeter.php" method="POST" id="setBudgetForm">
                    <div class="mb-3">
                      <input type="text" class="form-control" placeholder="Max Budget" name="max_budget" style="width: 100%; opacity: 70%;">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-outline-light" id="setBudgetBtn" name="setBudget" style="background-color: #cc6c84;" value="Add &nbsp; &#43;"/>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal Trigger Button: Add New Expenses -->
          <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#addexpensesmodal" style="background-color: #cc6c84;">
                Add New Expenses
          </button>
          <!-- Modal -->
          <div class="modal fade" id="addexpensesmodal" tabindex="-1" aria-labelledby="addexpensesmodal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Expenses</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="budgeter.php" method="POST" id="addExpensesForm">
                    <div class="row">
                      <div class="col">
                        <div class="mb-3">
                          <input type="text" class="form-control" placeholder="Product/Vendor" name="vendor" style="width: 100%; opacity: 70%;">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="mb-3">
                          <input type="text" class="form-control" placeholder="Phone Number" name="phone" style="width: 100%; opacity: 70%;">
                        </div>
                      </div>
                      <div class="col">
                        <div class="mb-3">
                          <input type="text" class="form-control" placeholder="Price" name="price" style="width: 100%; opacity: 70%;">
                        </div>
                      </div>
                    </div>
                    <div class="mb-3">
                      <textarea class="form-control" placeholder="Details" name="detail" rows="3" style="width: 100%; opacity: 70%;"></textarea>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-outline-light" id="addExpensesBtn" name="addExpenses" style="background-color: #cc6c84;" value="Add &nbsp; &#43;"/>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal Trigger Button: User Navigation -->
          <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#usernavigationModal" style="background-color: #cc6c84;">
            User Navigation
          </button>
          <!-- Modal -->
          <div class="modal fade" id="usernavigationModal" tabindex="-1" aria-labelledby="usernavigationModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">User Navigation</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Hello there! This is a guide on how to use Budgeter. <br><br>
                  <img src="assets\budgeterHeader.png" style="width: 100%;"></img> <br><br>
                  1. Click on "Set Max Budget" button to set the maximum budget you want to spend on your wedding. <br><br>
                  2. Click on "Add New Expenses" button to add the expenses that you spent on to keep track on your spending and balance available. <br><br>
                  3. You can add your quotation directly from Budget Bliss – Quotation without entering it another time here! Head to Budget Bliss – Quotation, choose any quotation that you paid and click "Add to Budgeter" button. <br><br>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="container mt-3">
          <div class="card card-body">
            <table class="table-primary">
              <thead>
                <tr>
                  <th scope="col">Vendor/Product</th>
                  <th scope="col">Price</th>
                  <th scope="col">Phone Number</th>
                  <th scope="col">Detail</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($getBudgeter as $expenses) { ?>
                  <tr>
                    <td><?= $expenses['vendor'] ?></td>
                    <td>RM <?= number_format($expenses['price'],2) ?></td>
                    <td><?= $expenses['phone'] ?></td>
                    <td><?= $expenses['detail'] ?></td>
                    <td>
                      <a href="budgeter.php?b_id=<?= $expenses['b_id']; ?>&action=delete" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
        </div>


  </body>
</html>
