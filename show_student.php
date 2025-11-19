<!DOCTYPE html>
<html>
<head>
    <title>All Students</title>
    <style>
        body { 
            font-family: Arial, sans-serif;
            background:#f6f8fb; 
            padding:20px;
        }
        table{ 
            width:100%;
            border-collapse: collapse;
            background:#fff;
        }
        th, td{
            border:1px solid #ccc;
            padding:10px;
            text-align:left;
        }
        th{
            background:rgb(2,0,29);
            color:#fff;
        }
        tr:nth-child(even){
            background:#f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Student List</h1>
    <table>
        <tr>
            <th>Roll</th>
            <th>Name</th>
            <th>Father's Name</th>
            <th>Mother's Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Address</th>
            <th>DOB</th>
            <th>Sex</th>
            <th>Nationality</th>
            <th>Religion</th>
            <th>Department</th>
            <th>Session</th>
            <th>Actions</th>
        </tr>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dept_profiles";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>".$row['roll']."</td>
                <td>".$row['name']."</td>
                <td>".$row['father_name']."</td>
                <td>".$row['mother_name']."</td>
                <td>".$row['contact']."</td>
                <td>".$row['email']."</td>
                <td>".$row['address']."</td>
                <td>".$row['dob']."</td>
                <td>".$row['sex']."</td>
                <td>".$row['nationality']."</td>
                <td>".$row['religion']."</td>
                <td>".$row['dept_name']."</td>
                <td>".$row['session']."</td>
                <td>
                    <form action='update_student.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='roll' value='".$row['roll']."'>
                        <button type='submit'>Edit</button>
                    </form>
                    <form action='delete_student.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='roll' value='".$row['roll']."'>
                        <button type='submit'>Delete</button>
                    </form>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='14'>No students found</td></tr>";
}

mysqli_close($conn);
?>
    </table>
</body>
</html>
