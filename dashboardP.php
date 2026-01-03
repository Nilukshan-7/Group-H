<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'provider') {
    header("Location: ../login.php");
    exit();
}

$provider_id = $_SESSION['user_id'];
$message = "";

if (isset($_POST['submit_solution'])) {
    $pid = $_POST['problem_id'];
    $solution = trim($_POST['solution']);

    mysqli_query($conn,
        "INSERT INTO solutions(problem_id,provider_id,solution)
         VALUES('$pid','$provider_id','$solution')"
    );

    mysqli_query($conn,
        "UPDATE problems SET status='solved' WHERE id='$pid'"
    );

    $message = "Solution submitted successfully";
}
?>