<?php
session_start();
$pageTitle = "Product";
include "admin/init.php";
?>
<section class="item text-center">
    <div class="container">

        <?php
        if (isset($_GET['idprod'])) {
            $iditem = $_GET['idprod'];
            // Verifier que id passé dans get est deja dans la base de donner
            $stmt = $con->prepare("SELECT * FROM items WHERE id_prod=$iditem");
            $stmt->execute();
            $count = $stmt->rowCount();

            if ($count == 0) //Si id n'existe pas s'oriente le client vers l'accueill
            {
                header('Location: index.php');
            } else { //Afficher le produit et stocker son id dans fichier de cookies 
                if (!isset($_COOKIE['latestItems'])) {

                    setcookie("latestItems[$iditem]", $iditem, time() + (3600 * 24 * 30)); // Valable 1 month
                } else {
                    $check = in_array($iditem, $_COOKIE['latestItems']);
                    if (!$check) {
                        setcookie("latestItems[$iditem]", $iditem, time() + (3600 * 24 * 30)); // Valable 1 month
                    }
                }

                foreach (getItemsById($_GET['idprod']) as $item) {
        ?>
                    <div class="row">
                        <div class="col-md-5 overflow-hidden">
                            <img class="img-responsive image_product hvr-grow" src="data/uploads/<?php echo $item['image']; ?>" alt="" />
                        </div>
                        <div class="col-md-7">
                            <h2><?php echo $item['titre_prod']; ?></h2>
                            <p class="price"><span>$<?php echo $item['prix']; ?></span></p>
                            <p class="sold"><?php echo $item['solds']; ?> sold</p>
                            <p class="lead"><?php echo $item['Description']; ?></p>
                            <form method="POST" action="buy.php?idprod=<?php echo $item['id_prod']; ?>">
                                <label for="qntty">Quantity : </label>
                                <input type="number" class="" name="qntty" id="qntty" value="1" min="1" max="99">
                                <div class="buy_cart">
                                    <span class="card-text add_cart"><a class="btn btn-info" href="cart.php?idprod=<?php echo $item['id_prod']; ?>">Add to cart <i class="fas fa-shopping-cart fa-lg"></i></a></span>
                                    <input type="submit" class="btn btn-primary" value="Buy Now">
                                </div>
                            </form>

                        </div>
                    </div>

        <?php
                }
            }
        } else {
            redirectfaild('You dont have permission to see this page ', 'index');
        }
        ?>

    </div>
</section>
<?php
include $tpl . 'footer.php';
?>