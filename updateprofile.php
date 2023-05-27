<?php 
session_start();
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'web4';

$conn = mysqli_connect($host, $user, $password, $dbname);// or (die('Failed'));
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM profile WHERE id = $id";
    $result = mysqli_query($conn, $query);
    

$errors = [];

if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // $id = $row['id'];
        $username = $row['username'];
        $email = $row['Email'];
        $admin = $row['admin'];
        
    } else {
        $error = "Invalid username or password";
    }
    }
if (isset($_POST['send'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $admin = $_POST['admin'];
    
    
    
    if ($_POST['username'] == '') {
        $errors[] = 'username Can NOT be empty';
        // echo '<script >';
        // echo 'alert('cf')';
        // echo '</script>';
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
            
        // $sql = "UPDATE profile SET username = '$username', Email = '$email', admin = '$admin' WHERE id = $id";
        $sql = "UPDATE profile SET username = '$username', Email = '$email', admin = '$admin' WHERE id = $id";
                if ($conn->query($sql) === TRUE) {
                    echo "تم تحديث البيانات بنجاح";
                    header('Location: prog.php');

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
                <input type="text" id="username" name="username" value="<?php $username ?>" placeholder="enter username" >
            </div>
            <div class="inp">
                <label for="Email"> email</label>
                <input type="email" id="Email" name="email" value="<?php $email ?>" placeholder="enter email">
            </div>
            <?php 

           if($admin==1){?>
            <div class="inp">
                <label for="admin"> admin</label>
                <select class="form-select" id="admin" name="admin"value="<?php $admin ?>" aria-label="Default select example">
                <option value="0">user</option>
                <option value="1">admin</option>
                </select>
            </div>
            <?php echo 'k'; };?>
            <!-- <div class="inp">
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
            </div> -->
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