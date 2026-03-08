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
    $sql = "SELECT * FROM expenses WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
else
{
    header("Location: viewexpense.php");
    exit();
}

if(isset($_POST['update']))
{
    $title = $_POST['title'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $expense_date = $_POST['expense_date'];
    $description = $_POST['description'];

    $update_sql = "UPDATE expenses SET 
                    title='$title',
                    category='$category',
                    amount='$amount',
                    expense_date='$expense_date',
                    description='$description'
                    WHERE id='$id'";

    if(mysqli_query($conn, $update_sql))
    {
        header("Location: viewexpense.php");
        exit();
    }
    else
    {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Expense - Expense Tracker</title>

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

.form-box{
width:500px;
background:white;
padding:25px;
border-radius:10px;
box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

.form-box h1{
margin-top:0;
margin-bottom:20px;
}

input, select, textarea{
width:100%;
padding:12px;
margin-bottom:15px;
border:1px solid #ccc;
border-radius:6px;
font-size:16px;
}

button{
width:100%;
padding:12px;
background:#b7db58;
border:none;
border-radius:8px;
font-size:18px;
font-weight:bold;
cursor:pointer;
}

button:hover{
background:#a8c94f;
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
<div class="form-box">
<h1>Edit Expense</h1>

<form method="POST">
<input type="text" name="title" value="<?php echo $row['title']; ?>" required>

<select name="category" required>
<option value="Food" <?php if($row['category']=="Food") echo "selected"; ?>>Food</option>
<option value="Travel" <?php if($row['category']=="Travel") echo "selected"; ?>>Travel</option>
<option value="Bills" <?php if($row['category']=="Bills") echo "selected"; ?>>Bills</option>
<option value="Shopping" <?php if($row['category']=="Shopping") echo "selected"; ?>>Shopping</option>
<option value="Other" <?php if($row['category']=="Other") echo "selected"; ?>>Other</option>
</select>

<input type="number" name="amount" value="<?php echo $row['amount']; ?>" required>
<input type="date" name="expense_date" value="<?php echo $row['expense_date']; ?>" required>
<textarea name="description" rows="5"><?php echo $row['description']; ?></textarea>

<button type="submit" name="update">Update Expense</button>
</form>
</div>
</div>

</div>

</body>
</html>