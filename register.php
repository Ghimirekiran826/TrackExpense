<?php
include("db.php");

if(isset($_POST['register']))
{
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users(fullname,email,username,password)
            VALUES('$fullname','$email','$username','$password')";

    if(mysqli_query($conn,$sql))
    {
        header("Location: login.php");
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
<title>Register - Expense Tracker</title>

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
width:380px;
margin:80px auto;
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

.login{
margin-top:15px;
font-size:15px;
}

.login a{
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

<h2>Create Account</h2>

<form method="POST">

<input type="text" name="fullname" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email" required>

<input type="text" name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<input type="password" name="confirm_password" placeholder="Confirm Password" required>

<button type="submit" name="register">Register</button>

</form>

<div class="login">
Already have an account? <a href="login.php">Login</a>
</div>

</div>

</body>
</html>