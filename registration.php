<?php
session_start();

$con = mysqli_connect('localhost', 'root');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_select_db($con, 'igrowthlearning');
$name = $_POST['name'];
$pass = $_POST['password'];
$email = $_POST['email'];

$q = "SELECT * FROM login WHERE username='$name' AND password='$pass'";
$result = mysqli_query($con, $q);

if ($result) {
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        // Duplicate data, redirect to signup.html or handle it as needed
        header('location: signup.html');
    } else {
        $qy = "INSERT INTO login(username, password, email) VALUES('$name', '$pass', '$email')";
        if (mysqli_query($con, $qy)) {
            $_SESSION['username'] = $name; // Set the session variable after successful registration
            header('location: index.php');
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);
?>
