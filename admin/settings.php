<?php
ob_start(); //Pour resoudre problem de  headers already sent .
session_start();
$pageTitle="Dashboard"; 
include "init.php";
?>
<section class="dashboard text-center">
    <div class="container">
        <h1 class="">Settings</h1>
        <?php
if(isset($_SESSION['admin'])){

    if(isset($_GET['do'])){
        if($_GET['do']=='update'){
            $stmt=$con->prepare("UPDATE settings SET status_site=? , dst_prtn=? , TEL_HELP=? , EMAIL_HELP=? "); //? : gha t3awad fach dir execute
            $stmt->execute(array(
                $_POST['status'],
                $_POST['dstprtn'],
                $_POST['HelpPhone'],
                $_POST['HelpEmail']));
                redirectsuccess('Settings Updated Successfully !','settings');
            
        }
    }
?>
        <?php
$stmt=$con->prepare("SELECT * FROM settings"); //? : gha t3awad fach dir execute
  $stmt->execute();
  $row= $stmt->fetch();   //FEcth data 
  $count=$stmt->rowCount();   //Check if the are a user with this id
  if ($count > 0) {
      ?>
        <form method="Post" action="?do=update">
            <!--Start usernam Field -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label-lg" for="username">Platform Status</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-lg" name="status" id="status"
                        value="<?php echo $row['status_site']; ?>" required="required" placeholder="work/repair">
                </div>
            </div>
            <!--End usernam Field -->
            <!--Start Email Field -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label-lg" for="dstprtn">Distribution Partner</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-lg" name="dstprtn" id="dstprtn"
                        value="<?php echo $row['dst_prtn']; ?>" required="required">
                </div>
            </div>
            <!--End Email Field -->
            <!--Start Email Field -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label-lg" for="HelpPhone">Help Phone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-lg" name="HelpPhone" id="HelpPhone"
                        value="<?php echo $row['TEL_HELP']; ?>">
                </div>
            </div>
            <!--End Email Field -->
            <!--Start FullName Field -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label-lg" for="HelpEmail">Help Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-lg" name="HelpEmail" id="HelpEmail"
                        value="<?php echo $row['EMAIL_HELP']; ?>" required="required">
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
        <?php 
  }
  
?>


    </div>
</section>
<?php
}
else{
    redirectfaild('You dont have permission to see this page !', 'index'  );
}

include $tpl.'footer.php'; 
ob_end_flush();
?>