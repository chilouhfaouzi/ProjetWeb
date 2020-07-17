<?php
session_start();
$nonavbar = '';
$pageTitle = "Log";
include "admin/init.php";
if (isset($_SESSION['username'])) {
    header('Location: index.php');
}

?>
<section class="log inscription">
    <div class="container text-center">

        <?php
        //Check if user coming from HTTP post request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['login'])) {
                $username_email = $_POST['username_email'];
                /* if (filter_var ($username_email , FILTER_VALIDATE_EMAIL ) ) {  // Cette methode fonction bien c'est le but pour authentification de user ,(verify est-ce il s'agit de email ou de username)
                $col="email";

            }
            else{
                $col="username";
            }  */
                $password = $_POST['password'];

                //Chek if user exist in databse

                $stmt = $con->prepare("SELECT * FROM users WHERE (username =? OR email=? ) AND password =? LIMIT 1 "); //? 
                $stmt->execute(array($username_email, $username_email, $password));
                $row = $stmt->fetch();
                $count = $stmt->rowCount();
                //if $count > 0  that's mean user exist in db 
                if ($count > 0) {
                    if ($row['suspended'] == 1) {
                        redirectfaild('You Account has been Suspended !', 'logout', '6');
                    } else {
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['type_user'] = $row['type_user'];
                        if ($_SESSION['type_user'] == 1) //Admin
                        {
                            $_SESSION['admin'] = $row['username']; //can access to Admin
                        }
                        $_SESSION['ID'] = $row['id'];  //Stock Id inn Session Var
                        $_SESSION['firstname'] = strchr($row['fullname'], " ", true);
                        header('Location: index.php');
                        exit();
                    }
                }
            } else { //inscription
                try {
                    $fullname = $_POST['firstname'] . " " . $_POST['lastname'];
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $tel = $_POST['tel'];
                    $adress = $_POST['adress'];
                    $country = $_POST['country'];

                    $stmt = $con->prepare('INSERT INTO users (username,fullname,email,tel,password,adresse,country) VALUES  (:username,:fullname,:email,:tel,:password,:adresse,:country)');
                    $stmt->execute(array(
                        'username'    => $username,
                        'fullname'    => $fullname,
                        'email'       => $email,
                        'tel'         => $tel,
                        'password'    => $password,
                        'adresse'     => $adress,
                        'country'     => $country
                    ));
                    $count = $stmt->rowCount();
                    if ($count > 0) {  //C.a.d que il ya au moins un utulisateurs ajouteé 
                        good("Successfully registred " . $username . " Please Log in <a href='login.php'>Now</a> ");
                    }
                } catch (PDOException $e) {
                    echo "The are a error !" . $e->getMessage();
                }
            }
        }
        ?>

        <h3 class="logo logo-login"><a href="index.php"><span class="b">B</span><span class="o">o</span><span class="u">u</span><span class="k">k</span><span class="i">i</span></a></h3>
        <h2 class="text-center h-log"><span class="selected" data-class="login">Login</span> | <span data-class="sign">Sign Up</span></h2>
        <form class="login" action=<?php echo $_SERVER['PHP_SELF']; ?> method="POST">
            <div class="frm">
                <input class="form-control" type="text" name="username_email" placeholder="Username or Email" autocomplete="off" required="required" />
            </div>
            <div class="frm">

                <input class="form-control" type="password" name="password" placeholder="Password" autocomplete="off" />
            </div>

            <input class="btn btn-primary btn-block" type="submit" name="login" value="Login" />
        </form>
        <form class="sign" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-inscr">
                <div class="frm">
                    <input type="text" class="form-control" name="firstname" placeholder="First name" required="required"></div>
                <div class="frm">
                    <input type="text" class="form-control" name="lastname" placeholder="Last name" required="required">
                </div>
                <div class="frm">
                    <input type="email" class="form-control" name="email" id="Email" placeholder="name@example.com" required="required"></div>
                <div class="frm">
                    <input type="text" class="form-control" name="username" placeholder="Username" required="required">
                </div>
                <div class="frm">
                    <input type="text" class="form-control" name="tel" placeholder="Phone"></div>
                <div class="frm">
                    <input type="text" class="form-control" name="adress" placeholder="Adresse"></div>
                <div class="frm">
                    <input type="text" class="form-control" name="country" placeholder="Country"></div>
                <div class="frm">
                    <input type="password" class="form-control" name="password" id="Password" placeholder="Password" required="required"></div>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="Check" required="required">
                <label class="form-check-label" for="Check">Je ne suis pas un robot</label>
            </div>

            <button type="submit" name="sign" class="btn btn-primary">Submit</button>

        </form>

    </div>
    <!--End container -->
</section>

<?php include $tpl . 'footer.php';   ?>