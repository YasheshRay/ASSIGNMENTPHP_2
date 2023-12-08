<?php
$host = "172.31.22.43";
$username = "Yasheshkumar200522600";
$password = "XIa1d4vA3c";
$dbname = "Yasheshkumar200522600";

$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Use prepared statements to prevent SQL injection
$gmail = $_POST["Email"];
$pass = $_POST["Password"];

// Check for duplicate email
$duplicate = "SELECT * FROM user WHERE email=?";
$stmt = mysqli_prepare($conn, $duplicate);
mysqli_stmt_bind_param($stmt, "s", $gmail);
mysqli_stmt_execute($stmt);
$result1 = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result1) > 0) {
    echo "Duplicate data";
} else {
    // Insert new user
    $query = "INSERT INTO user (email, pass) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $gmail, $pass);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Inserted";
        // Redirect to login.html
        header("Location: index.html");
        exit(); // Ensure that the script stops here
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
?>
