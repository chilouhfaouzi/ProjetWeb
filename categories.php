<?php
session_start();
$pageTitle="Items By Categories"; 
include "admin/init.php";
?>
<section class="categories text-center">
    <div class="container">


        <?php
if(isset($_GET['idcat'])){
    $idcat= $_GET['idcat'] ;
    $stmt=$con->prepare("SELECT titre_cat FROM categories WHERE id_cat=?");
    $stmt->execute(array($idcat));
    $cat= $stmt->fetchColumn(); 
    //echo " <p>Nombre cate viseted :  ". count($_COOKIE['categories'],COUNT_RECURSIVE) ." </p>";
    
    if(!isset($_COOKIE['categories'])){

        setcookie("categories[$idcat]",$idcat,time()+(3600 * 24 * 30));// Valable 1 month
    }else{
        $check = in_array($idcat,$_COOKIE['categories']);
        if(!$check)
        {
            setcookie("categories[$idcat]",$idcat,time()+(3600 * 24 * 30));// Valable 1 month
        }
     }
    
    ?>
        <h1><?php echo $cat; ?></h1>
        <div class="row">
            <?php    
            $catsItems=getForAll('*','items',"id_cat={$idcat} ORDER BY solds DESC ");
  foreach($catsItems as $items){
      echo "<div class='col-sm-6 col-md-4'>";
      echo'
         <div class="card item-box">
         <img src="data/uploads/'.$items['image'].'" class="card-img-top" alt="">
          <div class="card-body">
          <h5 class="card-title"><a href="showproduct.php?idprod='.$items['id_prod'].'">'.$items['titre_prod'].'</a></h5>
          <span class="price"> $'.$items['prix'].'</span>
          <span class="card-text sold">'.$items['solds'].' sold</span>
          <span class="card-text add_cart"><a class="btn btn-info hvr-grow" href="cart.php?idprod='.$items['id_prod'].'">Add to cart <i class="fas fa-shopping-cart fa-lg"></i></a></span>
          <a href="showproduct.php?idprod='.$items['id_prod'].'" class="btn btn-primary hvr-grow">Show More</a>
          </div>
         </div>';
     echo "</div>";
  }
  ?>
        </div>
        <!--end row -->
        <?php


} else{
    redirectfaild('You dont have permission to see this page ','index');
}
?>

    </div>
</section>
<?php
include $tpl.'footer.php';   
?>