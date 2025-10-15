<?php
// feedback.php
include 'includes/db_connect.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['comment'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $comment = $conn->real_escape_string($_POST['comment']);

    if (!empty($name) && !empty($comment)) {
        $sql = "INSERT INTO feedback (name, comment) VALUES ('$name', '$comment')";
        $conn->query($sql);
    }
    // Redirect to avoid form resubmission on refresh
    header("Location: feedback.php");
    exit();
}

// Fetch all feedback
$sql = "SELECT name, comment, created_at FROM feedback ORDER BY created_at DESC";
$result = $conn->query($sql);
$feedbacks = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;
    }
}

include 'includes/header.php';
?>

<div class="container">
    <div class="form-container">
        <h2>Leave Your Feedback</h2>
        <form action="feedback.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea id="comment" name="comment" rows="5" required></textarea>
            </div>
            <button type="submit">Submit Feedback</button>
        </form>
    </div>

    <div class="display-container">
        <h2>What Others Are Saying</h2>
        <?php if (!empty($feedbacks)): ?>
            <?php foreach ($feedbacks as $feedback): ?>
                <div class="feedback-item">
                    <p>"<?php echo htmlspecialchars($feedback['comment']); ?>"</p>
                    <strong>- <?php echo htmlspecialchars($feedback['name']); ?></strong>
                    <small><?php echo date("F j, Y, g:i a", strtotime($feedback['created_at'])); ?></small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No feedback yet. Be the first to comment!</p>
        <?php endif; ?>
    </div>
</div>

<?php
$conn->close();
include 'includes/footer.php';
?>