<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check user type
$user_type = $_SESSION['user_type'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?= $_SESSION['user_name']; ?>!</h1>
        <p>You are logged in as a <strong><?= ucfirst($user_type); ?></strong>.</p>

        <div class="dashboard-cards">
            <!-- User Actions -->
            <?php if ($user_type == 'job_seeker'): ?>
                <div class="card">
                    <h3>Upload Resume</h3>
                    <p>Showcase your qualifications to employers.</p>
                    <a href="upload_resume.php">Upload Now</a>
                </div>
                <div class="card">
                    <h3>Search Jobs</h3>
                    <p>Find job opportunities by location and preferences.</p>
                    <a href="search_jobs.php">Search Jobs</a>
                </div>
            <?php endif; ?>

            <!-- Employer Actions -->
            <?php if ($user_type == 'employer'): ?>
                <div class="card">
                    <h3>Post Job Openings</h3>
                    <p>Attract candidates by posting job openings.</p>
                    <a href="post_job.php">Post a Job</a>
                </div>
                <div class="card">
                    <h3>Review Applications</h3>
                    <p>View and shortlist applications for your postings.</p>
                    <a href="review_applications.php">Review Applications</a>
                </div>
            <?php endif; ?>
        </div>

        <a href="logout.php" class="logout">Logout</a>
    </div>
</body>
</html>
