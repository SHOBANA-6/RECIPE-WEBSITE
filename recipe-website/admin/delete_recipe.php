<?php
// admin/delete_recipe.php
include 'auth.php';
include '../includes/db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM recipes WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_recipes.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    header("Location: manage_recipes.php");
    exit();
}
?>