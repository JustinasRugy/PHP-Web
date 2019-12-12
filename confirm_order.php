<?php
session_start();
if ($_SESSION['valid'] != true)
    header("Location: login.php");

include ('db.php');
$id = $_GET['id'];
$owner_id = $_SESSION['id'];
$sql = "UPDATE orders SET status = 'Approved By Client' WHERE id = $id AND owner_id = $owner_id";
        $result = mysqli_query($con, $sql);
        header("Location: orders.php");

