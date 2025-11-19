<?php
$servername = "localhost";
$username = "root";   
$password = "";     
$dbname = "myproducts"; 
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$pname     = $_POST['pname'];
$size      = $_POST['size'];
$brand     = $_POST['brand'];
$category  = $_POST['category'];
$price     = $_POST['price'];
$weight    = $_POST['weight'];
$warranty  = $_POST['warranty'];
$stock     = $_POST['stock'];
$sql = "INSERT INTO product_profile (pname, size, brand, category, price, weight, warranty, stock) 
        VALUES ('$pname', '$size', '$brand', '$category', '$price', '$weight', '$warranty', '$stock')";
if (mysqli_query($conn, query: $sql)) {
    echo "New product added successfully!<br>";
    echo "<a href='show_products.php'>View Products Table</a>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
