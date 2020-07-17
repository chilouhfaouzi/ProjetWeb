<?php
 /*
 =================================
 ==Manage Members Page
 ==You can Add | Edit | Delete Members From Page
 ================================  */
 ob_start(); //Pour resoudre problem de  headers already sent .

 $pageTitle="Members"; 
 session_start();
 if(isset($_SESSION['admin'])){
        include "init.php";
        ?>
<section class="manage_items text-center">
    <div class="container">
        <?php

if (isset($_GET['do'])){
  $change=$_GET['do'];
  if($change === 'Edit'){
  //The user id must be numeric and then get it 
  $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0 ;
  //Select all row depend of this id 
  $stmt=$con->prepare("SELECT * FROM users WHERE id =?  LIMIT 1 "); //? : gha t3awad fach dir execute
  $stmt->execute(array($userid));
  $row= $stmt->fetch();   //FEcth data 
  $count=$stmt->rowCount();   //Check if the are a user with this id
  if ($count > 0) {
      ?>

        <h1 class="text-center">Edit Profile</h1>
        <div class="container">
            <form method="Post" action="?do=update&userid=<?php echo $_SESSION['ID']; ?>">
                <input type="hidden" name="userid" value="<?php echo $userid;?>">
                <!--Hidden input to stock id for submit -->
                <!--Start usernam Field -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label-lg" for="username">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-lg" name="username" id="username"
                            value="<?php echo $row['username']; ?>" required="required">
                    </div>
                </div>
                <!--End usernam Field -->
                <!--Start Email Field -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label-lg" for="email">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control form-control-lg" name="email" id="email"
                            value="<?php echo $row['email']; ?>" required="required">
                    </div>
                </div>
                <!--End Email Field -->
                <!--Start Email Field -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label-lg" for="newpassword">Password</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="oldpassword" value="<?php echo $row['password']; ?>">
                        <input type="password" class="form-control form-control-lg" name="newpassword" id="newpassword"
                            autocomplete="new-password" placeholder="Leave Blank if you don't Change">
                    </div>
                </div>
                <!--End Email Field -->
                <!--Start FullName Field -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label-lg" for="fullname">FullName</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-lg" name="fullname" id="fullname"
                            value="<?php echo $row['fullname']; ?>" required="required">
                    </div>
                </div>
                <!--End FullName Field -->
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
 
elseif ($change=='update'){
  ?>
        <div class="container">
            <?php
   echo ' <h1 class="text-center">Update Member</h1> ';
   if($_SERVER['REQUEST_METHOD']=='POST'){
           //Verification de back end pour plus de securite
          //password trick
          $password = empty($_POST['newpassword'] )  ? $_POST['oldpassword'] : $_POST['newpassword'];  //old passord deja rah hashed
          //Validate the Form
          $formError=array();    //' <div class="alert">OOPS!</div>';
          if(empty($_POST['username'] ) ) {
            $formError[]='<div class="alert alert-danger"> Username Cant be less than 6 caracters ! </div> ' ;
          } 
          if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {
            $formError[]='<div class="alert alert-danger">Email Not Valide ! </div> ' ;
          } 
          if(empty($_POST['fullname'] )){
            $formError[]='<div class="alert alert-danger"> FullName Cant be Empty ! </div>' ;
          } 

          if(!empty($formError)){
              foreach($formError as $error){
              echo $error;
              }
            
          }
          
          else {
              // Prepare statement
              $stmt = $con->prepare("UPDATE users SET username=? , email =? , password=? , fullname =?  WHERE id=?");
              // execute the query
              $stmt->execute([$_POST['username'],$_POST['email'],$password,$_POST['fullname'],$_POST['userid']]);
              $sucssmsg= $stmt->rowCount() .' Record Updated ';
                redirectsuccess($sucssmsg ,'members');
                
           }

          }
        }
      } //If do isset
else{

  if(isset($_GET['suspens_id'])){
    if(isset($_GET['sus'])){
      if($_GET['sus'] =='y'){
        echo $_SESSION['suspended'];
        if($_SESSION['suspended'] == 1) {
          $one_zero=0;
          echo $one_zero;
        } else{
          $one_zero=1;
          echo $one_zero;
        }
        
        $stmt = $con->prepare("UPDATE users SET suspended=?  WHERE id=?");
        $stmt->execute(array( $one_zero,$_GET['suspens_id']));

        header('Location: members.php');


      }else{
        header('Location: members.php');
      }
    }
    else{
    if($_SESSION['suspended']==1){
      $do_remove='remove';
      $will='will';
    } else{
      $do_remove='do';
      $will='will not';
    }
    
    ?>
            <div style="margin: 25px 0;">
                <alert class="alert alert-danger">If you <?php echo $do_remove;?> suspension for this clients ,He
                    <?php echo $will;?> be able to buy ! Are you sure you want to suspend this client? </alert>
            </div>
            <div><a class="btn btn-danger" href="members.php?suspens_id=<?php echo $_GET['suspens_id']; ?>&sus=y">Yes
                    Sure </a>
                <a class="btn btn-primary" href="members.php?suspens_id=<?php echo $_GET['suspens_id']; ?>&sus=n">No
                </a></div>

            <?php
    }
  }else{
      $stmt=$con->prepare("SELECT * FROM users WHERE type_user = 0 "); //? : gha t3awad fach dir execute
      $stmt->execute(array());
      $count=$stmt->rowCount();   //Check if the are a user with this id
      $members = $stmt->fetchAll();
      if ($count > 0) {
        $counter = 0;
        //fecth  data an copy to an  array
      $dataResults=array();
      foreach($members as $data){
          if($data['suspended'] == 1 ) 
          {
             $_SESSION['suspended'] = 1;
             $suspended='Yes';
             $sus='Remove'; }
           else
           { 
             $_SESSION['suspended'] = 0;
             $suspended='No';
             $sus='Do';
            }
            
            $dataResults[] = array($data['id'],$data['username'],$data['fullname'],$data['email'],$data['tel'],$data['adresse'] .' ' .$data['country'] ,$suspended ,'<a href="members.php?suspens_id='.$data['id'].'" class="btn btn-primary" >'.$sus.' Suspension</a>');
            $counter++;
        }
        
        $tableHeader= ['ID','Username','Fullname','Email','Phone','Adresse','Suspended' , 'Suspention'];
          echo "<h1>Manage Members</h1> </br>";
         echo showTable($tableHeader,  $dataResults, $counter);
         
    }   
  }
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