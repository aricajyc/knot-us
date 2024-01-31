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

//call createTodo function - to add new task
if(isset($_POST['addTask'])) {
    createTodo($_POST);
}

//call getTodoVenue function 
$getTodoVenue = getTodoVenue();
if(isset($_GET['status']) && $_GET['t_id']) {
    $t_id = $_GET['t_id'];
    $status = $_GET['status'];
    if($_GET['status'] === 'Incomplete') {
        changeStatus($t_id, $status);
    }
    if ($_GET['status'] === 'Completed') {
        changeStatus($t_id, $status);
    }
} else {
    ?>
    <script>window.href.location = 'WedCheck.php';</script>
    <?php
}

//call getTodoPV function
$getTodoPV = getTodoPV();
if(isset($_GET['status']) && $_GET['t_id']) {
    $t_id = $_GET['t_id'];
    $status = $_GET['status'];
    if($_GET['status'] === 'Incomplete') {
        changeStatus($t_id, $status);
    }
    if ($_GET['status'] === 'Completed') {
        changeStatus($t_id, $status);
    }
} else {
    ?>
    <script>window.href.location = 'WedCheck.php';</script>
    <?php
}

//call getTodoFD function
$getTodoFD = getTodoFD();
if(isset($_GET['status']) && $_GET['t_id']) {
    $t_id = $_GET['t_id'];
    $status = $_GET['status'];
    if($_GET['status'] === 'Incomplete') {
        changeStatus($t_id, $status);
    }
    if ($_GET['status'] === 'Completed') {
        changeStatus($t_id, $status);
    }
} else {
    ?>
    <script>window.href.location = 'WedCheck.php';</script>
    <?php
}

//call getTodoAttire function
$getTodoAttire = getTodoAttire();
if(isset($_GET['status']) && $_GET['t_id']) {
    $t_id = $_GET['t_id'];
    $status = $_GET['status'];
    if($_GET['status'] === 'Incomplete') {
        changeStatus($t_id, $status);
    }
    if ($_GET['status'] === 'Completed') {
        changeStatus($t_id, $status);
    }
} else {
    ?>
    <script>window.href.location = 'WedCheck.php';</script>
    <?php
}

//call getTodoMusic function
$getTodoMusic = getTodoMusic();
if(isset($_GET['status']) && $_GET['t_id']) {
    $t_id = $_GET['t_id'];
    $status = $_GET['status'];
    if($_GET['status'] === 'Incomplete') {
        changeStatus($t_id, $status);
    }
    if ($_GET['status'] === 'Completed') {
        changeStatus($t_id, $status);
    }
} else {
    ?>
    <script>window.href.location = 'WedCheck.php';</script>
    <?php
}

//call getTodoFlower function
$getTodoFlower = getTodoFlower();
if(isset($_GET['status']) && $_GET['t_id']) {
    $t_id = $_GET['t_id'];
    $status = $_GET['status'];
    if($_GET['status'] === 'Incomplete') {
        changeStatus($t_id, $status);
    }
    if ($_GET['status'] === 'Completed') {
        changeStatus($t_id, $status);
    }
} else {
    ?>
    <script>window.href.location = 'WedCheck.php';</script>
    <?php
}

//call getTodoBeauty function
$getTodoBeauty = getTodoBeauty();
if(isset($_GET['status']) && $_GET['t_id']) {
    $t_id = $_GET['t_id'];
    $status = $_GET['status'];
    if($_GET['status'] === 'Incomplete') {
        changeStatus($t_id, $status);
    }
    if ($_GET['status'] === 'Completed') {
        changeStatus($t_id, $status);
    }
} else {
    ?>
    <script>window.href.location = 'WedCheck.php';</script>
    <?php
}

$getOthers = getOthers();
if(isset($_GET['status']) && $_GET['t_id']) {
    $t_id = $_GET['t_id'];
    $status = $_GET['status'];
    if($_GET['status'] === 'Incomplete') {
        changeStatus($t_id, $status);
    }
    if ($_GET['status'] === 'Completed') {
        changeStatus($t_id, $status);
    }
} else {
    ?>
    <script>window.href.location = 'WedCheck.php';</script>
    <?php
}

