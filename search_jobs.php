<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Jobs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Search for Jobs</h2>
        <form action="search_jobs.php" method="GET">
            <input type="text" name="keyword" placeholder="Keyword (e.g., Engineer)" required>
            <input type="text" name="location" placeholder="Location (e.g., Riyadh)" required>
            <button type="submit">Search</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['keyword']) && isset($_GET['location'])) {
            $keyword = $_GET['keyword'];
            $location = $_GET['location'];

            // Fetch job results from the database
            $sql = "SELECT * FROM jobs WHERE title LIKE '%$keyword%' AND location LIKE '%$location%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h2>Job Results</h2>";
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Job Title</th>";
                echo "<th>Description</th>";
                echo "<th>Location</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>No jobs found matching your criteria.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
