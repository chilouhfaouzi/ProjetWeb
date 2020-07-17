<?php 
session_start();
$nonavbar='';
$pageTitle="Login"; 
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
}
 include "admin/init.php";
?>
<section class="inscription"> <!--Start section d'iscription -->
<div class="container text-center">
<?php
if(!empty($_POST)){
 try{
        $fullname=$_POST['firstname']." ".$_POST['lastname'];
        $username=$_POST['username'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $tel=$_POST['tel'];
        $adress=$_POST['adress'];
        $country=$_POST['country'];
        
        $stmt=$con->prepare('INSERT INTO users (username,fullname,email,tel,password,adresse,country) VALUES  (:username,:fullname,:email,:tel,:password,:adresse,:country)' );
        $stmt->execute(array(
          'username'    =>$username,
          'fullname'    => $fullname, 
          'email'       =>$email, 
          'tel'         =>$tel, 
          'password'    =>$password, 
          'adresse'     =>$adress, 
          'country'     =>$country));
        $count=$stmt->rowCount();
        if($count>0){  //C.a.d que il ya au moins un utulisateurs ajouteé 
            good("Successfully registred ".$username." Please Log in <a href='login.php'>Now</a> ");
        }
        
    } catch( PDOException $e ) {
        echo "The are a error !" .$e->getMessage(); }
}
else{ 


?>



    <h3 class="logo"><a href="index.php"><span class="b">B</span><span class="o">o</span><span class="u">u</span><span class="k">k</span><span class="i">i</span></a></h3>
    <h2>Inscription</h2>
<form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
<div class="form-inscr">
        <div class="form-group col-6">
        <input type="text" class="form-control" name="firstname" placeholder="First name" required="required">
        </div>
        <div class="form-group col-6">
        <input type="text" class="form-control" name="lastname" placeholder="Last name" required="required">
        </div>

    <div class="form-group col-6">
        <input type="email" class="form-control" name="email" id="Email" placeholder="name@example.com" required="required" >
    </div>
    <div class="form-group col-6">
      <input type="text" class="form-control" name="username" placeholder="Username" required="required">
    </div>
    <div class="form-group  col-6">
      <input type="text" class="form-control" name="tel" placeholder="Phone">
    </div>
    <div class="form-group col-6">
      <input type="text" class="form-control" name="adress"  placeholder="Adresse">
    </div>
    <div class="form-group col-6">
      <input type="text" class="form-control" name="country" placeholder="Country">
    </div>
    <div class="form-group col-6">
        <input type="password" class="form-control" name="password" id="Password" placeholder="Password" required="required">
    </div>
  </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input"  id="Check" required="required">
        <label class="form-check-label" for="Check">Je ne suis pas un robot</label>
    </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
  
</form>

<p class="lead">You have an account ? <a href="login.php">Log In</a> </p>

</div>
</section> <!--Fin Section d'iscription -->
<?php
} // else : post is empty

 include $tpl.'footer.php'; 
?>