<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $employer_id = 2; // Replace with logged-in employer ID

    $sql = "INSERT INTO jobs (employer_id, title, description, location) VALUES ('$employer_id', '$title', '$description', '$location')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Job posted successfully!'); window.location.href = 'dashboard.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Post a Job</h2>
        <form action="post_job.php" method="POST">
            <input type="text" name="title" placeholder="Job Title" required>
            <textarea name="description" placeholder="Job Description" rows="5" required></textarea>
            <input type="text" name="location" placeholder="Location" required>
            <button type="submit">Post Job</button>
        </form>
    </div>
</body>
</html>
