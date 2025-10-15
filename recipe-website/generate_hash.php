<?php
// generate_hash.php
$passwordToHash = 'admin123';
$hashedPassword = password_hash($passwordToHash, PASSWORD_DEFAULT);

echo "<h1>Password Hash for 'admin123'</h1>";
echo "<p>Copy the hash below and update it in your database.</p>";
echo "<textarea rows='3' cols='80' readonly>" . htmlspecialchars($hashedPassword) . "</textarea>";
?>