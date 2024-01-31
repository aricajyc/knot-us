<?php

require 'db_conn.php';
function createTodo($request){
    global $cxn;
    //sanitize user inputs to prevent SQL injection
    $task = mysqli_real_escape_string($cxn, $_POST['task']);
    $desc = mysqli_real_escape_string($cxn, $_POST['desc']);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);

    //get user id from the session
    $user_id = $_SESSION['user_id'];

    //insert the task into database
    $insert_query = "INSERT INTO task (user_id, task, description, category, status) VALUES ('$user_id', '$task', '$desc', '$category', 'Incomplete')";
    $insert_result = mysqli_query($cxn, $insert_query);
}

function getQuotation() {
    global $cxn;
    $user_id = $_SESSION['user_id'] ;
    $query = "SELECT * FROM user_quotation WHERE user_id = '$user_id'";
    $execute_query = mysqli_query($cxn, $query);
    // Check if the query execution was successful
    if (!$execute_query) {
        die("Query failed: " . mysqli_error($cxn));
    }
    // Fetch all rows as an associative array
    $quotation_list = mysqli_fetch_all($execute_query, MYSQLI_ASSOC);
    // Free the result set
    mysqli_free_result($execute_query);
    // Return the fetched todos
    return $quotation_list;
}


function getTodoVenue(){
    global $cxn;
    $user_id = $_SESSION['user_id'] ;
    $category = "Venue";
    $query = "SELECT * FROM task WHERE user_id = '$user_id' AND category = '$category'";
    $execute_query = mysqli_query($cxn, $query);
    // Check if the query execution was successful
    if (!$execute_query) {
        die("Query failed: " . mysqli_error($cxn));
    }
    // Fetch all rows as an associative array
    $todos = mysqli_fetch_all($execute_query, MYSQLI_ASSOC);
    // Free the result set
    mysqli_free_result($execute_query);
    // Return the fetched todos
    return $todos;
}

function getTodoFD(){
    global $cxn;
    $user_id = $_SESSION['user_id'] ;
    $category = "Food & Drink";
    $query = "SELECT * FROM task WHERE user_id = '$user_id' AND category = '$category'";
    $execute_query = mysqli_query($cxn, $query);
    // Check if the query execution was successful
    if (!$execute_query) {
        die("Query failed: " . mysqli_error($cxn));
    }
    // Fetch all rows as an associative array
    $todos = mysqli_fetch_all($execute_query, MYSQLI_ASSOC);
    // Free the result set
    mysqli_free_result($execute_query);
    // Return the fetched todos
    return $todos;
}

function getTodoPV(){
    global $cxn;
    $user_id = $_SESSION['user_id'] ;
    $category = "Photos & Videos";
    $query = "SELECT * FROM task WHERE user_id = '$user_id' AND category = '$category'";
    $execute_query = mysqli_query($cxn, $query);
    // Check if the query execution was successful
    if (!$execute_query) {
        die("Query failed: " . mysqli_error($cxn));
    }
    // Fetch all rows as an associative array
    $todos = mysqli_fetch_all($execute_query, MYSQLI_ASSOC);
    // Free the result set
    mysqli_free_result($execute_query);
    // Return the fetched todos
    return $todos;
}

function getTodoAttire(){
    global $cxn;
    $user_id = $_SESSION['user_id'] ;
    $category = "Attire";
    $query = "SELECT * FROM task WHERE user_id = '$user_id' AND category = '$category'";
    $execute_query = mysqli_query($cxn, $query);
    // Check if the query execution was successful
    if (!$execute_query) {
        die("Query failed: " . mysqli_error($cxn));
    }
    // Fetch all rows as an associative array
    $todos = mysqli_fetch_all($execute_query, MYSQLI_ASSOC);
    // Free the result set
    mysqli_free_result($execute_query);
    // Return the fetched todos
    return $todos;
}

function getTodoMusic(){
    global $cxn;
    $user_id = $_SESSION['user_id'] ;
    $category = "Music";
    $query = "SELECT * FROM task WHERE user_id = '$user_id' AND category = '$category'";
    $execute_query = mysqli_query($cxn, $query);
    // Check if the query execution was successful
    if (!$execute_query) {
        die("Query failed: " . mysqli_error($cxn));
    }
    // Fetch all rows as an associative array
    $todos = mysqli_fetch_all($execute_query, MYSQLI_ASSOC);
    // Free the result set
    mysqli_free_result($execute_query);
    // Return the fetched todos
    return $todos;
}

function getTodoFlower(){
    global $cxn;
    $user_id = $_SESSION['user_id'] ;
    $category = "Flowers & Decor";
    $query = "SELECT * FROM task WHERE user_id = '$user_id' AND category = '$category'";
    $execute_query = mysqli_query($cxn, $query);
    // Check if the query execution was successful
    if (!$execute_query) {
        die("Query failed: " . mysqli_error($cxn));
    }
    // Fetch all rows as an associative array
    $todos = mysqli_fetch_all($execute_query, MYSQLI_ASSOC);
    // Free the result set
    mysqli_free_result($execute_query);
    // Return the fetched todos
    return $todos;
}

