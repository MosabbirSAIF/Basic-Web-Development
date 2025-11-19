<!DOCTYPE html>
<html>
<head>
    <title>All Teachers</title>
    <style>
        body{ 
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
        #Upd{
            width: 200px; height: 50px; background-color: rgb(2,0,29); color: white; margin-left: 45%; margin-right: 45%;
        }
        #Upd:hover {
            background-color: white; color: rgb(2,0,29);
        }
    </style>
</head>
<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "dept_profiles";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM teachers";
$result = mysqli_query($conn, $sql);
?>

<body>
    <h1>Teacher List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Father's Name</th>
            <th>Mother's Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Address</th>
            <th>Date of Birth</th>
            <th>Sex</th>
            <th>Nationality</th>
            <th>Religion</th>
            <th>Department</th>
            <th>Designation</th>
            <th>B.Sc.</th>
            <th>M.Sc.</th>
            <th>Edits</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>".$row["id"]."</td>
                        <td>".$row["name"]."</td>
                        <td>".$row["father_name"]."</td>
                        <td>".$row["mother_name"]."</td>
                        <td>".$row["contact"]."</td>
                        <td>".$row["email"]."</td>
                        <td>".$row["address"]."</td>
                        <td>".$row["dob"]."</td>
                        <td>".$row["sex"]."</td>
                        <td>".$row["nationality"]."</td>
                        <td>".$row["religion"]."</td>
                        <td>".$row["dept_name"]."</td>
                        <td>".$row["designation"]."</td>
                        <td>".$row["bsc"]."</td>
                        <td>".$row["msc"]."</td>
                        <td>
                            <form action='update_teacher.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='id' value='".$row['id']."'>
                                <button type='submit'>Edit</button>
                            </form>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='14'>No teacher information found</td></tr>";
        }
        ?>
    </table><br><br>
    <button id="Upd" type="button" onclick="window.location.href='teachers_form.html';">Add New Teacher</button>
</body>
</html>

<?php
mysqli_close($conn);
?>
