<?php
$conn = mysqli_connect("localhost", "root", "root", "expense_tracker");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>