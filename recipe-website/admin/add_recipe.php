<?php
// admin/add_recipe.php
include 'auth.php';
include '../includes/db_connect.php';

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $ingredients = $conn->real_escape_string($_POST['ingredients']);
    $steps = $conn->real_escape_string($_POST['steps']);
    $image_url = $conn->real_escape_string($_POST['image_url']);
    $video_url = $conn->real_escape_string($_POST['video_url']);
    $category = $conn->real_escape_string($_POST['category']);

    // Convert regular YouTube URL to embed URL
    if (preg_match('/watch\?v=([a-zA-Z0-9_-]+)/', $video_url, $matches)) {
        $video_url = 'https://www.youtube.com/embed/' . $matches[1];
    }

    $sql = "INSERT INTO recipes (name, description, ingredients, steps, image_url, video_url, category) VALUES ('$name', '$description', '$ingredients', '$steps', '$image_url', '$video_url', '$category')";

    if ($conn->query($sql) === TRUE) {
        $message = "New recipe added successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Recipe</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="admin-header">
        <h1>Add New Recipe</h1>
        <a href="manage_recipes.php">Back to Recipes</a>
    </div>
    <div class="admin-container">
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="add_recipe.php" method="post" class="form-container" style="max-width: 800px; margin: auto;">
            <div class="form-group">
                <label for="name">Recipe Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="Indian">Indian</option>
                    <option value="Chinese">Chinese</option>
                    <option value="American">American</option>
                    <option value="Sweets">Sweets</option>
                    <option value="Snacks">Snacks</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Short Description:</label>
                <textarea id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="ingredients">Ingredients (comma-separated):</label>
                <textarea id="ingredients" name="ingredients" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="steps">Preparation Steps (number each step, e.g., "1. Do this"):</label>
                <textarea id="steps" name="steps" rows="8" required></textarea>
            </div>
            <div class="form-group">
                <label for="image_url">Image URL:</label>
                <input type="url" id="image_url" name="image_url" required>
            </div>
            <div class="form-group">
                <label for="video_url">YouTube Video URL:</label>
                <input type="url" id="video_url" name="video_url" required>
            </div>
            <button type="submit">Add Recipe</button>
        </form>
    </div>
</body>
</html>