<!-- <!DOCTYPE html>
<html>
<head>
<title>Add Expense - Expense Tracker</title>

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
<div>Welcome User</div>
</div>

<div class="main">

<div class="sidebar">
<div class="menu-item"><a href="dashboard.html">Dashboard</a></div>
<div class="menu-item active"><a href="addexpense.html">Add Expense</a></div>
<div class="menu-item"><a href="viewexpense.html">View Expenses</a></div>
<div class="menu-item"><a href="reports.html">Reports</a></div>
<div class="menu-item"><a href="login.html">Logout</a></div>
</div>

<div class="content">
<div class="form-box">
<h1>Add Expense</h1>

<form>
<input type="text" placeholder="Expense Title" required>

<select required>
<option value="">Select Category</option>
<option>Food</option>
<option>Travel</option>
<option>Bills</option>
<option>Shopping</option>
<option>Other</option>
</select>

<input type="number" placeholder="Amount" required>

<input type="date" required>

<textarea rows="5" placeholder="Description"></textarea>

<button type="submit">Save Expense</button>
</form>
</div>
</div>

</div>

</body>
</html> -->
<?php
session_start();
include("db.php");

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

if(isset($_POST['save']))
{
    $title = $_POST['title'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $expense_date = $_POST['expense_date'];
    $description = $_POST['description'];

    $sql = "INSERT INTO expenses(title, category, amount, expense_date, description)
            VALUES('$title','$category','$amount','$expense_date','$description')";

    if(mysqli_query($conn, $sql))
    {
        echo "<script>alert('Expense added successfully');</script>";
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
<title>Add Expense - Expense Tracker</title>

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
<div class="menu-item active"><a href="addexpense.php">Add Expense</a></div>
<div class="menu-item"><a href="viewexpense.php">View Expenses</a></div>
<div class="menu-item"><a href="reports.php">Reports</a></div>
<div class="menu-item"><a href="logout.php">Logout</a></div>
</div>

<div class="content">
<div class="form-box">
<h1>Add Expense</h1>

<form method="POST">
<input type="text" name="title" placeholder="Expense Title" required>

<select name="category" required>
<option value="">Select Category</option>
<option>Food</option>
<option>Travel</option>
<option>Bills</option>
<option>Shopping</option>
<option>Other</option>
</select>

<input type="number" name="amount" placeholder="Amount" required>
<input type="date" name="expense_date" required>
<textarea name="description" rows="5" placeholder="Description"></textarea>

<button type="submit" name="save">Save Expense</button>
</form>
</div>
</div>

</div>

</body>
</html>