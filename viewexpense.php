<?php
session_start();
include("db.php");

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM expenses ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>View Expenses - Expense Tracker</title>

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

.table-box{
background:white;
padding:25px;
border-radius:10px;
box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

.table-box h1{
margin-top:0;
margin-bottom:20px;
}

table{
width:100%;
border-collapse:collapse;
}

th, td{
padding:12px;
border:1px solid #ccc;
text-align:left;
}

th{
background:#e9f2c7;
}

.action-btn{
text-decoration:none;
padding:6px 12px;
border-radius:5px;
font-size:14px;
margin-right:5px;
display:inline-block;
}

.edit{
background:#b7db58;
color:black;
}

.delete{
background:#e57373;
color:white;
}
</style>

</head>
<body>

<div class="topbar">
<div>Expense Tracker Dashboard</div>
<div>Welcome, <?php echo $_SESSION['username']; ?></div>
</div>

<div class="main">

<div class="sidebar">
<div class="menu-item"><a href="dashboard.php">Dashboard</a></div>
<div class="menu-item"><a href="addexpense.php">Add Expense</a></div>
<div class="menu-item active"><a href="viewexpense.php">View Expenses</a></div>
<div class="menu-item"><a href="reports.php">Reports</a></div>
<div class="menu-item"><a href="logout.php">Logout</a></div>
</div>

<div class="content">
<div class="table-box">
<h1>View Expenses</h1>

<table>
<tr>
<th>ID</th>
<th>Title</th>
<th>Category</th>
<th>Amount</th>
<th>Date</th>
<th>Description</th>
<th>Action</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['title']; ?></td>
<td><?php echo $row['category']; ?></td>
<td>Rs <?php echo $row['amount']; ?></td>
<td><?php echo $row['expense_date']; ?></td>
<td><?php echo $row['description']; ?></td>
<td>
<a class="action-btn edit" href="editexpense.php?id=<?php echo $row['id']; ?>">Edit</a>
<a class="action-btn delete" href="deleteexpense.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this expense?')">Delete</a>
</td>
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