<!DOCTYPE html>
<html>
<body>
<?php
$servername = "localhost";
$username   = "root";    
$password   = "";        
$dbname     = "tech_industry";  

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get data from form
$id            = $_POST['id'];
$tp            = $_POST['tp'];
$name          = $_POST['username'];
$father_name   = $_POST['father_name'];
$mother_name   = $_POST['mother_name'];
$contact       = $_POST['contact_number'];
$email         = $_POST['email'];
$address       = $_POST['address'];
$dob           = $_POST['dob'];
$sex           = $_POST['sex'];
$nationality   = $_POST['nationality'];
$religion      = $_POST['religion'];
$current_project     = $_POST['current_project'];
$post       = $_POST['post'];

// Insert into database
$sql = "INSERT INTO employee 
        (id, total_project, name, father_name, mother_name, contact, email, address, dob, sex, nationality, religion, current_project, post) 
        VALUES 
        ('$id', '$tp', '$name', '$father_name', '$mother_name', '$contact', '$email', '$address', '$dob', '$sex', '$nationality', '$religion', '$current_project', '$post')";

if (mysqli_query($conn, $sql)) {
    echo "Employee Information Stored Successfully!<br>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
</body>
</html>
