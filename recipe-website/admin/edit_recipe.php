<?php
// admin/edit_recipe.php
include 'auth.php';
include '../includes/db_connect.php';

$message = '';
$id = $_GET['id'];

// Handle form submission for update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $ingredients = $conn->real_escape_string($_POST['ingredients']);
    $steps = $conn->real_escape_string($_POST['steps']);
    $image_url = $conn->real_escape_string($_POST['image_url']);
    $video_url = $conn->real_escape_string($_POST['video_url']);
    $category = $conn->real_escape_string($_POST['category']);

    if (preg_match('/watch\?v=([a-zA-Z0-9_-]+)/', $video_url, $matches)) {
        $video_url = 'https://www.youtube.com/embed/' . $matches[1];
    }

    $sql = "UPDATE recipes SET name='$name', description='$description', ingredients='$ingredients', steps='$steps', image_url='$image_url', video_url='$video_url', category='$category' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $message = "Recipe updated successfully!";
    } else {
        $message = "Error updating record: " . $conn->error;
    }
}

// Fetch the recipe to edit
$sql = "SELECT * FROM recipes WHERE id=$id";
$result = $conn->query($sql);
$recipe = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Recipe</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="admin-header">
        <h1>Edit Recipe: <?php echo htmlspecialchars($recipe['name']); ?></h1>
        <a href="manage_recipes.php">Back to Recipes</a>
    </div>
    <div class="admin-container">
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="edit_recipe.php?id=<?php echo $id; ?>" method="post" class="form-container" style="max-width: 800px; margin: auto;">
            <div class="form-group">
                <label for="name">Recipe Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($recipe['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="Indian" <?php if($recipe['category'] == 'Indian') echo 'selected'; ?>>Indian</option>
                    <option value="Chinese" <?php if($recipe['category'] == 'Chinese') echo 'selected'; ?>>Chinese</option>
                    <option value="American" <?php if($recipe['category'] == 'American') echo 'selected'; ?>>American</option>
                    <option value="Sweets" <?php if($recipe['category'] == 'Sweets') echo 'selected'; ?>>Sweets</option>
                    <option value="Snacks" <?php if($recipe['category'] == 'Snacks') echo 'selected'; ?>>Snacks</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Short Description:</label>
                <textarea id="description" name="description" rows="3" required><?php echo htmlspecialchars($recipe['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="ingredients">Ingredients (comma-separated):</label>
                <textarea id="ingredients" name="ingredients" rows="4" required><?php echo htmlspecialchars($recipe['ingredients']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="steps">Preparation Steps:</label>
                <textarea id="steps" name="steps" rows="8" required><?php echo htmlspecialchars($recipe['steps']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="image_url">Image URL:</label>
                <input type="url" id="image_url" name="image_url" value="<?php echo htmlspecialchars($recipe['image_url']); ?>" required>
            </div>
            <div class="form-group">
                <label for="video_url">YouTube Video URL:</label>
                <input type="url" id="video_url" name="video_url" value="<?php echo htmlspecialchars(str_replace('embed/', 'watch?v=', $recipe['video_url'])); ?>" required>
            </div>
            <button type="submit">Update Recipe</button>
        </form>
    </div>
</body>
</html>