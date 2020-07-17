<?php 
ob_start(); //Pour resoudre problem de  headers already sent .
session_start();
$pageTitle="Best Offers"; 
include "admin/init.php";
?>
<section class="best_offers">
<div class="container text-center">
<?php
   $stmt=$con->prepare("SELECT * FROM items WHERE best_offers=1");
   $stmt->execute();
   $best= $stmt->fetchall();
   ?>
   <h1>Best Offers</h1>
   <div class="row">
   <?php    
 foreach($best as $items){
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
    </div> <!--end row -->
 <?php

?>
</div> 
</section>
<?php  include $tpl.'footer.php';
ob_end_flush();

?>