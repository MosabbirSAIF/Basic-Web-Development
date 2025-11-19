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

// Get data from form
$roll          = $_POST['roll'];
$registration  = $_POST['registration'];
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
$dept_name     = $_POST['dept_name'];
$session       = $_POST['session'];

// Insert into database
$sql = "INSERT INTO students 
        (roll, registration, name, father_name, mother_name, contact, email, address, dob, sex, nationality, religion, dept_name, session) 
        VALUES 
        ('$roll', '$registration', '$name', '$father_name', '$mother_name', '$contact', '$email', '$address', '$dob', '$sex', '$nationality', '$religion', '$dept_name', '$session')";

if (mysqli_query($conn, $sql)) {
    echo "New student information added successfully!<br>";
    echo "<a style='color:rgb(2,0,222);' href='show_student.php'>View All Students</a><br>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
</body>
</html>
