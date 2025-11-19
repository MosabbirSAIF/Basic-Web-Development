<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "dept_profiles";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

if(isset($_POST['roll'])){
    $roll = $_POST['roll'];
    $sql = "DELETE FROM students WHERE roll='$roll'";
    if(mysqli_query($conn, $sql)){
        header("Location: show_student.php");
        exit;
    } else {
        echo "Error deleting student: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
