<?php
session_start();
include("db.php");

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $sql = "DELETE FROM expenses WHERE id='$id'";

    if(mysqli_query($conn, $sql))
    {
        header("Location: viewexpense.php");
        exit();
    }
    else
    {
        echo "Error: " . mysqli_error($conn);
    }
}
else
{
    header("Location: viewexpense.php");
    exit();
}
?>