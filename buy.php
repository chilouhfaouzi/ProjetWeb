<?php
session_start();
$nonavbar='';
$nofooter='';//Pour que le navbar n'apparaitre pas
$pageTitle="Buy Now"; 
include "admin/init.php";
?>
<section class="buy">
    <div class="container">
        <?php
if (isset($_SESSION['username'])) {

    if(isset($_GET['buy'])){

//============================================================+
ob_start(); //Pour resoudre problem de  headers already sent .

require_once('tcpdf/tcpdf.php');
// create new PDF document

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Buy');
// set default header data
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetFont('times', '', 12); 
$pdf->AddPage();
$pdf->writeHTML($_SESSION['order']);
$pdf->Output('buy.php','I');
ob_end_flush();
    
//============================================================+

    } else{
    $client= getElementsByColomn('*', 'users', 'id', $_SESSION['ID']);
    $client=$client[0];
    $item=getElementsByColomn('*', 'items', 'id_prod', $_GET['idprod']);
    $item=$item[0];
    $item['solds']=$item['solds']+1;
    $stmt=$con->prepare('UPDATE items SET solds=? WHERE id_prod=?');
    $stmt->execute(array 
                    ( $item['solds'],$item['id_prod']
                    )
    );
    //Incr Sells
    $sells=getStats('numbers_sells');
    $sells++;
    $stmt=$con->prepare('UPDATE stats SET numbers_sells=?');
    $stmt->execute(array( $sells ));
    // echo  $client[0]['id'];  //First Elements in the table is The clients (The others (index) is empty)
    /*Add orders to data base */
    $stmt=$con->prepare('INSERT INTO orders(id , id_prod, date)  VALUES  (:id,:id_prod,now() )');
    $stmt->execute(
        array(
      'id'        =>$client['id'],
      'id_prod'   =>$_GET['idprod'],
         )
        );
        $stmt1=$con->prepare('SELECT id_order FROM orders WHERE  id=? AND id_prod=? ORDER BY id_order DESC LIMIT 1'); 
        $stmt1->execute(
            array(
                $client['id'],
                $_GET['idprod']
             //   date('Y-m-d',time()) 
                   )
              );
              $id_order = $stmt1->fetchColumn();
        
              
      /*ENd Add orders */  
      echo "<h3 class='text-center'> Your Order </h3><br>";
      /*this Seesion for sotock information for print*/
     $_SESSION['order']='
     <style>
      .order{
        border: 2px solid #088;
        padding: 20px 10px;
        font-size: 20px;
      }
      .order p strong{
        color: crimson;
      }
      .order .Sum{
        margin-top: 20px;
      }
      .price p{
        font-size: 22px;
        font-weight: 600;
        letter-spacing: 1.5px;
      }
      .order .Sum hr
      {
        
        width: 35%;
        border-top: 2px solid black;
      }
      .row
      {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
       
      }
      .col-6
      {
        flex: 0 0 50%;
        max-width: 50%;
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
     }
      
      </style>';
      $_SESSION['order'].='
      <div class="order">
              <p>N ° :  '. $id_order .'</p>
              <p> '.$client["adresse"] . ', '.$client["country"] .'</p>
         
              <p>'.$client["fullname"].'</p>
              <p> '.$client["tel"].'</p>
              <p> '.$client["email"].'</p>
         
      
   
               <h4> '.$item["titre_prod"].'</h4>
           
               <p>Price : <strong>$ '.$item["prix"].'</strong></p>
               <p>Quantity :  <strong> '.$_POST["qntty"].'</strong></p>
               <p>Shipping :  <strong>$2.99</strong></p>
               <hr>
               <p>Total : <strong>$ ' .$item["prix"] * $_POST["qntty"].'</strong></p>          
       </div>';?>

        <div class='mr-auto ml-auto' style="width: 70%;">
            <div class="order">
                <div class="row">
                    <div class="col-6">
                        <p>N ° : <?php echo $id_order ?></p>
                        <p> <?php echo $client["adresse"] ?> , <?php echo $client["country"] ?></p>
                    </div>
                    <div class="col-6">
                        <p><?php echo $client["fullname"]?></p>
                        <p> <?php echo $client["tel"] ?></p>
                        <p> <?php echo $client["email"]?></p>
                    </div>
                </div>
                <div class="row Sum">
                    <div class="col-6">
                        <h4> <?php echo $item["titre_prod"]?></h4>
                    </div>
                    <div class="col-6 price">
                        <p>Price : <strong>$ <?php echo $item["prix"]?></strong></p>
                        <p>Quantity : <strong> <?php echo $_POST["qntty"] ?></strong></p>
                        <p>Shipping : <strong>$2.99</strong></p>
                        <hr>
                        <div class="clearfix"></div>
                        <p>Total : <strong>$ <?php echo $item["prix"] * $_POST["qntty"] ?></strong></p>
                    </div>
                </div>
            </div>
            <br><a class="btn btn-primary" name="" href="buy.php?buy=yes">Buy Now</a>
        </div>
        <?php
    }

}
else{
    redirectfaild('Please Login first !' , 'login');
}
?>
    </div>
    <!--End container -->
</section>

<?php include $tpl.'footer.php';  


?>