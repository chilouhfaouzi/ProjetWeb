<?php
ob_start(); //Pour resoudre problem de  headers already sent .

 $pageTitle="Account"; 
 session_start();
 include "admin/init.php";
 if(isset($_SESSION['username'])){
        
        ?>
<section class="Account text-center">
    <div class="container">
<?php
if(isset($_GET['do'])){
  if ($_GET['do']=='update'){

     echo ' <h1 class="text-center">Update Member</h1> ';
     if($_SERVER['REQUEST_METHOD']=='POST'){
          // Prepare statement
          if(empty($_POST['newpassword'])){
            $password=$_POST['oldpassword'];
          } else{
            $password=$_POST['newpassword'];
          }
          $stmt = $con->prepare("UPDATE users SET username=? , email =? , password=? , fullname =?,tel=? ,adresse=? , country=? WHERE id=?");
          // execute the query
          $stmt->execute([$_POST['username'],$_POST['email'],$password,$_POST['fullname'],$_POST['phone'],$_POST['adress'],$_POST['country'],$_POST['userid']]);
          $sucssmsg= 'Your Information has been successfully updated !';
            redirectsuccess($sucssmsg ,'account');
            
     } 
      
    }
  }//ENd get Is set

 else{
 $user= getElementsByColomn('*', 'users', 'id', $_SESSION['ID']);
 $user= $user[0];

?>

<h1 class="text-center">Edit Account</h1>
<div class="container">
    <form method="Post" action="?do=update&userid=<?php echo $_SESSION['ID']; ?>">
       <input type="hidden" name="userid" value="<?php echo $user['id'];?>" > <!--Hidden input to stock id for submit -->
        <!--Start usernam Field -->
        <div class="form-group row">
          <label class="col-sm-2 col-form-label-lg" for="username">Username</label>
          <div class="col-sm-10">
              <input type="text" class="form-control form-control-lg" name="username" id="username" value="<?php echo $user['username']; ?>" required="required" >
          </div>
        </div>
     <!--End usernam Field -->
        <!--Start Email Field -->
        <div class="form-group row">
          <label class="col-sm-2 col-form-label-lg" for="email">Email</label>
          <div class="col-sm-10">
              <input type="email" class="form-control form-control-lg" name="email" id="email" value="<?php echo $user['email']; ?>" required="required">
          </div>
        </div>
     <!--End Email Field -->
        <!--Start Email Field -->
        <div class="form-group row">
          <label class="col-sm-2 col-form-label-lg" for="newpassword">Password</label>
          <div class="col-sm-10">
              <input type="hidden" name="oldpassword"  value="<?php echo $user['password']; ?>">
              <input type="password" class="form-control form-control-lg" name="newpassword" id="newpassword" autocomplete="new-password" placeholder="Leave Blank if you don't Change">
          </div>
        </div>
     <!--End Email Field -->
        <!--Start FullName Field -->
        <div class="form-group row">
          <label class="col-sm-2 col-form-label-lg" for="fullname">FullName</label>
          <div class="col-sm-10">
              <input type="text" class="form-control form-control-lg" name="fullname" id="fullname" value="<?php echo $user['fullname']; ?>" required="required" >
          </div>
        </div>
     <!--End FullName Field -->
        <!--Start Adress Field -->
        <div class="form-group row">
          <label class="col-sm-2 col-form-label-lg" for="fullname">Adress</label>
          <div class="col-sm-10">
              <input type="text" class="form-control form-control-lg" name="adress" id="adress" value="<?php echo $user['adresse']; ?>" required="required" >
          </div>
        </div>
     <!--End Adress Field -->
        <!--Start counry Field -->
        <div class="form-group row">
          <label class="col-sm-2 col-form-label-lg" for="country">Country</label>
          <div class="col-sm-10">
              <input type="text" class="form-control form-control-lg" name="country" id="country" value="<?php echo $user['country']; ?>" required="required" >
          </div>
        </div>
     <!--End country Field -->
        <!--Start phone Field -->
        <div class="form-group row">
          <label class="col-sm-2 col-form-label-lg" for="phone">Phone</label>
          <div class="col-sm-10">
              <input type="text" class="form-control form-control-lg" name="phone" id="phone" value="<?php echo $user['tel']; ?>" required="required" >
          </div>
        </div>
     <!--End phone Field -->
        <!--Start Submit Field -->
        <div class="form-group row">
          <div class="offset-sm-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Save</button>               
          </div>
        </div>
     <!--End Submit Field -->


    </form>
</div>
<?php
    
 }
}
  else{
      echo "You dont have permission to see this page !";
      header('Location: index.php');
      exit();

  }
 
?>
</div>
</section>
<?php
include $tpl.'footer.php'; 
ob_end_flush();

?>