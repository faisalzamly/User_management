
<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $username = $_POST['username'];
    $password = $_POST['password'];

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'web4';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // $admin=1;
    $query = "SELECT * FROM profile WHERE username = '$username' AND password = '$password'";
    // $query2 = "SELECT * FROM profile WHERE username = '$username' AND password = '$password' AND admin='$admin'";
    $result = mysqli_query($conn, $query);
    // $result2 = mysqli_query($conn, $query2);
    // $arr=[];
    //  for ($i = mysqli_num_rows($result2); $i >0; $i--) {
    //     $query3 = "SELECT * FROM profile  WHERE id = '$admin'";
    //     $result3 = mysqli_query($conn, $query3);
    //     $row = mysqli_fetch_assoc($result3);
    //     $username2= $row['username'];
    //     $arr[]=$username2;
    // } 
    // $_SESSION['arr'] =$arr;

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $id;
        header('Location: prog.php');
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="img/img1.png">
    <title>login</title>
</head>
<body>
  <center>
    <section>
        <header>
            <div><ul class="logo">  
                <li > <a href="signup.php" >sign up</a></li>
                <li ><a href="login.php" >login</a></li></ul></div>
        <nav><ul class="nav1"> 
            <li><a href="" >home</a></li>
            <li><a id="acolor" href="Change_password.php" >Change password</a></li>
            <li><a href="" >programmers</a></li>
            <li><a href="" >Our courses</a></li>
            <li><a href="" >call us</a></li>
            </ul></nav>
        </header>
        <div class="mainsigin">
        <div >
            <h1 id="name">YD</h1>
            <div  class="icons">
                <a  href="https://www.linkedin.com/in/faisal-zamly-020900247/" target="-blank" title="go to linkedin"><i
                        class="fab fa-linkedin"></i></a>
                <a  href="https://www.facebook.com/" target="-blank" title="go to facebook"><i
                        class="fab fa-facebook"></i></a>
                <a   href="#" title="go to github"><i class="fab fa-github"></i></a>
                <a   href="#" title="not available"><i class="fab fa-instagram"></i></a>
                <a onmouseup="mou()" onmousedown="moud()" id="icons1" href="#" title="not available"><i class="fab fa-youtube"></i></a>
            </div>
           </div>
          <form method="post">
            <div class="inp">
                <label for="username"> username</label>
                <input type="text"name="username" id="username" placeholder="enter username">
            </div>
            <!-- <script>
                document.getElementById("username").focus();
              </script> -->
            <div class="inp">
                <label for="password"> password</label>
                <input type="password"  name="password" id="password" placeholder="enter password">
            </div>
            
            <div class="but">
                <button type="submit" value="Login">LOGIN</button>
            </div>  
            <a href="" id="forgot">Forgot password?</a> 
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
  <script src="js/login.js"></script>
</body>
</html>