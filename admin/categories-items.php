<?php
session_start();
$pageTitle="Manage Items"; 
include "init.php";
?>
<section class="manage_items text-center">
    <div class="container">

        <?php
if(isset($_SESSION['admin'])){

$allproducts = array();
                $statement = $con->prepare("SELECT * FROM items WHERE id_cat=?");
                $statement->execute(array($_GET['cate']));
                $counter = 0;
                //fecth  data an copy to an  array
                while ($data = $statement->fetch()) {
                    $allproducts[] = array($data['id_prod'],$data['titre_prod'],$data['Description'],$data['prix'],$data['id_cat'],$data['best_offers'],'<img class="img-fluid" width="500px" height="300px" src="../data/uploads/'.$data['image'].'"/>');
                    $counter++;
                }
                $tableHeader= ['Title','Description','Price','Id_cat','Best offers','Image'];

               echo showproduct($tableHeader,  $allproducts, $counter);



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