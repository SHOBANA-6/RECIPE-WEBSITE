<?php
// index.php
include 'includes/db_connect.php';
include 'includes/header.php';

// Fetch recipes grouped by category
$sql = "SELECT * FROM recipes ORDER BY category, name";
$result = $conn->query($sql);

$recipes_by_category = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $recipes_by_category[$row['category']][] = $row;
    }
}
?>

<div class="container">
    <div class="search-container">
        <form method="GET" action="index.php" class="search-bar">

        <input type="search" id="searchInput" placeholder="Search for a recipe...">
     <button type="submit">Search</button>
</form>
    </div>

    <?php if (!empty($recipes_by_category)): ?>
        <?php foreach ($recipes_by_category as $category => $recipes): ?>
            <section class="category-section">
                <h2 class="category-title"><?php echo htmlspecialchars($category); ?></h2>
                <div class="recipe-grid">
                    <?php foreach ($recipes as $recipe): ?>
                        <div class="recipe-card">
                            <img src="<?php echo htmlspecialchars($recipe['image_url']); ?>" alt="<?php echo htmlspecialchars($recipe['name']); ?>">
                            <div class="recipe-card-content">
                                <h3><?php echo htmlspecialchars($recipe['name']); ?></h3>
                                <p><?php echo htmlspecialchars($recipe['description']); ?></p>
                                <a href="recipe_details.php?id=<?php echo $recipe['id']; ?>" class="btn">View Recipe</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No recipes found.</p>
    <?php endif; ?>

</div>

<?php
$conn->close();
include 'footer.php';
?>