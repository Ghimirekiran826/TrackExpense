<?php
session_start();
include("db.php");

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

/* Total expense */
$total_sql = "SELECT SUM(amount) AS total_expense FROM expenses";
$total_result = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_assoc($total_result);
$total_expense = $total_row['total_expense'];

if($total_expense == null)
{
    $total_expense = 0;
}

/* Food total */
$food_sql = "SELECT SUM(amount) AS food_total FROM expenses WHERE category='Food'";
$food_result = mysqli_query($conn, $food_sql);
$food_row = mysqli_fetch_assoc($food_result);
$food_total = $food_row['food_total'];

if($food_total == null)
{
    $food_total = 0;
}

/* Travel total */
$travel_sql = "SELECT SUM(amount) AS travel_total FROM expenses WHERE category='Travel'";
$travel_result = mysqli_query($conn, $travel_sql);
$travel_row = mysqli_fetch_assoc($travel_result);
$travel_total = $travel_row['travel_total'];

if($travel_total == null)
{
    $travel_total = 0;
}

/* Bills total */
$bills_sql = "SELECT SUM(amount) AS bills_total FROM expenses WHERE category='Bills'";
$bills_result = mysqli_query($conn, $bills_sql);
$bills_row = mysqli_fetch_assoc($bills_result);
$bills_total = $bills_row['bills_total'];

if($bills_total == null)
{
    $bills_total = 0;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Reports - Expense Tracker</title>

<style>
body{
margin:0;
font-family:Arial;
background:#f2f2f2;
}

.topbar{
background:#c9ab95;
padding:20px 30px;
display:flex;
justify-content:space-between;
align-items:center;
font-size:20px;
font-weight:bold;
}

.main{
display:flex;
min-height:100vh;
}

.sidebar{
width:230px;
background:#ffffff;
border-right:1px solid #ccc;
}

.menu-item{
padding:18px 20px;
border-bottom:1px solid #ddd;
font-size:18px;
}

.menu-item a{
text-decoration:none;
color:black;
display:block;
}

.menu-item:hover{
background:#f0f0f0;
}

.active{
background:#b7db58;
font-weight:bold;
}

.content{
flex:1;
padding:30px;
}

.report-box{
background:white;
padding:25px;
border-radius:10px;
box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

.report-box h1{
margin-top:0;
margin-bottom:20px;
}

.cards{
display:flex;
gap:20px;
flex-wrap:wrap;
margin-bottom:30px;
}

.card{
width:220px;
background:#eef5d5;
padding:20px;
border-radius:10px;
text-align:center;
}

.card h3{
margin:0 0 10px 0;
font-size:22px;
}

.card p{
margin:0;
font-size:28px;
font-weight:bold;
color:#2f6b1f;
}

.summary{
margin-top:20px;
line-height:1.8;
font-size:18px;
}
</style>

</head>
<body>

<div class="topbar">
<div>Expense Tracker Dashboard</div>
<div>Welcome, <?php echo $username; ?></div>
</div>

<div class="main">

<div class="sidebar">
<div class="menu-item"><a href="dashboard.php">Dashboard</a></div>
<div class="menu-item"><a href="addexpense.php">Add Expense</a></div>
<div class="menu-item"><a href="viewexpense.php">View Expenses</a></div>
<div class="menu-item active"><a href="reports.php">Reports</a></div>
<div class="menu-item"><a href="logout.php">Logout</a></div>
</div>

<div class="content">
<div class="report-box">
<h1>Expense Reports</h1>

<div class="cards">
<div class="card">
<h3>Total Expense</h3>
<p>Rs <?php echo $total_expense; ?></p>
</div>

<div class="card">
<h3>Food</h3>
<p>Rs <?php echo $food_total; ?></p>
</div>

<div class="card">
<h3>Travel</h3>
<p>Rs <?php echo $travel_total; ?></p>
</div>

<div class="card">
<h3>Bills</h3>
<p>Rs <?php echo $bills_total; ?></p>
</div>
</div>

<div class="summary">
<p><strong>Monthly Summary:</strong> Your total expense is $<?php echo $total_expense; ?>.</p>
<p><strong>Food Expense:</strong> Rs <?php echo $food_total; ?></p>
<p><strong>Travel Expense:</strong> Rs <?php echo $travel_total; ?></p>
<p><strong>Bills Expense:</strong> Rs <?php echo $bills_total; ?></p>
</div>

</div>
</div>

</div>

</body>
</html>