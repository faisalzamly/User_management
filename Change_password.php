<?php 
session_start(); 
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'web4';

$conn = mysqli_connect($host, $user, $password, $dbname);// or (die('Failed'));
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $user_id = $_SESSION['id'];
    $query = "SELECT * FROM profile WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $password_old = $row['Password'];
        
    }
$errors = [];

if (isset($_POST['send'])) {
    $pass = $_POST['password'];
    
    if ($_POST['password'] != $password_old) {
        $errors[] = 'password does not match';

    }
    if ($_POST['new_password'] != $_POST['sure_password']) {
        $errors[] = 'password does not match';

    }
$pass=$_POST['new_password'];
    if(count($errors) > 0) {
        echo "<ul class='text-danger'>";
        foreach($errors as $error){
            echo "<li>" . $error . "</li>";
        }
        echo '</ul>';
    }
    else{
            
		if (mysqli_num_rows($result) == 1) {
			$sql = "UPDATE profile SET password = '$pass' WHERE id = $user_id";
			mysqli_query($conn, $sql);
			echo "Password updated successfully.";
		} 
    }}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/signup.css">
    <link rel="icon" href="img/img1.png">
    <title>Change password</title>
</head>
<body>
  <center>
    <section>
        <header>
            <div><ul class="logo">  
            <li ><a href="logout.php" >logout</a></li></ul></div>
        <nav><ul class="nav1"> 
            <li><a href="prog.php" >home</a></li>
            <li><a id="acolor" href="Change_password.php" >Change password</a></li>
            <li><a href="prog.php" >programmers</a></li>
            <li><a href="" >Our courses</a></li>
            <li><a href="" >call us</a></li>
            </ul></nav>
        </header>
        <div class="mainsigin">
        <div >
            <h1 id="name">YD</h1>
            <div class="icons">
                <a href="https://www.linkedin.com/in/faisal-zamly-020900247/" target="-blank" title="go to linkedin"><i
                        class="fab fa-linkedin"></i></a>
                <a href="https://www.facebook.com/" target="-blank" title="go to facebook"><i
                        class="fab fa-facebook"></i></a>
                <a href="#" title="go to github"><i class="fab fa-github"></i></a>
                <a href="#" title="not available"><i class="fab fa-instagram"></i></a>
                <a href="#" title="not available"><i class="fab fa-youtube"></i></a>
            </div>
           </div>
          <form method="post" enctype="multipart/form-data">
            <div class="inp">
                <label for="password"> password</label>
                <input type="password" id="password"  name="password" placeholder="enter password" minlength="8">
            </div>
            <div class="inp">
                <label for="newpassword">new password</label>
                <input type="password" id="newpassword"  name="new_password" placeholder="new password" minlength="8">
            </div>
            <div class="inp">
                <label for="surepassword"> password</label>
                <input type="password" id="surepassword"  name="sure_password" placeholder="sure password" minlength="8">
            </div>
           
            <div class="but">
                <button name="send" type="submit">Change password</button>
            </div>  
          </form>
          
        </div>
        
        <footer>
            <div class="foot">
            <p>Email</p>
            <a href="mailto:fisal@gmail.com">faisal@gmail.com</a>
        </div>
        <div class="foot">
            <p>Site</p>
            <a href="http://">Gaza/Rafah</a>
        </div>
        <div class="foot">
            <p>telephone</p>
            <a href="tel:+970599999999">+970599999999</a>
        </div>
        
        </footer>
    </section>
  </center>  
  
  <script src="js/signup.js"></script>
</body>
</html>
         