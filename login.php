<?php
include("db.php");
session_start();

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1)
    {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    }
    else
    {
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login - Expense Tracker</title>

<style>
body{
margin:0;
font-family:Arial;
background:#dfead8;
}

.navbar{
background:#c9ab95;
padding:20px 40px;
display:flex;
justify-content:space-between;
align-items:center;
}

.logo{
font-size:40px;
font-weight:bold;
}

.home-btn{
text-decoration:none;
background:#b7db58;
padding:10px 18px;
border-radius:6px;
font-weight:bold;
color:black;
}

.container{
width:350px;
margin:120px auto;
background:white;
padding:35px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.2);
text-align:center;
}

.container h2{
margin-bottom:25px;
font-size:30px;
}

input{
width:90%;
padding:12px;
margin:10px;
border:1px solid #ccc;
border-radius:6px;
font-size:16px;
}

button{
width:95%;
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

.register{
margin-top:15px;
font-size:15px;
}

.register a{
text-decoration:none;
color:#2f6b1f;
font-weight:bold;
}
</style>

</head>
<body>

<div class="navbar">
<div class="logo">Expense Tracker</div>
<div>
<a href="index.html" class="home-btn">Home</a>
</div>
</div>

<div class="container">
<h2>User Login</h2>

<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit" name="login">Login</button>
</form>

<div class="register">
Don't have an account? <a href="register.php">Register</a>
</div>
</div>

</body>
</html>