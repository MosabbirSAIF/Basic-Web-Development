<?php
$servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "dept_profiles";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_POST['id'] ?? '';
$teacher = [];

// --- Fetch student info for given id ---
if ($id) {
    $stmt = $conn->prepare("SELECT * FROM teachers WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $teacher = $result->fetch_assoc();
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Update Teacher</title>
  <style>
    body{   
        font-family:Arial, sans-serif;
        background-color: rgb(2, 0, 29);
        margin:0;
        padding:20px
    }
    h1{
        color:#f6f8fb;
        text-align:center;
    }
    form{
        background:#fff;
        padding:20px;
        border-radius:8px;
        max-width:600px;
        margin:auto;
        box-shadow:0 4px 12px rgba(0,0,0,0.08)
    }
    label{
        display:block;
        margin-top:12px;
        font-weight:600
    }
    input, select{
        width:100%;
        padding:10px;
        margin-top:4px;
        border:1px solid #ccc;
        border-radius:6px;
        font-size:14px;
        box-sizing:border-box;
    }
    button{
        margin-top:20px;
        padding:10px 14px;
        border:none;
        border-radius:6px;
        background:#111827;
        color:#fff;
        font-weight:600;
        cursor:pointer
    }
    button:hover{
        background:#374151
    }
  </style>
</head>
<body>
  <h1>Update Teacher Information</h1>

  <form action="update_teacher.php" method="post">
    <label for="id">Teacher ID</label>
    <input type="number" id="id" name="id" value="<?php echo htmlspecialchars($teacher['id']); ?>" readonly>

    <label for="name">Name</label>
    <input type="text" id="name" name="username" value="<?php echo htmlspecialchars($teacher['name'] ?? ''); ?>">

    <label for="father_name">Father's Name</label>
    <input type="text" id="father_name" name="father_name" value="<?php echo htmlspecialchars($teacher['father_name'] ?? ''); ?>">

    <label for="mother_name">Mother's Name</label>
    <input type="text" id="mother_name" name="mother_name" value="<?php echo htmlspecialchars($teacher['mother_name'] ?? ''); ?>">

    <label for="contact_number">Contact Number</label>
    <input type="number" id="contact_number" name="contact_number" value="<?php echo htmlspecialchars($teacher['contact'] ?? ''); ?>">

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($teacher['email'] ?? ''); ?>">

    <label for="address">Address</label>
    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($teacher['address'] ?? ''); ?>">

    <label for="dob">Date of Birth</label>
    <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($teacher['dob'] ?? ''); ?>">

    <label for="sex">Sex</label>
    <select name="sex" id="sex">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Custom">Custom</option>
    </select>

    <label for="nationality">Nationality</label>
    <input type="text" id="nationality" name="nationality" value="<?php echo htmlspecialchars($teacher['nationality'] ?? ''); ?>">

    <label for="religion">Religion</label>
    <input type="text" id="religion" name="religion" value="<?php echo htmlspecialchars($teacher['religion'] ?? ''); ?>">

    <label for="dept_name">Department Name</label>
    <input type="text" id="dept_name" name="dept_name" value="<?php echo htmlspecialchars($teacher['dept_name'] ?? ''); ?>">

    <label for="designation">Designation</label>
    <input type="text" id="designation" name="designation" value="<?php echo htmlspecialchars($teacher['designation'] ?? ''); ?>">

    <label for="bsc">B.Sc.</label>
    <input type="text" id="bsc" name="bsc" value="<?php echo htmlspecialchars($teacher['bsc'] ?? ''); ?>">

    <label for="msc">M.Sc.</label>
    <input type="text" id="msc" name="msc" value="<?php echo htmlspecialchars($teacher['msc'] ?? ''); ?>">

    <button type="submit" name="update">Update Teacher</button>
  </form>
  </body>
</html>

<?php
if (isset($_POST['update'])) {
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id          = $_POST['id'];
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

    $updates = [];
    if ($name)        $updates[] = "name='$name'";
    if ($father_name) $updates[] = "father_name='$father_name'";
    if ($mother_name) $updates[] = "mother_name='$mother_name'";
    if ($contact)     $updates[] = "contact='$contact'";
    if ($email)       $updates[] = "email='$email'";
    if ($address)     $updates[] = "address='$address'";
    if ($dob)         $updates[] = "dob='$dob'";
    if ($sex)         $updates[] = "sex='$sex'";
    if ($nationality) $updates[] = "nationality='$nationality'";
    if ($religion)    $updates[] = "religion='$religion'";
    if ($dept_name)   $updates[] = "dept_name='$dept_name'";
    if ($designation) $updates[] = "designation='$designation'";
    if ($bsc)         $updates[] = "bsc='$bsc'";
    if ($msc)         $updates[] = "msc='$msc'";

    if (!empty($updates)) {
        $sql = "UPDATE teachers SET " . implode(", ", $updates) . " WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Teacher with ID $id updated successfully!');</script>";
        } else {
            echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p style='color:orange;'>No fields provided to update.</p>";
    }?>

<button style="width: 200px; height: 50px; color: white; margin-left: 45%; margin-right: 45%;" type="button" onclick="window.location.href='show_teachers.php';">View Info</button>

<?php
    mysqli_close($conn);
}
?>

