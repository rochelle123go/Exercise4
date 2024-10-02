<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
}

$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    
    $stored_username = "user";
    $stored_password = "password"; 

    if ($username === $stored_username && $password === $stored_password) {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;

        header("location: welcome.php");
    } else {
        echo "Invalid username or password.";
    }
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["error"])) {
        echo "Error: " . htmlspecialchars($_GET["error"]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;}
        .wrapper {    
            width: 360px; 
            padding: 20px; 
            margin: auto; 
            border: 1px solid #ccc; 
            margin-top: 50px; 
            background-color: rgba(255, 255, 255, 0.8);
        }
    </style>   
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Username:</label>
                <input type="text" name="username" value="<?php echo $username; ?>" required>
            </div>    
            <div>
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <input type="submit" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>