//Delete Function
if (isset($_GET['action']) && $_GET['t_id']) {
    $t_id = $_GET['t_id'];
    if ($_GET['action'] === 'delete') {
        deleteTask($t_id);
    }
} else {
    ?>
    <script>window.href.location = 'WedCheck.php';</script>
    <?php
}

// Fetch tasks from all categories
$allTasks = array_merge($getTodoVenue, $getTodoPV, $getTodoFD, $getTodoAttire, $getTodoMusic, $getTodoFlower, $getTodoBeauty);
// Calculate overall completion percentage
$completionPercentage = calculateCompletionPercentage($allTasks);
$complete = totalComplete($allTasks);
$totalTasks = totalTask($allTasks);

?>



<!DOCTYPE html>
<html>

    <head>
        <title>WedCheck</title>
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
                    <img src="assets\profile_5557402.png" class="user-pic" onclick="toggleMenu(event)"></img>
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
            <h2 class="my-4" style="color: #272829;">WedCheck</h2>
            <label class="mb-2" for="progress" style="color: #272829;">Your Progress</label>
            <div class="progress" style="height: 12px; width: 80%;">
                <div class="progress-bar" role="progressbar" style="width: <?=$completionPercentage;?>%; background-color: #d47c92; opacity: 75%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <?= number_format($completionPercentage, 0); ?>% (<?= $complete; ?> / <?= $totalTasks ?>)
                </div>
            </div>
            <hr style="border: 1px solid #3D3B40;">
        </div>

        
        <div class="container">
            <!-- Modal Trigger Button: Add New Task -->
            <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#addtaskmodal" style="background-color: #cc6c84;">
                Add New Task
            </button>
            <!-- Modal -->
            <div class="modal fade" id="addtaskmodal" tabindex="-1" aria-labelledby="addtaskmodal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Task</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="WedCheck.php" method="POST" id="addTaskForm">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Add new task here" id="task" name="task" style="width: 100%; opacity: 70%;">
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" placeholder="Add description (optional)" id="desc" name="desc" rows="3" style="width: 100%; opacity: 70%;"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <select class="form-select form-select mb-3" aria-label=".form-select-lg example" style="opacity: 80%;" name="category" id="category">
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
                                    <div class="col">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-outline-light" id="addTaskBtn" name="addTask" style="background-color: #cc6c84;" value="Add &nbsp; &#43;"/>
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
                            Hello there! This is a guide on how to use WedCheck.<br><br>
                            <img src="assets\ss_categories.png" style="width: 100%;"></img>
                            You can browse the preset task that we made  for you by clicking each of those categories.<br><br>
                            <img src="assets\ss_header.png" style="width: 100%;"></img>
                            Track your progress at the progress bar! You can also add new task by clicking "Add New Task" button.<br><br> 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-3">

            <!-- Venue -->
            <p>
                <a class="btn btn-outline-light" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" style="width: 100%; text-shadow: 3px 3px 4px #2a2a2a;"><b>Venue</b></a>
                <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <div class="card card-body">
                        <table class="table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">Task</th>
                                    <th style="width: 25%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($getTodoVenue as $todo){ //read task
                            ?>
                            <tr>
                                <td>
                                    <?= $todo['task']; ?> <br>
                                    <div class="small text-muted"><?= $todo['description']; ?></div>
                                </td>
                                <td>
                                    <!-- Status button -->
                                    <?php 
                                        if($todo['status'] == 1){ ?>
                                            <a href="WedCheck.php?t_id=<?= $todo['t_id'] ?>&status=Incomplete" class="btn btn-success">Completed</a>
                                       <?php }else{ ?>
                                            <a href="WedCheck.php?t_id=<?= $todo['t_id'] ?>&status=Completed" class="btn btn-secondary">Incomplete</a>
                                       <?php } ?>
                                    <a href="editTask.php?t_id=<?= $todo['t_id']; ?>" class="btn btn-primary">Edit</a>

                                    <!-- Delete task -->
                                    <a href="WedCheck.php?t_id=<?= $todo['t_id']; ?>&action=delete" class="btn btn-danger">Delete</a>

                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </p>

            <!-- Photos & Videos -->
            <p>
                <a class="btn btn-outline-light" data-bs-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2" style="width: 100%; text-shadow: 3px 3px 4px #2a2a2a;"><b>Photos & Videos</b></a>
                <div class="collapse multi-collapse" id="multiCollapseExample2">
                    <div class="card card-body">
                        <table class="table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">Task</th>
                                    <th style="width: 25%;">Action</th>
                                </tr>
                            </thead>
                            </tbody>
                            <?php
                                foreach($getTodoPV as $todo){ //read task
                            ?>
                            <tr> <!-- Actions -->
                                <td>
                                    <?= $todo['task']; ?> <br>
                                    <div class="small text-muted"><?= $todo['description']; ?></div>
                                </td>
                                <td>
                                    <!-- Status button -->
                                    <?php 
                                        if($todo['status'] == 1){ ?>
                                            <a href="WedCheck.php?t_id=<?= $todo['t_id'] ?>&status=Incomplete" class="btn btn-success">Completed</a>
                                       <?php }else{ ?>
                                            <a href="WedCheck.php?t_id=<?= $todo['t_id'] ?>&status=Completed" class="btn btn-secondary">Incomplete</a>
                                       <?php } ?>
                                    
                                    <!-- Edit button trigger modal -->
                                    <a href="editTask.php?t_id=<?= $todo['t_id']; ?>" class="btn btn-primary">Edit</a>

                                    <!-- Delete task -->
                                    <a href="WedCheck.php?t_id=<?= $todo['t_id']; ?>&action=delete" class="btn btn-danger">Delete</a>

                                </td>
                            </td>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </p>

            <!-- Food & Drink -->
            <p>
                <a class="btn btn-outline-light" data-bs-toggle="collapse" href="#multiCollapseExample3" role="button" aria-expanded="false" aria-controls="multiCollapseExample3" style="width: 100%; text-shadow: 3px 3px 4px #2a2a2a;"><b>Food & Drink</b></a>
                <div class="collapse multi-collapse" id="multiCollapseExample3">
                    <div class="card card-body">
                        <table class="table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">Task</th>
                                    <th style="width: 25%;">Action</th>
                                </tr>
                            </thead>
                            </tbody>
                            <?php
                                foreach($getTodoFD as $todo){ //read task
                            ?>
                            <tr> <!-- Actions -->
                                <td>
                                    <?= $todo['task']; ?><br>
                                    <div class="small text-muted"><?= $todo['description']; ?></div>
                                </td>
                                <td>
                                    <!-- Status button -->
                                    <?php 
                                        if($todo['status'] == 1){ ?>
                                            <a href="WedCheck.php?t_id=<?= $todo['t_id'] ?>&status=Incomplete" class="btn btn-success">Completed</a>
                                       <?php }else{ ?>
                                            <a href="WedCheck.php?t_id=<?= $todo['t_id'] ?>&status=Completed" class="btn btn-secondary">Incomplete</a>
                                       <?php } ?>
                                    
                                    <!-- Edit button trigger modal -->
                                    <a href="editTask.php?t_id=<?= $todo['t_id']; ?>" class="btn btn-primary">Edit</a>

                                    <!-- Delete task -->
                                    <a href="WedCheck.php?t_id=<?= $todo['t_id']; ?>&action=delete" class="btn btn-danger">Delete</a>

                                </td>
                            </td>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </p>

            <!-- Attire -->
            <p>
                <a class="btn btn-outline-light" data-bs-toggle="collapse" href="#multiCollapseExample4" role="button" aria-expanded="false" aria-controls="multiCollapseExample4" style="width: 100%; text-shadow: 3px 3px 4px #2a2a2a;"><b>Attire</b></a>
                <div class="collapse multi-collapse" id="multiCollapseExample4">
                    <div class="card card-body">
                        <table class="table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">Task</th>
                                    <th style="width: 25%;">Action</th>
                                </tr>
                            </thead>
                            </tbody>
                            <?php
                                foreach($getTodoAttire as $todo){ //read task
                            ?>
                            <tr> <!-- Actions -->
                                <td>
                                    <?= $todo['task']; ?> <br>
                                    <div class="small text-muted"><?= $todo['description']; ?></div>
                                </td>
                                <td>
                                    <!-- Status button -->
                                    <?php 
                                        if($todo['status'] == 1){ ?>
                                            <a href="WedCheck.php?t_id=<?= $todo['t_id'] ?>&status=Incomplete" class="btn btn-success">Completed</a>
                                       <?php }else{ ?>
                                            <a href="WedCheck.php?t_id=<?= $todo['t_id'] ?>&status=Completed" class="btn btn-secondary">Incomplete</a>
                                       <?php } ?>
                                    
                                    <!-- Edit button trigger modal -->
                                    <a href="editTask.php?t_id=<?= $todo['t_id']; ?>" class="btn btn-primary">Edit</a>

                                    <!-- Delete task -->
                                    <a href="WedCheck.php?t_id=<?= $todo['t_id']; ?>&action=delete" class="btn btn-danger">Delete</a>

                                </td>
                            </td>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </p>

            <!-- Music -->
            <p>
                <a class="btn btn-outline-light" data-bs-toggle="collapse" href="#multiCollapseExample5" role="button" aria-expanded="false" aria-controls="multiCollapseExample5" style="width: 100%; text-shadow: 3px 3px 4px #2a2a2a;"><b>Music</b></a>
                <div class="collapse multi-collapse" id="multiCollapseExample5">
                    <div class="card card-body">
                        <table class="table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">Task</th>
                                    <th style="width: 25%;">Action</th>
                                </tr>
                            </thead>
                            </tbody>
                            <?php
                                foreach($getTodoMusic as $todo){ //read task
                            ?>
                            <tr> <!-- Actions -->
                                <td>
                                    <?= $todo['task']; ?> <br>
                                    <div class="small text-muted"><?= $todo['description']; ?></div>
                                </td>
                                <td>
                                    <!-- Status button -->
                                    <?php 
                                        if($todo['status'] == 1){ ?>
                                            <a href="WedCheck.php?t_id=<?= $todo['t_id'] ?>&status=Incomplete" class="btn btn-success">Completed</a>
                                       <?php }else{ ?>
                                            <a href="WedCheck.php?t_id=<?= $todo['t_id'] ?>&status=Completed" class="btn btn-secondary">Incomplete</a>
                                       <?php } ?>
                                    
                                    <!-- Edit button trigger modal -->
                                    <a href="editTask.php?t_id=<?= $todo['t_id']; ?>" class="btn btn-primary">Edit</a>

                                    <!-- Delete task -->
                                    <a href="WedCheck.php?t_id=<?= $todo['t_id']; ?>&action=delete" class="btn btn-danger">Delete</a>

                                </td>
                            </td>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </p>

            <!-- Flowers & Decor -->
            <p>
                <a class="btn btn-outline-light" data-bs-toggle="collapse" href="#multiCollapseExample6" role="button" aria-expanded="false" aria-controls="multiCollapseExample6" style="width: 100%; text-shadow: 3px 3px 4px #2a2a2a;"><b>Flowers & Decor</b></a>
                <div class="collapse multi-collapse" id="multiCollapseExample6">
                    <div class="card card-body">
                        <table class="table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">Task</th>
                                    <th style="width: 25%;">Action</th>
                                </tr>
                            </thead>
                            </tbody>
                            <?php
                                foreach($getTodoFlower as $todo){ //read task
                            ?>
                            <tr> <!-- Actions -->
                                <td>
                                    <?= $todo['task']; ?> <br>
                                    <div class="small text-muted"><?= $todo['description']; ?></div>
                                </td>
                                <td>
                                    <!-- Status button -->
                                    <?php 
                                        if($todo['status'] == 1){ ?>
                                            <a href="WedCheck.php?t_id=<?= $todo['t_id'] ?>&status=Incomplete" class="btn btn-success">Completed</a>
                                       <?php }else{ ?>
                                            <a href="WedCheck.php?t_id=<?= $todo['t_id'] ?>&status=Completed" class="btn btn-secondary">Incomplete</a>
                                       <?php } ?>
                                    
                                    <!-- Edit button trigger modal -->
                                    <a href="editTask.php?t_id=<?= $todo['t_id']; ?>" class="btn btn-primary">Edit</a>

                                    <!-- Delete task -->
                                    <a href="WedCheck.php?t_id=<?= $todo['t_id']; ?>&action=delete" class="btn btn-danger">Delete</a>

                                </td>
                            </td>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </p>

            <!-- Beauty -->
            <p>
                <a class="btn btn-outline-light" data-bs-toggle="collapse" href="#multiCollapseExample7" role="button" aria-expanded="false" aria-controls="multiCollapseExample7" style="width: 100%; text-shadow: 3px 3px 4px #2a2a2a;"><b>Beauty</b></a>
                <div class="collapse multi-collapse" id="multiCollapseExample7">
                    <div class="card card-body">
                        <table class="table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">Task</th>
                                    <th style="width: 25%;">Action</th>
                                </tr>
                            </thead>
                            </tbody>
                            <?php
                                foreach($getTodoBeauty as $todo){ //read task
                            ?>
                            <tr> <!-- Actions -->
                                <td>
                                    <?= $todo['task']; ?> <br>
                                    <div class="small text-muted"><?= $todo['description']; ?></div>
                                </td>
                                <td>
                                    <!-- Status button -->
                                    <?php 
                                        if($todo['status'] == 1){ ?>
                                            <a href="WedCheck.php?t_id=<?= $todo['t_id'] ?>&status=Incomplete" class="btn btn-success">Completed</a>
                                       <?php }else{ ?>
                                            <a href="WedCheck.php?t_id=<?= $todo['t_id'] ?>&status=Completed" class="btn btn-secondary">Incomplete</a>
                                       <?php } ?>
                                    
                                    <!-- Edit button trigger modal -->
                                    <a href="editTask.php?t_id=<?= $todo['t_id']; ?>" class="btn btn-primary">Edit</a>

                                    <!-- Delete task -->
                                    <a href="WedCheck.php?t_id=<?= $todo['t_id']; ?>&action=delete" class="btn btn-danger">Delete</a>

                                </td>
                            </td>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </p>

            <!-- Others -->
            <p>
                <a class="btn btn-outline-light" data-bs-toggle="collapse" href="#multiCollapseExample8" role="button" aria-expanded="false" aria-controls="multiCollapseExample8" style="width: 100%; text-shadow: 3px 3px 4px #2a2a2a;"><b>Others</b></a>
                <div class="collapse multi-collapse" id="multiCollapseExample8">
                    <div class="card card-body">
                        <table class="table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">Task</th>
                                    <th style="width: 25%;">Action</th>
                                </tr>
                            </thead>
                            </tbody>
                            <?php
                                foreach($getOthers as $todo){ //read task
                            ?>
                            <tr> <!-- Actions -->
                                <td>
                                    <?= $todo['task']; ?> <br>
                                    <div class="small text-muted"><?= $todo['description']; ?></div>
                                </td>
                                <td>
                                    <!-- Status button -->
                                    <?php 
                                        if($todo['status'] == 1){ ?>
                                            <a href="WedCheck.php?t_id=<?= $todo['t_id'] ?>&status=Incomplete" class="btn btn-success">Completed</a>
                                       <?php }else{ ?>
                                            <a href="WedCheck.php?t_id=<?= $todo['t_id'] ?>&status=Completed" class="btn btn-secondary">Incomplete</a>
                                       <?php } ?>
                                    
                                    <!-- Edit button trigger modal -->
                                    <a href="editTask.php?t_id=<?= $todo['t_id']; ?>" class="btn btn-primary">Edit</a>

                                    <!-- Delete task -->
                                    <a href="WedCheck.php?t_id=<?= $todo['t_id']; ?>&action=delete" class="btn btn-danger">Delete</a>

                                </td>
                            </td>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </p>
        
        </div>

        <script>
            let subMenu = document.getElementById("subMenu");
            function toggleMenu() {
                subMenu.classList.toggle("open-menu");
            }
        </script>
        
    </body>
</html>
