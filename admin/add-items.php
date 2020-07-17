<?php
session_start();
$pageTitle="Add Items"; 
include "init.php";
?>
<section class="add_items text-center">
    <div class="container">

        <?php
if(isset($_SESSION['admin'])){
    if(isset($_POST['title'] ) ) { 
        $title=$_POST['title'] ;
        $price=$_POST['price'] ;
        $description=$_POST['description'] ;
        $item_cate= $_POST['item-cate'];
        $stmt=$con->prepare("SELECT id_cat FROM categories WHERE titre_cat=?"); //? 
        $stmt->execute(array($item_cate));
        $row = $stmt->fetch();
        $id_cat=$row['id_cat'];
        $uploadOk = False;
        //upload the image
        if (isset($_FILES ['img-itm'] ['tmp_name']) && !empty($_FILES ['img-itm'] ['tmp_name'])) {
            $uploadOk = False;
            $fichier = basename($_FILES ['img-itm'] ['name']);
            $path_parts = pathinfo($fichier);
            $uploadOk= move_uploaded_file($_FILES ['img-itm'] ['tmp_name'], $pathprojet.'data/uploads/'. $fichier);
            if ($uploadOk) {
                $stmt=$con->prepare("INSERT INTO items (titre_prod ,Description, image, prix,id_cat ) VALUES (:titre_prod , :Description, :image , :prix,:id_cat)");     // :colomn gha t3awad fach dir execute
                $stmt->execute(array(
                            ':titre_prod'=>$title,
                            ':Description'=>$description,
                            ':image'=>$fichier,
                            ':prix'=> $price,
                            ':id_cat'=>$id_cat
                ));
                echo "Item added ";
                header('Location: manage-items.php');
            }
    }
}
else{
    ?>
        <h2>Add Items</h2>
        <form class="f-add-items text-left" enctype="multipart/form-data" method="post">
            <div class="col-md-8">
                <input class="form-control" type="text" name="title" placeholder="Title" required="required" />
            </div>
            <div class="col-md-8">
                <input class="form-control" type="text" name="price" placeholder="Price" /> <span
                    class="dollars">$</span>
            </div>
            <div class="col-md-8">
                <label style="font-size: 20px; font-weight:600;">Image : <i class="fas fa-plus-circle "></i></label>
                <input type="file" class="form-control-file" name="img-itm">
            </div>


            <div class="col-md-8">
                <select class="form-control" name="item-cate">
                    <label style="font-size: 20px; font-weight:600;">category:</label>
                    <?php
        $stmt=$con->prepare("SELECT * FROM categories "); //? 
        $stmt->execute(array());
        $count=$stmt->rowCount();
        while ($row = $stmt->fetch()) {
            echo ' <option >'. $row["titre_cat"] .'</option>';}
          ?>
                </select>
            </div>
            <div class="col-md-8">
                <textarea class="form-control" type="text" name="description" placeholder="Description"><ul>
<li></li>
<li></li>
<li></li>
<li></li>
<li></li>
</ul>
        </textarea>
            </div>
            <input class="btn btn-primary col-md-2 d-block ml-auto mr-auto" type="submit" name="submit"
                value="Add Items" />

        </form>
        <?php

} //else : title not set
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