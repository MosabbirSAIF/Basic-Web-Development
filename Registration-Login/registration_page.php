<?php
$servername = "localhost";
$username = "root";      
$password = "";         
$dbname = "profile_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])) {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirm = $_POST['confirm'];

    if($pass !== $confirm) {
        echo "<script>
        document.getElementById('confail').textContent = '*Password Not Matched!';
        </script>";
    } 
	else {
        $sqlname = "SELECT * FROM users WHERE username = '$user'";
        $sqlmail = "SELECT * FROM users WHERE email = '$email'";
        $namechk = mysqli_query($conn, $sqlname);
        $mailchk = mysqli_query($conn, $sqlmail);

        if(!$namechk || !$mailchk) {
            echo "<script>alert('Invalid Query!');</script>";
        } 
        else if(mysqli_num_rows($namechk) > 0) {
            echo "<script> window.onload = function(){
			document.getElementById('usernamefail').innerHTML = '*Username already in use';};
            </script>";
        }
        else if(mysqli_num_rows($mailchk) > 0) {
            echo "<script>window.onload = function(){
			document.getElementById('emailfail').innerHTML = '*Email already in use';};
            </script>";
        }
        else {
            $sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$pass')";
            if(mysqli_query($conn, $sql)) {
                echo "<script>window.onload = function(){
				document.getElementById('success').innerHTML = 'Successfully Registered!';};
                </script>";
            } 
		    else {
                echo "<script>alert('Insertion Error!');</script>";
            }
        }
    }
}

?>

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
        h2 { color: rgb(2,0,29); text-align: center; }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            margin: 0 auto 30px auto;
            box-shadow: 0 0 10px #ccc;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
			box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: rgb(2,0,29);
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: white;
            color: rgb(2,0,29);
            border: 1px solid rgb(2,0,29);
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
            width: 200px; 
            height: 50px; 
            background-color: rgb(2,0,29); 
            color: white; 
            margin: 20px auto;
            display: block;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        #Upd:hover {
            background-color: white; 
            color: rgb(2,0,29);
            border: 1px solid rgb(2,0,29);
        }
        .dodo {
            display: flex;
            text-align: center;
            align-items: center;
            justify-content: center;
        }
        #usernamefail, #passwordfail {
            display: block;
            margin-top: 0;
            margin-bottom: 10px;
        }
        #go{
            margin-top: 10px;
        }
    </style>
    <script>
        function validateForm() {
            let username = document.forms["myform"]["username"].value;
            let email = document.forms["myform"]["email"].value;
            let password = document.forms["myform"]["password"].value;

            let valid = true;

            if(username == "") {
                document.getElementById('usernamefail').innerHTML = '*Username Must Be Filled!';
                valid = false;
            } 
			else if(!/^[A-Za-z\s]*$/.test(username)) {
                document.getElementById('usernamefail').innerHTML = '*Invalid Username!';
                valid = false;
            } 
			else {
                document.getElementById('usernamefail').innerHTML = '';
            }

            if(email == "") {
                document.getElementById('emailfail').innerHTML = '*Email Must Be Filled!';
                valid = false;
            } 
			else if(!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
                document.getElementById('emailfail').innerHTML = '*Invalid Email Pattern!';
                valid = false;
            } 
			else {
                document.getElementById('emailfail').innerHTML = '';
            }

            if(password == "") {
                document.getElementById('passfail').innerHTML = '*Password Must Be Filled!';
                valid = false;
            } 
			else if(!/^[A-Za-z0-9]{8,}$/.test(password)) {
                document.getElementById('passfail').innerHTML = '*Password Must Be At Least 8 Characters!';
                valid = false;
            } 
			else {
                document.getElementById('passfail').innerHTML = '';
            }

            return valid;
    }

    </script>
</head>
<body>

<h2>User Registration</h2>

<form name="myform" method="POST" onsubmit="return validateForm()">
    <label>Username:</label>
    <input type="text" name="username" required>
    <span id="usernamefail" style="color:rgb(250,0,0); font-size:14px;"></span>
    <label>Email:</label>
    <input type="email" name="email" required>
    <span id="emailfail" style="color:rgb(250,0,0); font-size:14px;"></span>
    <label>Password:</label>
    <input type="password" name="password" required>
    <span id="passfail" style="color:rgb(250,0,0); font-size:14px;"></span>
    <label>Confirm Password:</label>
    <input type="password" name="confirm" required>
    <span id="confail" style="color:rgb(250,0,0); font-size:14px;"></span>
    <input id="go" type="submit" name="submit" value="Register">
</form>

<div class="dodo">
    <pre style="font-family: Arial, sans-serif;">Already have an account? </pre> <a href="login_page.php">Login</a>
</div>
<div class="dodo">
    <pre id="success" style="color:rgb(0,195,0); font-size:25px;"></pre>
</div>

</body>
</html>

<?php mysqli_close($conn); ?>
