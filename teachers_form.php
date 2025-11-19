<!DOCTYPE html>
<html>
<body>
<?php
$servername = "localhost";
$username   = "root";    
$password   = "";        
$dbname     = "dept_profiles";  

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id          = $_POST["id"];
$name        = $_POST['username'];
$father_name = $_POST['father_name'];
$mother_name = $_POST['mother_name'];
$contact     = $_POST['contact_number'];
$email       = $_POST['email'];
$address     = $_POST['address'];
$dob         = $_POST['dob'];
$sex         = $_POST['sex'];
$nationality = $_POST['nationality'];
$religion    = $_POST['religion'];
$dept_name   = $_POST['dept_name'];
$designation = $_POST['designation'];
$bsc         = $_POST['bsc'];
$msc         = $_POST['msc'];

$sql = "INSERT INTO teachers 
        (id, name, father_name, mother_name, contact, email, address, dob, sex, nationality, religion, dept_name, designation, bsc, msc) 
        VALUES 
        ('$id', '$name', '$father_name', '$mother_name', '$contact', '$email', '$address', '$dob', '$sex', '$nationality', '$religion', '$dept_name', '$designation', '$bsc', '$msc')";

if (mysqli_query($conn, $sql)) {
    echo "New teacher information added successfully!<br>";
    echo "<a style='color:rgb(2,0,222);' href='show_teachers.php'>View All Teachers</a><br>";
    echo "<a style='color:rgb(2,0,222);' href='update_teacher.html'>Update Information</a>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
</body>
</html>
