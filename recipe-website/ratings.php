<?php
// ratings.php
include 'includes/db_connect.php';

// Handle rating submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rating'])) {
    $rating = intval($_POST['rating']);
    if ($rating >= 1 && $rating <= 5) {
        $sql = "INSERT INTO ratings (rating) VALUES ($rating)";
        $conn->query($sql);
    }
    // Redirect to avoid form resubmission
    header("Location: ratings.php");
    exit();
}

// Fetch average rating
$avg_sql = "SELECT AVG(rating) as average_rating, COUNT(*) as total_ratings FROM ratings";
$avg_result = $conn->query($avg_sql);
$avg_data = $avg_result->fetch_assoc();
$average_rating = round($avg_data['average_rating'], 1);
$total_ratings = $avg_data['total_ratings'];

include 'includes/header.php';
?>

<div class="container">
    <div class="form-container">
        <h2>Rate Our Website</h2>
        <p>Your rating helps us improve!</p>
        <form action="ratings.php" method="post">
            <div class="form-group">
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars">★</label>
                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars">★</label>
                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars">★</label>
                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars">★</label>
                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star">★</label>
                </div>
            </div>
            <button type="submit">Submit Rating</button>
        </form>
    </div>

    <div class="display-container">
        <h2>Overall Rating</h2>
        <?php if ($total_ratings > 0): ?>
            <p class="avg-rating">
                Average Rating: <strong><?php echo $average_rating; ?></strong> / 5 
                <span class="stars">
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        echo $i <= $average_rating ? '★' : '☆';
                    }
                    ?>
                </span>
                (based on <?php echo $total_ratings; ?> ratings)
            </p>
        <?php else: ?>
            <p>No ratings yet. Be the first to rate us!</p>
        <?php endif; ?>
    </div>
</div>

<?php
$conn->close();
include 'includes/footer.php';
?>