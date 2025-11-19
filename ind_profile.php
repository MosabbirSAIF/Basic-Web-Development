<!DOCTYPE html>
<html>
<head>
    <title>Profile Data</title>
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
<body>

<?php
// Get data from form
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

// Display data as table
echo "<h2>Profile Information</h2>";
echo "<table>
        <tr><th>Field</th><th>Value</th></tr>
        <tr><td>Name</td><td>$name</td></tr>
        <tr><td>Father's Name</td><td>$father_name</td></tr>
        <tr><td>Mother's Name</td><td>$mother_name</td></tr>
        <tr><td>Contact Number</td><td>$contact</td></tr>
        <tr><td>Email</td><td>$email</td></tr>
        <tr><td>Address</td><td>$address</td></tr>
        <tr><td>Date of Birth</td><td>$dob</td></tr>
        <tr><td>Sex</td><td>$sex</td></tr>
        <tr><td>Nationality</td><td>$nationality</td></tr>
        <tr><td>Religion</td><td>$religion</td></tr>
      </table>";
?>

</body>
</html>
