<?php 
session_start();
$nonavbar='';
$pageTitle="Login"; 
if (isset($_SESSION['admin'])) {
    header('Location: dashboard.php');
}
 include "init.php";

//Check if user coming from HTTP post request
if ($_SERVER['REQUEST_METHOD']== 'POST') {
    $username=$_POST['username'];
    $password=$_POST['password'];
    $hashedpass=sha1($password);

    //Chek if user exist in databse
    
    $stmt=$con->prepare("SELECT id , username , password FROM users WHERE username =? AND password =? AND type_user = 1 LIMIT 1 "); //? : gha t3awad fach dir execute
    $stmt->execute(array($username,$password));
    $row= $stmt->fetch();
    $count=$stmt->rowCount();
    if ($count > 0) {
        $_SESSION['admin'] = $username;
        $_SESSION['ID'] =$row['id'];  //Stock Id inn Session Var
     //   print_r($row);
     header('Location: dashboard.php');
       exit();
    }else{
            bad("The username or the passowrd no Valide ! ");
    }
}
?>


<form class="login" action=<?php echo $_SERVER['PHP_SELF']; ?> method="POST">
    <h3 class="text-center">Admin Login</h3><br>
    <input class="form-control" type="text" name="username" placeholder="Username" autocomplete="off" />
    <input class="form-control" type="password" name="password" placeholder="Password" autocomplete="off" />
    <input class="btn btn-primary btn-block" type="submit" name="submit" value="Login" />
</form>
<?php
include $tpl.'footer.php'; 

?>