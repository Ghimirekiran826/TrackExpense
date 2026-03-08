<?php
session_start();
include("db.php");

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

/* TOTAL EXPENSE */
$total_sql = "SELECT SUM(amount) AS total_expense FROM expenses";
$total_result = mysqli_query($conn,$total_sql);
$total_row = mysqli_fetch_assoc($total_result);
$total_expense = $total_row['total_expense'];

if($total_expense == NULL){
$total_expense = 0;
}

/* THIS MONTH EXPENSE */
$month_sql = "SELECT SUM(amount) AS month_total 
FROM expenses 
WHERE MONTH(expense_date)=MONTH(CURDATE()) 
AND YEAR(expense_date)=YEAR(CURDATE())";

$month_result = mysqli_query($conn,$month_sql);
$month_row = mysqli_fetch_assoc($month_result);
$this_month = $month_row['month_total'];

if($this_month == NULL){
$this_month = 0;
}

/* CATEGORY COUNT */
$cat_sql = "SELECT COUNT(DISTINCT category) AS total_cat FROM expenses";
$cat_result = mysqli_query($conn,$cat_sql);
$cat_row = mysqli_fetch_assoc($cat_result);
$total_categories = $cat_row['total_cat'];

if($total_categories == NULL){
$total_categories = 0;
}

/* RECENT EXPENSES */
$recent_sql = "SELECT * FROM expenses ORDER BY id DESC LIMIT 5";
$recent_result = mysqli_query($conn,$recent_sql);

?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard - Expense Tracker</title>

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
background:white;
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

.cards{
display:flex;
gap:20px;
margin-bottom:30px;
flex-wrap:wrap;
}

.card{
width:220px;
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 3px 10px rgba(0,0,0,0.1);
text-align:center;
}

.card h3{
margin-bottom:10px;
}

.card p{
font-size:28px;
font-weight:bold;
color:#2f6b1f;
margin:0;
}

.table-box{
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

table{
width:100%;
border-collapse:collapse;
margin-top:15px;
}

th,td{
padding:12px;
border:1px solid #ccc;
text-align:left;
}

th{
background:#e9f2c7;
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

<div class="menu-item active">
<a href="dashboard.php">Dashboard</a>
</div>

<div class="menu-item">
<a href="addexpense.php">Add Expense</a>
</div>

<div class="menu-item">
<a href="viewexpense.php">View Expenses</a>
</div>

<div class="menu-item">
<a href="reports.php">Reports</a>
</div>

<div class="menu-item">
<a href="logout.php">Logout</a>
</div>

</div>

<div class="content">

<h1>Dashboard</h1>

<div class="cards">

<div class="card">
<h3>Total Expense</h3>
<p>Rs <?php echo $total_expense; ?></p>
</div>

<div class="card">
<h3>This Month</h3>
<p>Rs <?php echo $this_month; ?></p>
</div>

<div class="card">
<h3>Categories</h3>
<p><?php echo $total_categories; ?></p>
</div>

</div>

<div class="table-box">

<h2>Recent Expenses</h2>

<table>

<tr>
<th>ID</th>
<th>Title</th>
<th>Category</th>
<th>Amount</th>
<th>Date</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($recent_result))
{
?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['title']; ?></td>
<td><?php echo $row['category']; ?></td>
<td>Rs <?php echo $row['amount']; ?></td>
<td><?php echo $row['expense_date']; ?></td>
</tr>

<?php
}
?>

</table>

</div>

</div>

</div>

</body>
</html>