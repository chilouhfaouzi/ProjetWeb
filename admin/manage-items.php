<?php
session_start();
$pageTitle="Manage Items"; 
include "init.php";
?>
<section class="manage_items text-center">
    <div class="container">

        <?php
if(isset($_SESSION['admin'])){

  if(isset($_POST['update'])){
    $uploadOk = False;
    //upload the image
    $fichier = $_POST['old-img-itm'];
    if (isset($_FILES ['img-itm'] ['tmp_name']) && !empty($_FILES ['img-itm'] ['tmp_name'])) {
        $uploadOk = False;
        $fichier = basename($_FILES ['img-itm'] ['name']);
        $path_parts = pathinfo($fichier);
        $uploadOk= move_uploaded_file($_FILES ['img-itm'] ['tmp_name'], 'C:/wamp64/www/Projet_tp4/data/uploads/'. $fichier);
    }
    // Prepare statement
    $stmt = $con->prepare("UPDATE items SET titre_prod=? , Description=? , image=? , prix=? , id_cat=? ,best_offers=?  WHERE id_prod=?");
    $stmt->execute(array(
            $_POST['titre'],
            $_POST['Description'],
            $fichier,
            $_POST['price'],
            $_POST['id_cat'],
            $_POST['best_offers'],
            $_POST['id_prod']
          ));

    header('Location: manage-items.php');
       
      } 
 
 

  if(isset($_GET['change'])){
      if($_GET['change']=='remove'){
          if(isset($_GET['remove'])){
          if($_GET['remove']=='ok'){

               // Prepare statement
        $stmt = $con->prepare("DELETE FROM items WHERE id_prod=?");
        $stmt->execute(array($_SESSION['id_prod']));
            header('Location: manage-items.php');
          } else {
            header('Location: manage-items.php');

          } }
        $_SESSION['id_prod']=$_GET['item'];
    ?>
        <div style="margin: 25px 0;">
            <alert class="alert alert-danger"> Are you sure you want to delete the Item? </alert>
        </div>
        <div><a class="btn btn-danger"
                href="manage-items.php?change=remove&item=<?php echo $_SESSION['id_prod']; ?>&remove=ok">Yes Sure </a>
            <a class="btn btn-primary"
                href="manage-items.php?change=remove&item=<?php echo $_SESSION['id_prod']; ?>&remove=no">No </a></div>


        <?php

      } if($_GET['change'] == 'edit' ){
            //The item id must be numeric and then get it 
        $itemid = isset($_GET['item']) && is_numeric($_GET['item']) ? intval($_GET['item']) : 0 ;
        $stmt=$con->prepare("SELECT * FROM items WHERE id_prod =?  LIMIT 1 "); //? : gha t3awad fach dir execute
        $stmt->execute(array($itemid));
        $row= $stmt->fetch();   //FEcth data 
        $count=$stmt->rowCount();   //Check if the are a user with this id
        if ($count > 0) {
            ?>


        <h1 class="text-center">Edit Items</h1>
        <div class="container">
            <form method="Post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <input type="hidden" name="id_prod" value="<?php echo $itemid;?>">
                <!--Hidden input to stock id for submit -->
                <!--Start usernam Field -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label-lg" for="titre">Titre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-lg" name="titre" id="titre"
                            value="<?php echo $row['titre_prod']; ?>" required="required">
                    </div>
                </div>
                <!--End usernam Field -->
                <!--Start Email Field -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label-lg" for="Description">Description</label>
                    <div class="col-sm-10">
                        <textarea type="email" class="form-control form-control-lg" name="Description" id="Description"
                            required="required"><?php echo $row['Description']; ?></textarea>
                    </div>
                </div>
                <!--End Email Field -->
                <!--Start Email Field -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label-lg" for="price">price</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-lg" name="price"
                            value="<?php echo $row['prix']; ?>">
                    </div>
                </div>
                <!--End Email Field -->
                <!--Start FullName Field -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label-lg" for="id_cat">Category</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-lg" name="id_cat" id="id_cat"
                            value="<?php echo $row['id_cat']; ?>" required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label-lg" for="best_offers">Best_offer</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-lg" name="best_offers" id="best_offers"
                            value="<?php echo $row['best_offers']; ?>" required="required">
                    </div>
                </div>
                <!--End FullName Field -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label-lg">Update Image : </label>
                    <div class="col-sm-10">
                        <input type="hidden" value="<?php echo $row['image']; ?>" name="old-img-itm">
                        <input type="file" class="form-control-file" name="img-itm">
                    </div>
                </div>
                <!--Start Submit Field -->
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" name="update" class="btn btn-primary">Save</button>
                    </div>
                </div>
                <!--End Submit Field -->


            </form>
        </div>

        <?php  } else {
              echo "No User With thid Id ";
            }
      }
      
  }
else{

    echo "<h3><a href='add-items.php'>Add items</a></h3>";

 $allproducts = array();
                $statement = $con->prepare("SELECT items.* ,categories.titre_cat AS titre_cat FROM `items` 
                INNER JOIN categories ON categories.id_cat = items.id_cat");
                $statement->execute();
                $counter = 0;
                //fecth  data an copy to an  array
                while ($data = $statement->fetch()) {
                    $allproducts[] = array($data['id_prod'],$data['titre_prod'],$data['Description'],$data['prix'],$data['titre_cat'],$data['best_offers'],'<img class="img-fluid" width="500px" height="300px" src="../data/uploads/'.$data['image'].'"/>');
                    $counter++;
                }
                $tableHeader= ['Title','Description','Price','Cate','Best offers','Image'];

               echo showproduct($tableHeader,  $allproducts, $counter);



    } 
}
    else{
        echo "You do not have permission to view this page !";
        header('Location: index.php');
        exit();

    }
    ?>
    </div>
</section>
<?php
    include $tpl.'footer.php';   
    ?>