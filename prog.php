<?php
session_start(); 
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'web4';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['id'];
$query = "SELECT * FROM profile WHERE id = $user_id";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $email = $row['Email'];
    $img = $row['Image'];
    $admin = $row['admin'];
    $id = $row['id'];
    $_SESSION['id_d'] = $id;
    $image_binary = base64_decode($img);
    
} else {
    echo "Error";
    exit;
}

//DELETE
if (isset($_POST['send_d'])) {
    
    $id = $_POST['id'];
    $_SESSION['id_up'] = $id;//ssssssssssssssssssssssssssssssssssssssssssssss
    try {
        $stmt = $conn->prepare("DELETE FROM profile WHERE id = '$id'");
        $stmt->execute();
    
        echo '<script>alert("تم حذف الصف بنجاح");</script>';
    } catch(PDOException $e) {
        echo 'فشل في حذف الصف: ' . $e->getMessage();
        echo "<script>alert('$e->getMessage()');</script>";
    }
    
}
//updateprofile
if (isset($_POST['send_u'])) {
    
    $id = $_POST['id'];
    // $_SESSION['id_up'] = $id;
    // $number = 123; // الرقم الذي ترغب في إرساله

    $url = "updateprofile.php?id=" . urlencode($id);
    header("Location: " . $url);
    exit;
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/prog.css">
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/framework.css" />
    <link rel="stylesheet" href="css/master.css" />
    <link rel="icon" href="img/img1.png">
    <title>programmers</title>
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
                <li><a href="" ><?php echo $username; ?></a></li>
            </ul></nav>
        </header>
    <div class="box_p_box">
    <p class="title">programmers</p>
    <div class="mlt_box">
    <?php 

    if($admin==0){?>
        <div class="box_img_p">

        <?php // echo '<img src="data:'.$image_binary.'"/>'; ?>
        <img src="img/m5.jpg" >
            <h3><?php echo $username; ?></h3>
            <p><?php echo $email; ?></p>
            
            <form method="post">
            <?php 
             $query2 = "SELECT * FROM profile  WHERE id = '$id'";
             $result2 = mysqli_query($conn, $query2);
             if (mysqli_num_rows($result2) == 1) {
                 $row = mysqli_fetch_assoc($result2);
                 $id = $row['id'];}
            ?>
                <input type="hidden" name="id" value="<?php echo $id; ?>">

            <button name="send_u" type="submit" class="btn btn-outline-primary">Primary</button>
            </form>
        </div>
        <?php }?>
        <?php 

        if($admin==1){
            $sql2 = "SELECT * FROM profile";
            $result2 = mysqli_query($conn, $sql2);
            $num_rows = mysqli_num_rows($result2);
          
    
            $query = "SELECT id FROM profile ORDER BY id DESC LIMIT 1";
            $result6 = $conn->query($query);

            if ($result6->num_rows > 0) {
            $row = $result6->fetch_assoc();
            $lastId = $row['id'];}
                for ($i = $lastId; $i >0; $i--) {
                    try {
                        $query2 = "SELECT * FROM profile  WHERE id = '$i'";
                        $result2 = mysqli_query($conn, $query2);
                        if (mysqli_num_rows($result2) == 1) {
                            $row = mysqli_fetch_assoc($result2);
                            $email = $row['Email'];
                            $admin = $row['admin'];
                            $created_at = $row['created_at'];
                            $username = $row['username'];
                            $id = $row['id'];
                            $_SESSION['id_d'] = $id;
                            // echo '<div class="box_img_p"><img src="img/m6.jpg" ><h3>'. $username .'</h3><p>'.$email.'</p></div>';
                            echo ' <div class="projects p-20 bg-white rad-10 m-20">
                            <div class="responsive-table">
                              <table class="fs-10 w-full">
                                <thead>
                                  <tr>
                                    <td>Name</td>
                                    <td>email</td>
                                    <td>admin</td>
                                    <td>created_at</td>
                                    <td>Team</td>
                                    <td>Status</td>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>'. $username .'</td>
                                    <td>'.$email.'</td>
                                    <td>'.$admin.'</td>
                                    <td>$'.$created_at.'</td>
                                    <td>
                                    <form method="post">
                                    <input type="hidden" name="id" value="'.$id.'">
                                    <button name="send_d" type="submit" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                  </svg>
                                  </button>
                                    </td>
                                    <td>
                                    <button name="send_u" type="submit" class="btn btn-outline-primary">Primary</button>
                                    </form>
    
                                    </td>
                                  </tr>
                                 
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>';
                            
                        } else {
                            $i--;
                            exit;
                        }
                        
                   
                    } catch (execute $e) {
                        $i--;
                        
                    }
                     } 
                mysqli_close($conn);
            }
            
        
        ?>
    </div>
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
</body>
</html>