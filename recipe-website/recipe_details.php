<?php
// recipe_details.php
include 'includes/db_connect.php';
include 'includes/header.php';

// Check if ID is set
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>Invalid recipe ID.</p>";
    include 'includes/footer.php';
    exit();
}

$recipe_id = intval($_GET['id']);

// Fetch recipe details
$sql = "SELECT * FROM recipes WHERE id = $recipe_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $recipe = $result->fetch_assoc();
} else {
    echo "<p>Recipe not found.</p>";
    include 'includes/footer.php';
    exit();
}
?>

<div class="container">
    <div class="recipe-details-container">
        <h1><?php echo htmlspecialchars($recipe['name']); ?></h1>
        <img src="<?php echo htmlspecialchars($recipe['image_url']); ?>" alt="<?php echo htmlspecialchars($recipe['name']); ?>">
        
        <div class="recipe-details-content">
            <h2>Ingredients</h2>
            <ul>
                <?php
                $ingredients = explode(',', $recipe['ingredients']);
                foreach ($ingredients as $ingredient) {
                    echo "<li>" . htmlspecialchars(trim($ingredient)) . "</li>";
                }
                ?>
            </ul>

            <h2>Preparation Steps</h2>
            <ol>
                <?php
                // Splitting steps by new lines starting with a number and a dot.
                $steps = preg_split('/^\d+\.\s*/m', $recipe['steps'], -1, PREG_SPLIT_NO_EMPTY);
                 foreach ($steps as $step) {
                    echo "<li>" . nl2br(htmlspecialchars(trim($step))) . "</li>";
                }
                ?>
            </ol>
            
            <h2>Recipe Video</h2>
            <div class="video-container">
                <iframe src="<?php echo htmlspecialchars($recipe['video_url']); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<?php
$conn->close();
include 'includes/footer.php';
?>