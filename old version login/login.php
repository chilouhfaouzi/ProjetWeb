<?php 
session_start();
$nonavbar='';
$pageTitle="Login"; 
include "admin/init.php";
if (isset($_SESSION['username'])) {
    header('Location: index.php');
}

?>
<section class="login">
    <div class="container text-center">

        <?php 
//Check if user coming from HTTP post request
if ($_SERVER['REQUEST_METHOD']== 'POST') {
    $username_email=$_POST['username_email'];
            /* if (filter_var ($username_email , FILTER_VALIDATE_EMAIL ) ) {  // Cette methode fonction bien c'est le but pour authentification de user ,(verify est-ce il s'agit de email ou de username)
                $col="email";

            }
            else{
                $col="username";
            }  */
    $password=$_POST['password'];

    //Chek if user exist in databse
    
    $stmt=$con->prepare("SELECT * FROM users WHERE (username =? OR email=? ) AND password =? LIMIT 1 "); //? 
    $stmt->execute(array($username_email,$username_email,$password));
    $row= $stmt->fetch();
    $count=$stmt->rowCount();
    //if $count > 0  that's mean user exist in db 
    if ($count > 0) {
        if($row['suspended']==1){
            redirectfaild('You Account has been Suspended !','logout','6');
        }
        else{
        $_SESSION['username'] =$row['username'] ;
        $_SESSION['type_user']=$row['type_user'];
        if($_SESSION['type_user']==1)//ADmin
        {
          $_SESSION['admin']=$row['username'] ;//can access to Admin
        }
        $_SESSION['ID'] =$row['id'];  //Stock Id inn Session Var
        $_SESSION['firstname']=strchr($row['fullname']," ",true);
        header('Location: index.php');
       exit();
      }
    }
}
?>

        <h3 class="logo"><a href="index.php"><span class="b">B</span><span class="o">o</span><span
                    class="u">u</span><span class="k">k</span><span class="i">i</span></a></h3>

        <form class="login" action=<?php echo $_SERVER['PHP_SELF']; ?> method="POST">
            <h4 class="text-center">Login</h4>
            <input class="form-control" type="text" name="username_email" placeholder="Username or Email"
                autocomplete="off" />
            <input class="form-control" type="password" name="password" placeholder="Password" autocomplete="off" />
            <input class="btn btn-primary btn-block" type="submit" name="submit" value="Login" />
        </form>

        <p class="lead">Register<a href="inscription.php"> Now</a></p>

    </div>
    <!--End container -->
</section>

<?php include $tpl.'footer.php';   ?>