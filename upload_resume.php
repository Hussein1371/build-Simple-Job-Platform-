<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['resume'])) {
    $user_id = $_SESSION['user_id'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["resume"]["name"]);
    $uploadOk = 1;

    // Move uploaded file
    if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO resumes (user_id, resume_path) VALUES ('$user_id', '$target_file')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Resume uploaded successfully!'); window.location.href = 'dashboard.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Error uploading resume.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Resume</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Upload Your Resume</h2>
        <form action="upload_resume.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="resume" required>
            <button type="submit">Upload Resume</button>
        </form>
    </div>
</body>
</html>