function getTodoBeauty(){
    global $cxn;
    $user_id = $_SESSION['user_id'] ;
    $category = "Beauty";
    $query = "SELECT * FROM task WHERE user_id = '$user_id' AND category = '$category'";
    $execute_query = mysqli_query($cxn, $query);
    // Check if the query execution was successful
    if (!$execute_query) {
        die("Query failed: " . mysqli_error($cxn));
    }
    // Fetch all rows as an associative array
    $todos = mysqli_fetch_all($execute_query, MYSQLI_ASSOC);
    // Free the result set
    mysqli_free_result($execute_query);
    // Return the fetched todos
    return $todos;
}

function getOthers(){
    global $cxn;
    $user_id = $_SESSION['user_id'] ;
    $category = "Others";
    $query = "SELECT * FROM task WHERE user_id = '$user_id' AND category = '$category'";
    $execute_query = mysqli_query($cxn, $query);
    // Check if the query execution was successful
    if (!$execute_query) {
        die("Query failed: " . mysqli_error($cxn));
    }
    // Fetch all rows as an associative array
    $todos = mysqli_fetch_all($execute_query, MYSQLI_ASSOC);
    // Free the result set
    mysqli_free_result($execute_query);
    // Return the fetched todos
    return $todos;
}

function changeStatus($t_id, $status){
    global $cxn;
    if($status === 'Incomplete'){
        $query = "UPDATE `task` SET `status`= 0 WHERE `t_id` = $t_id";
        $execute_query = mysqli_query($cxn, $query);
        if($execute_query){
        }
    }
    if($status === 'Completed'){
        $query = "UPDATE `task` SET `status`= 1 WHERE `t_id` = $t_id";
        $execute_query = mysqli_query($cxn, $query);
        if($execute_query){
        }
    }
}

function deleteTask($t_id){
    global $cxn;
    $query = "DELETE FROM `task` WHERE `t_id` = '$t_id'";
    $execute_query = mysqli_query($cxn, $query);

    if($execute_query){
    }
}

function deleteQuotation($q_id){
    global $cxn;
    $query = "DELETE FROM `user_quotation` WHERE `q_id` = '$q_id'";
    $execute_query = mysqli_query($cxn, $query);

    if($execute_query){
    }
}

function deleteExpenses($b_id){
    global $cxn;
    $query = "DELETE FROM `budgeter` WHERE `b_id` = '$b_id'";
    $execute_query = mysqli_query($cxn, $query);

    if($execute_query){
    }
}

function getSingleTask($t_id){
    global $cxn;
    $query = "SELECT * FROM `task` WHERE `t_id` = '$t_id'";
    $execute_query = mysqli_query($cxn, $query);
    $get_todo = mysqli_fetch_assoc($execute_query);
    return $get_todo;
}

function updateTask($request){
    global $cxn;
    $t_id = mysqli_real_escape_string($cxn,$request['t_id']);
    $task = mysqli_real_escape_string($cxn,$request['task']);
    $description = mysqli_real_escape_string($cxn,$request['description']);

    $query = "UPDATE `task` SET `task` = '$task', `description` = '$description' WHERE `t_id` = '$t_id'";
    $execute_query = mysqli_query($cxn, $query);
    if($execute_query){
        header('location: WedCheck.php');
    }
}

function updateProfile($request) {
    global $cxn;
    $user_id = $_SESSION['user_id'];
    $name = mysqli_real_escape_string($cxn, $request['name']);
    $email = mysqli_real_escape_string($cxn, $request['email']);
    $password = mysqli_real_escape_string($cxn, $request['password']);
    $query = "UPDATE `user` SET `name` = '$name', `email` = '$email', `password` = '$password' WHERE `user_id` = '$user_id'";
    $execute_query = mysqli_query($cxn, $query);
    if ($execute_query) {
    }
}

function calculateCompletionPercentage($tasks) {
    $totalTasks = count($tasks);
    if ($totalTasks == 0) {
        return 0; // Avoid division by zero
    }
    $completedTasks = count(array_filter($tasks, function($task) {
        return $task['status'] == 1;
    }));
    return ($completedTasks / $totalTasks) * 100;
}

function totalTask($tasks) {
    if (!is_array($tasks)) {
        return 0; // If $tasks is not an array, return 0
    }
    return count($tasks);
}

function totalComplete($tasks) {
    $totalTasks = count($tasks);
    if ($totalTasks == 0) {
        return 0; // Avoid division by zero
    }
    $complete = count(array_filter($tasks, function($task) {
        return $task['status'] == 1;
    }));
    return $complete;
}

