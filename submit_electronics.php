<!DOCTYPE html>
<html>
<body>
<?php
$servername = "localhost";
$username = "root";   
$password = "";     
$dbname = "electronics"; 
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$pname     = $_POST['pname'];
$vaf      = $_POST['vaf'];
$brand     = $_POST['brand'];
$sm  = $_POST['sm'];
$min     = $_POST['min'];
$price    = $_POST['price'];
$warranty  = $_POST['warranty'];
$stock     = $_POST['stock'];
$sql = "INSERT INTO electronics_products (pname, vaf, brand, sm, price, min, warranty, stock) 
        VALUES ('$pname', '$vaf', '$brand', '$sm', '$price', '$min', '$warranty', '$stock')";
if (mysqli_query($conn, $sql)) {
    echo "New electronic product added successfully!<br>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
</body>
</html>
