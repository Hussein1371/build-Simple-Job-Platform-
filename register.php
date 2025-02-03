<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    $sql = "INSERT INTO users (name, email, password, user_type) VALUES ('$name', '$email', '$password', '$user_type')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Registration successful! Please log in.";
        header("Location: login.php"); // Redirect to login page
        exit();
    } else {
        $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>User Registration</h2>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message">
                <?= $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>
        <form action="register.php" method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="user_type" required>
                <option value="">Select User Type</option>
                <option value="job_seeker">Job Seeker</option>
                <option value="employer">Employer</option>
            </select>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