function updateMaxBudget($max_budget){
    global $cxn;
    $user_id = $_SESSION['user_id'];
    // Check if $max_budget is an array
    if (is_array($max_budget)) {
        // Handle array data accordingly (for example, implode array values into a string)
        $max_budget = implode(', ', $max_budget);
    }
    // Escape the string value
    $max_budget = mysqli_real_escape_string($cxn, $max_budget);
    $query = "UPDATE `user` SET `max_budget` = '$max_budget' WHERE `user_id` = '$user_id'";
    $execute_query = mysqli_query($cxn, $query);
    if($execute_query){
        header('location: budgeter.php');
    }
}

function getMaxBudget(){
    global $cxn;
    $user_id = $_SESSION['user_id'];

    $query = "SELECT `max_budget` FROM `user` WHERE `user_id` = '$user_id'";
    $result = mysqli_query($cxn, $query);
    
    if($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        return $row['max_budget'];
    } else {
        return "No max budget found."; // Or handle this case according to your application logic
    }
}

function addExpenses($request){
    global $cxn;
    //sanitize user inputs to prevent SQL injection
    $vendor = mysqli_real_escape_string($cxn, $_POST['vendor']);
    $phone = mysqli_real_escape_string($cxn, $_POST['phone']);
    $price = mysqli_real_escape_string($cxn, $_POST['price']);
    $detail = mysqli_real_escape_string($cxn, $_POST['detail']);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);

    //get user id from the session
    $user_id = $_SESSION['user_id'];

    //insert the task into database
    $insert_query = "INSERT INTO budgeter (user_id, vendor, price, phone, detail, category) VALUES ('$user_id', '$vendor', '$price', '$phone', '$detail', '$category')";
    $insert_result = mysqli_query($cxn, $insert_query);
}

function getBudgeter(){
    global $cxn;
    $user_id = $_SESSION['user_id'] ;
    $query = "SELECT * FROM budgeter WHERE user_id = '$user_id'";
    $execute_query = mysqli_query($cxn, $query);
    // Check if the query execution was successful
    if (!$execute_query) {
        die("Query failed: " . mysqli_error($cxn));
    }
    // Fetch all rows as an associative array
    $expenses = mysqli_fetch_all($execute_query, MYSQLI_ASSOC);
    // Free the result set
    mysqli_free_result($execute_query);
    // Return the fetched todos
    return $expenses;
}

function addToBudgeter($q_id) {
    global $cxn;
    // Fetch the quotation details based on q_id
    $query = "SELECT * FROM user_quotation WHERE q_id = '$q_id'";
    $user_id = $_SESSION['user_id'];
    $result = mysqli_query($cxn, $query);
    $quotation = mysqli_fetch_assoc($result);
    // Insert the quotation details into the budgeter table
    $insertQuery = "INSERT INTO budgeter (user_id, vendor, phone, price, detail, category) VALUES (
      '$user_id',
      '" . mysqli_real_escape_string($cxn, $quotation['vendor_name']) . "',
      '" . mysqli_real_escape_string($cxn, $quotation['phone']) . "',
      " . $quotation['price'] . ",
      '" . mysqli_real_escape_string($cxn, $quotation['detail']) . "',
      '" . mysqli_real_escape_string($cxn, $quotation['category']) . "'
    )";
    mysqli_query($cxn, $insertQuery);
}

function getTotalExpenses(){
    global $cxn;
    $user_id = $_SESSION['user_id'] ;
    
    // Query to calculate the total price
    $query = "SELECT SUM(price) AS total_expenses FROM budgeter WHERE user_id = '$user_id'";
    
    $execute_query = mysqli_query($cxn, $query);
    // Check if the query execution was successful
    if (!$execute_query) {
        die("Query failed: " . mysqli_error($cxn));
    }
    // Fetch the total price
    $row = mysqli_fetch_assoc($execute_query);
    $total_expenses = $row['total_expenses'];
    // Free the result set
    mysqli_free_result($execute_query);
    // Return the total price
    return $total_expenses;
}

function getBalance(){
    global $cxn;
    $user_id = $_SESSION['user_id'];

    // Query to get the max budget
    $max_budget_query = "SELECT max_budget FROM `user` WHERE `user_id` = '$user_id'";
    $max_budget_result = mysqli_query($cxn, $max_budget_query);
    if (!$max_budget_result) {
        die("Query failed: " . mysqli_error($cxn));
    }
    $max_budget_row = mysqli_fetch_assoc($max_budget_result);
    $max_budget = $max_budget_row['max_budget'];

    // Query to calculate the total price
    $total_expenses_query = "SELECT SUM(price) AS total_expenses FROM budgeter WHERE user_id = '$user_id'";
    $total_expenses_result = mysqli_query($cxn, $total_expenses_query);
    if (!$total_expenses_result) {
        die("Query failed: " . mysqli_error($cxn));
    }
    $total_expenses_row = mysqli_fetch_assoc($total_expenses_result);
    $total_expenses = $total_expenses_row['total_expenses'];

    // Calculate balance
    $balance = $max_budget - $total_expenses;

    return $balance;
}
