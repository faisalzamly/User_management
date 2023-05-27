<?php 
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'web4';

$conn = mysqli_connect($host, $user, $password, $dbname);// or (die('Failed'));
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
   
$query = "SELECT * from profile";
$result = mysqli_query($conn,$query);
if($result===FALSE)
    echo "error". "<br/>" . mysqli_error($con);

if(!file_exists('images')){
    mkdir('images');
}
$username = '';
$email = '';
$pass = '';
$admin = 0;
$errors = [];



if (isset($_POST['send'])) {
    $img_name = ''; 
    $pass = $_POST['password'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    
    
    
    if ($_POST['password'] != $_POST['sure_password']) {
        $errors[] = 'password does not match';

    }
   
    if ($_POST['username'] == '') {
        $errors[] = 'username Can NOT be empty';
       
    }
    if($_POST['image'] !=null){
        $errors[] = 'image Can NOT be empty';}
    
    else {
        $ext =  pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $img_name = date('Y-m-dH-i-s') . md5($_FILES['image']['name']) .'.' . $ext;
    }
    if(count($errors) == 0){
        if(!move_uploaded_file($_FILES['image']['tmp_name'], getcwd() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $img_name)){
            $errors[] = 'image Can NOT be empty';
        }
        

    }



// $pass=md5($password)
    if(count($errors) > 0) {
        echo "<ul class='text-danger'>";
        foreach($errors as $error){
            echo "<li>" . $error . "</li>";
        }
        echo '</ul>';
    }
    else{
            
        try {
        $stmt = $conn->prepare("INSERT INTO profile (username, Email, Password,admin,Image)
        VALUES (?, ?, ?, ?,'$img_name' )");
        $stmt->bind_param("ssii", $username,$email, $pass,$admin);
       
        $stmt->execute();
        $stmt->close();
        $conn->close();
        
    } catch(Exception $e) {
        // header('Location: signup.php');

        echo "<script>alert('error');</script>";
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
    <title>sign up</title>
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
                <label for="username"> username</label>
                <input type="text" id="username" name="username" placeholder="enter username" minlength="8">
            </div>
            <div class="inp">
                <label for="Email"> email</label>
                <input type="email" id="Email" name="email" placeholder="enter email">
            </div>

            <div class="inp">
                <label for="password"> password</label>
                <input type="password" id="password"  name="password" placeholder="enter password" minlength="8">
            </div>
            <div class="inp">
                <label for="surepassword"> password</label>
                <input type="password" id="surepassword"  name="sure_password" placeholder="sure password" minlength="8">
            </div>
            <div >
                <label for="formFileDisabled"  class="inp">Image</label>
                <input name="image"  class="form-control" require type="file" id="formFileDisabled">
            </div>
            <div class="but">
                <button name="send" type="submit">sign up</button>
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