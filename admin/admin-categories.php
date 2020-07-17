<?php
session_start();
$pageTitle="Admin Categories"; 
include "init.php";
?>
<section class="admin_categories text-center">
    <div class="container">



        <?php
if(isset($_SESSION['admin'])){
if(isset($_POST['rename'])){
   // Prepare statement
   $stmt = $con->prepare("UPDATE categories SET titre_cat=?  WHERE titre_cat=?");
   $stmt->execute(array($_POST['rename'],$_SESSION['last-name']));
    header('Location: admin-categories.php');

}

if(isset($_POST['add'])){
    $stmt = $con->prepare("INSERT INTO categories (id_cat,titre_cat) VALUES (:id_cat , :titre_cat) ");
    $stmt->execute(array(
        'id_cat'=>$_POST['id_cate'],
        'titre_cat'=>$_POST['add']));
    header('Location: admin-categories.php');
}

if (isset($_GET['change'])){
$change=$_GET['change'];
if($change === 'add'){
    
    ?>
        <h2>Add Categorie</h2><br>
        <form class="row f-rename" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <input class="form-control" type="text" name="id_cate" placeholder="Id of category" required="required" />
            <input class="form-control" type="text" name="add" placeholder="Name of category" required="required" />
            <input class="btn btn-primary btn-block" type="submit" name="submit" value="Add" />
        </form>
        <?php
} 
if($change === 'rename'){
    $_SESSION['last-name']=$_GET['cate'];
    ?>
        <h2>Rename Categorie</h2>
        <form class="row f-rename" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <input class="form-control" type="text" name="rename" value="<?php echo $_GET['cate'] ;?>" />
            <input class="btn btn-primary btn-block" type="submit" name="submit" value="rename" />
        </form>
        <?php
} 
elseif($change=='remove'){
    if(isset($_GET['remove'])){
        if($_GET['remove']=='ok'){
            // Prepare statement
        $stmt = $con->prepare("DELETE FROM categories WHERE titre_cat=?");
        $stmt->execute(array($_SESSION['name']));
        header('Location: admin-categories.php');
      }else {
        header('Location: admin-categories.php');
      }
    }
    $_SESSION['name']=$_GET['cate'];
    ?>
        <div style="margin: 25px 0;">
            <alert class="alert alert-danger">If you delete the category any product belongs to ,it will be without
                category ! Are you sure you want to delete the type? </alert>
        </div>
        <div><a class="btn btn-danger"
                href="admin-categories.php?change=remove&cate=<?php echo $_SESSION['name']; ?>&remove=ok">Yes Sure </a>
            <a class="btn btn-primary"
                href="admin-categories.php?change=remove&cate=<?php echo $_SESSION['name']; ?>&remove=no">No </a></div>
        <?php

}


}
else{

    $stmt=$con->prepare("SELECT * FROM categories "); //? 
    $stmt->execute(array());
    $count=$stmt->rowCount();
?>
        <h2>Manage Categories </h2><br>
        <ul class="list-cate list-unstyled">
            <?php 
while ($row = $stmt->fetch()) {
    echo '
            <li>
            <ul class="cate list-unstyled float-left">
            <li >'. $row["titre_cat"] .'</li>
            </ul> 
            <ul class="cate_mod list-unstyled float-right">
                <li><a style="color:black;" href="admin-categories.php?change=rename&cate='.$row["titre_cat"].'"><i class="fas fa-pen"></i> Rename</a></li>
                <li><a href="categories-items?cate='.$row['id_cat'].'"><i class="fas fa-eye"></i> Show products</a></li>
                <li ><a style="color:red;" href="admin-categories.php?change=remove&cate='.$row["titre_cat"].'"><i class="fas fa-eye"></i> Remove</a></li>
            </ul>
            </li>
     ';
}
   
  ?>
        </ul>
        <h4><a style="color: #fff;" class="btn btn-primary" href="admin-categories.php?change=add">Add Category</a></h4>

        <?php


} //end else change
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