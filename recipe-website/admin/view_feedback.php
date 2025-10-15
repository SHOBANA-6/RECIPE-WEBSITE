<?php
// admin/view_feedback.php
include 'auth.php';
include '../includes/db_connect.php';

// Fetch feedback
$feedback_sql = "SELECT * FROM feedback ORDER BY created_at DESC";
$feedback_result = $conn->query($feedback_sql);

// Fetch ratings
$ratings_sql = "SELECT rating, created_at FROM ratings ORDER BY created_at DESC";
$ratings_result = $conn->query($ratings_sql);

// Fetch average rating
$avg_sql = "SELECT AVG(rating) as average_rating, COUNT(*) as total_ratings FROM ratings";
$avg_result = $conn->query($avg_sql);
$avg_data = $avg_result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Feedback & Ratings</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="admin-header">
        <h1>User Feedback & Ratings</h1>
        <div>
            <a href="dashboard.php" style="margin-right: 15px;">Dashboard</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="admin-container">
        <h2>Ratings Summary</h2>
        <p><strong>Average Rating:</strong> <?php echo round($avg_data['average_rating'], 2); ?> / 5</p>
        <p><strong>Total Ratings:</strong> <?php echo $avg_data['total_ratings']; ?></p>
        
        <hr style="margin: 2rem 0;">

        <h2>All Feedback Comments</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Comment</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($feedback_result->num_rows > 0): ?>
                    <?php while($row = $feedback_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['comment']); ?></td>
                            <td><?php echo date("Y-m-d H:i", strtotime($row['created_at'])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="3">No feedback submitted yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php $conn->close(); ?>