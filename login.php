<?php
require 'register.php';

$email = $_POST["Email"];
$password = $_POST["Password"];
// Debugging
echo "Email: $email, Password: $password";

$duplicate = "SELECT * FROM user WHERE email=? AND pass=?";
$stmt = mysqli_prepare($conn, $duplicate);
mysqli_stmt_bind_param($stmt, "ss", $email, $password);
mysqli_stmt_execute($stmt);
$result1 = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result1) > 0) {
    echo "Logged in Successfully :)";
    // Redirect to login.html
    header("Location: login.html");
    exit(); // Ensure that the script stops here
} else {
    echo "Wrong email or password";
}


mysqli_stmt_close($stmt);
?>
