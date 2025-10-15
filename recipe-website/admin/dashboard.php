<?php
// admin/dashboard.php
include 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #fff8f0;
            margin: 0;
            padding: 0;
        }

        .admin-header {
            background: linear-gradient(90deg, #ff7b00, #ffb84d);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 40px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .admin-header h1 {
            margin: 0;
            font-size: 26px;
        }

        .admin-header a {
            background: #fff;
            color: #ff7b00;
            padding: 8px 16px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .admin-header a:hover {
            background: #ffe0b3;
        }

        .admin-container {
            text-align: center;
            padding: 60px 20px;
        }

        .admin-container h2 {
            font-size: 28px;
            color: #333;
        }

        .admin-container p {
            color: #555;
            font-size: 16px;
            margin-bottom: 40px;
        }

        .tabs {
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .tab {
            background: #ffb84d;
            color: #fff;
            padding: 15px 30px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            transition: 0.3s ease;
        }

        .tab:hover {
            background: #ff9500;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <h1>Admin Dashboard</h1>
        <a href="logout.php">Logout</a>
    </div>

    <div class="admin-container">
        <h2>Welcome, Admin!</h2>
        <p>Select an option to manage your website content.</p>

        <div class="tabs">
            <a class="tab" href="manage_recipes.php">🍲 Manage Recipes</a>
            <a class="tab" href="view_feedback.php">⭐ View Feedback & Ratings</a>
        </div>
    </div>
</body>
</html>
