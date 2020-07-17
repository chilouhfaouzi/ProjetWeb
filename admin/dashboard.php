<?php
ob_start(); //Pour resoudre problem de  headers already sent .
session_start();
$pageTitle="Dashboard"; 
include "init.php";
if(isset($_SESSION['admin'])){
/*Start dashboard Page */

?>
<section class="dashboard text-center">
    <div class="container">
        <h1 class="">Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="stat st-members">
                    Total Members
                    <span> <?php echo countRows('id','users');?></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-items">
                    Numbers Items
                    <span><?php echo countRows('id_prod','items');?></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-sells">
                    Numbers Sells
                    <span><?php echo getStats('numbers_sells');?></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-panier">
                    Cart
                    <span><?php echo getStats('numbers_cart');?></span>
                </div>
            </div>

        </div>
        <div class="latest">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-users"></i> Latest Orders
                        </div>
                        <ul class="list-group list-group-flush members-list">
                            <?php
                            $latestorders=getLatest_orders();
                            foreach($latestorders as $order){
                                echo '<li class="list-group-item"><b>Buyer :</b> '.$order['name'].' | <b>Item :</b> '.$order['title'].'</li>';
                            }
             
                    ?>

                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-tag"></i> Latest Items
                        </div>
                        <ul class="list-group list-group-flush members-list">
                            <?php
                    $latestitems=getLatest('*' , 'items' ,'	id_prod' ,5);
                    foreach($latestitems as $items){
                        echo '<li class="list-group-item"><b>Name:</b> '.$items['titre_prod'].' | <b>Price :</b> '.$items['prix'].'</li>';
                    }
                    ?>

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?php
/*End dashboard Page */
}
else{
    redirectfaild('You dont have permission to see this page !', 'index'  );
}

include $tpl.'footer.php'; 
ob_end_flush();
?>