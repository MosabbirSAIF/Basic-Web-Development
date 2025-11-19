<?php
// --- Database Connection ---
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "dept_profiles";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$roll = $_POST['roll'] ?? '';
$student = [];

// --- Fetch student info for given roll ---
if ($roll) {
    $stmt = $conn->prepare("SELECT * FROM students WHERE roll=?");
    $stmt->bind_param("i", $roll);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Update Student</title>
  <style>
    body{   
        font-family:Arial, sans-serif;
        background-color: rgb(2, 0, 29);
        margin:0;
        padding:20px;
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
        box-shadow:0 4px 12px rgba(0,0,0,0.08);
    }
    label{
        display:block;
        margin-top:12px;
        font-weight:600;
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
        cursor:pointer;
    }
    button:hover{
        background:#374151;
    }
  </style>
</head>
<body>
  <h1>Update Student Information</h1>
  <form action="" method="post">
    <label for="roll">Roll</label>
    <input type="number" id="roll" name="roll" value="<?php echo htmlspecialchars($roll); ?>" readonly>

    <label for="registration">Registration</label>
    <input type="number" id="registration" name="registration" value="<?php echo htmlspecialchars($student['registration'] ?? ''); ?>">

    <label for="name">Name</label>
    <input type="text" id="name" name="username" value="<?php echo htmlspecialchars($student['name'] ?? ''); ?>">

    <label for="father_name">Father's Name</label>
    <input type="text" id="father_name" name="father_name" value="<?php echo htmlspecialchars($student['father_name'] ?? ''); ?>">

    <label for="mother_name">Mother's Name</label>
    <input type="text" id="mother_name" name="mother_name" value="<?php echo htmlspecialchars($student['mother_name'] ?? ''); ?>">

    <label for="contact_number">Contact Number</label>
    <input type="number" id="contact_number" name="contact_number" value="<?php echo htmlspecialchars($student['contact'] ?? ''); ?>">

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email'] ?? ''); ?>">

    <label for="address">Address</label>
    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($student['address'] ?? ''); ?>">

    <label for="dob">Date of Birth</label>
    <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($student['dob'] ?? ''); ?>">

    <label for="sex">Sex</label>
    <select name="sex" id="sex">
        <option value="Male" <?php if (($student['sex'] ?? '')=='Male') echo 'selected'; ?>>Male</option>
        <option value="Female" <?php if (($student['sex'] ?? '')=='Female') echo 'selected'; ?>>Female</option>
        <option value="Custom" <?php if (($student['sex'] ?? '')=='Custom') echo 'selected'; ?>>Custom</option>
    </select>

    <label for="nationality">Nationality</label>
    <input type="text" id="nationality" name="nationality" value="<?php echo htmlspecialchars($student['nationality'] ?? ''); ?>">

    <label for="religion">Religion</label>
    <input type="text" id="religion" name="religion" value="<?php echo htmlspecialchars($student['religion'] ?? ''); ?>">

    <label for="dept_name">Department Name</label>
    <input type="text" id="dept_name" name="dept_name" value="<?php echo htmlspecialchars($student['dept_name'] ?? ''); ?>">

    <label for="session">Session</label>
    <input type="text" id="session" name="session" value="<?php echo htmlspecialchars($student['session'] ?? ''); ?>">

    <button type="submit" name="update">Update Student</button>
  </form>
</body>
</html>

<?php
// --- Handle form submission ---
if (isset($_POST['update'])) {
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

    $updates = [];
    if ($registration) $updates[] = "registration='$registration'";
    if ($name)         $updates[] = "name='$name'";
    if ($father_name)  $updates[] = "father_name='$father_name'";
    if ($mother_name)  $updates[] = "mother_name='$mother_name'";
    if ($contact)      $updates[] = "contact='$contact'";
    if ($email)        $updates[] = "email='$email'";
    if ($address)      $updates[] = "address='$address'";
    if ($dob)          $updates[] = "dob='$dob'";
    if ($sex)          $updates[] = "sex='$sex'";
    if ($nationality)  $updates[] = "nationality='$nationality'";
    if ($religion)     $updates[] = "religion='$religion'";
    if ($dept_name)    $updates[] = "dept_name='$dept_name'";
    if ($session)      $updates[] = "session='$session'";

    if (!empty($updates)) {
        $sql = "UPDATE students SET " . implode(", ", $updates) . " WHERE roll=$roll";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Student with Roll $roll updated successfully!');</script>";
        } else {
            echo "<p style='color:red;text-align:center;'>Error: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p style='color:orange;text-align:center;'>No fields provided to update.</p>";
    }
}?>

<button style="width: 200px; height: 50px; color: white; margin-left: 45%; margin-right: 45%;" type="button" onclick="window.location.href='show_student.php';">View Info</button>


<?php mysqli_close($conn); ?>
