<?php
$servername = "193.203.184.162";
$username = "u564757906_vegitable";
$password = "Glintel@2024#$dkp";
$dbname = "u564757906_mangodb";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch categories
$category_sql = "SELECT * FROM categories";
$category_result = $conn->query($category_sql);

$categories = [];
while ($row = $category_result->fetch_assoc()) {
    $categories[$row['id']] = $row;
    $categories[$row['id']]['subcategories'] = [];
}

print_r($categories);
// Fetch subcategories
$subcategory_sql = "SELECT * FROM subcategories";
$subcategory_result = $conn->query($subcategory_sql);

while ($row = $subcategory_result->fetch_assoc()) {
    $categories[$row['id']]['subcategories'][] = $row;
}
echo "____________--";
 print_r($categories);

$conn->close();
?>
