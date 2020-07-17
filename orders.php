<?php 
ob_start(); //Pour resoudre problem de  headers already sent .
session_start();
$pageTitle="Cart"; 
include "admin/init.php";
if (isset($_SESSION['username'])) {
?>
<section class="orders">
    <div class="container ">

        <?php
 $stmt=$con->prepare("SELECT orders.*, items.* FROM orders 
                          INNER JOIN items ON orders.id_prod = items.id_prod
                          WHERE id=? ");
 $stmt->execute(array($_SESSION['ID']));
 $orders= $stmt->fetchAll(); 
 $count = $stmt->rowCount();

?> <h1 class="text-center">My Orders <?php if($count > 0) {?> (<?php  echo $count ; ?> Orders) <?php }?> </h1>
        <?php 
if($count > 0)
{
 foreach ($orders as $order)
 {?>
        <div class="order-box">
            <div class="row">
                <div class="col-md-7">
                    <h5> <?php echo $order['titre_prod'] ;?></h5> <br><br>
                    <a class="btn btn-sm btn-info" href="showproduct.php?idprod=<?php echo $order['id_prod']?>">Show
                    The Item</a>

                </div>
                <div class="col-md-5 ">
                    <p style="font-size: 18px;">Price : </p>
                    <p><strong>$ </strong><?php echo $order['prix'] ;?></p>
                    <p class="lead"><?php echo $order['date']; ?></p>

                </div>

            </div>

        </div>
        <?php 
 }//end foreach 
    }//end if count >0

    else
    {
        echo "<div class='alert alert-info text-center'> You have No order ! </div>";
    }
} 
else{
    redirectfaild('Please Login first !' , 'login');
}
?>
    </div>
</section>
<?php 
 include $tpl.'footer.php';
ob_end_flush();
?>