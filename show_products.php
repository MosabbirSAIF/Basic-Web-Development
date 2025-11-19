
<!DOCTYPE html>
<html>
<head>
    <title>All Products</title>
    <style>
        body{ font-family: Arial, sans-serif;background:#f6f8fb; padding:20px;}
        table{ width:100%;border-collapse: collapse;background:#fff;}
        th, td{ border:1px solid #ccc;padding:10px;text-align:left;}
        th{ background:rgb(2,0,29);color:#fff;}
        tr:nth-child(even){ background:#f2f2f2;}
    </style>
</head>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myproducts";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}--

$sql = "SELECT * FROM product_profile";
$result = mysqli_query($conn, $sql);
?>

<body>
    <h1>Product List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Size</th>
            <th>Brand</th>
            <th>Category</th>
            <th>Price</th>
            <th>Weight</th>
            <th>Warranty</th>
            <th>Stock</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>".$row["pname"]."</td>
                        <td>".$row["size"]."</td>
                        <td>".$row["brand"]."</td>
                        <td>".$row["category"]."</td>
                        <td>".$row["price"]."</td>
                        <td>".$row["weight"]."</td>
                        <td>".$row["warranty"]."</td>
                        <td>".$row["stock"]."</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No products found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
mysqli_close($conn);
?>
