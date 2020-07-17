<?php 

ob_start(); //Pour resoudre problem de  headers already sent .
session_start();
$pageTitle="Cart"; 
include "admin/init.php";
?>
<section class="cart">
<div class="container text-center">
<h2 class="">Shopping cart <?php if(isset($_SESSION['id_prod']) ){
  echo " (".count($_SESSION['ids'] )." item)"; } ?> </h2><br>
<?php
if(isset($_GET['delete'])) {
 
  unset($_SESSION['id_prod'][$_GET['idprod']]);
    unset($_SESSION['ids'][$_GET['ridprod']]);
    if(empty($_SESSION['ids'])) {
      unset($_SESSION['id_prod']);
    }
    //Dencr carts
    $carts=getStats('numbers_cart');
    $carts--;
    $stmt=$con->prepare('UPDATE stats SET numbers_cart=?');
    $stmt->execute(array( $carts ));
    header('location: cart.php');
  
}

if (isset($_GET['idprod'])) {  
   $id_prod=$_GET['idprod'];
   $_SESSION['id_prod'][$id_prod]= $id_prod;
   $_SESSION['ids'][$id_prod]=$id_prod;
    //Incr carts
    $carts=getStats('numbers_cart');
    $carts++;
    $stmt=$con->prepare('UPDATE stats SET numbers_cart=?');
    $stmt->execute(array( $carts ));
   header('location:cart.php');
    
 }
 else{ 
   if(isset($_SESSION['id_prod'])){
   
      foreach($_SESSION['ids'] as $id) {
          foreach(getItemsById($_SESSION['id_prod'][$id]) as $item){
            ?>
        <div class="box_cart">
          <div class="row">
            <div class="col-sm-4">
            <img class="img_cart" src ="data/uploads/<?php echo $item['image'];?>" alt="" />
            </div>
            <div class="col-sm-4">
              <h5><?php echo $item['titre_prod'] ;?></h5>
              <p  class="lead">New</p>
              <form method="POST" class="buy" action="buy.php?idprod=<?php echo $item['id_prod'];?>" >
            <label for="qntty">Quantity : </label>
            <input type="number" class="" name="qntty" id="qntty" value="1" min="1" max="99" >
            <div class="buy_cart">
                <input  type="submit" class="btn btn-primary" value="Buy Now">
            </div>
         </form>
            </div>
            <div class="col-sm-4">
              <p  class="lead">Price</p>
              <h5 class="price"> $ <?php echo $item['prix'] ;?></h5>
              <p  class="remove_cart"><a class="btn btn-danger" href="cart.php?ridprod=<?php echo $item['id_prod'];?>&delete=yes">Delete</a></p>
            </div>
            </div>
          </div>
          <?php
        }
      }
    } else{
      echo "You don't have any items in your cart.!";
    } 
 }


?>
</div> 
</section>
<?php  include $tpl.'footer.php';
ob_end_flush();

?>