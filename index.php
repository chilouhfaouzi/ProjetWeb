<?php 
ob_start(); //Pour resoudre problem de  headers already sent .

session_start();
$pageTitle="Home"; 
include "admin/init.php";
?>
<section class="home">
    <div class="container text-center">
        <div class="categories-home">
            <div class="row">
                <div class="col-md-1"></div>
                <?php 
        foreach(getCats() as $cat){?>
                <div class="col-md-2 hvr-grow">
                    <a href="categories.php?idcat=<?php echo $cat['id_cat'] ?>">
                        <span><i class="fa fa-<?php echo $cat['icon']?> fa-3x icon-cat"></i></span>
                        <p class="cat-hom"><?php echo $cat['titre_cat'];?></p>
                    </a>

                </div>
                <?php  }?>
            </div>
        </div>
        <?php
/* Start lates items visisted */ 
if(isset($_COOKIE['latestItems'])){?>
        <h3 class="home-cate text-left">Recently viewed</h3>
        <!--if(count($_COOKIE['latestItems']) > 1 ) -->
        <div class="row">
            <?php
  $nombre= 0 ;
     foreach($_COOKIE['latestItems'] as $latestItem){
     $array_items_visited[] = $latestItem  ;//Convertir table associative(Keys) to table index ( 0,1,2,3 )
     $nombre++;
    }
    if(count($_COOKIE['latestItems'] ) >= 3) {//if the client visited more than 3 --> the lemght of table must be just
      $len=3;
    }else{
      $len=count($_COOKIE['latestItems']);
    }
    $array_rand=array();
    for ($i=0;$i<$len;$i++){
      /*verifier si l'article deja aficher pour pas repeter deux articles au meme temps */
      $aloeatoir= rand(0 , $nombre-1);  
      while(in_array($aloeatoir,$array_rand)){
        $aloeatoir= rand(0 , $nombre-1);  
      }
      $array_rand[]=$aloeatoir;
      $item = getItemsById ($array_items_visited [$aloeatoir] );//prendre aleatoirement une produit deja visited
       $item=$item[0];
       echo "<div class='col-sm-6 col-md-4'>";
       echo'
          <div class="card item-box">
          <a href="showproduct.php?idprod='.$item['id_prod'].'"> <img src="data/uploads/'.$item['image'].'" class="card-img-top hvr-grow" role="button" alt=""></a>
           <div class="card-body">
           <h5 class="card-title"><a href="showproduct.php?idprod='.$item['id_prod'].'">'.$item['titre_prod'].'</a></h5>
           <span class="price"> $'.$item['prix'].'</span>
           <span class="card-text sold">'.$item['solds'].' sold</span>
           <span class="card-text add_cart"><a class="btn btn-info hvr-grow" href="cart.php?idprod='.$item['id_prod'].'">Add to cart <i class="fas fa-shopping-cart fa-lg"></i></a></span>
           <a href="showproduct.php?idprod='.$item['id_prod'].'" class="btn btn-primary hvr-grow">Show More</a>
           </div>
          </div>';
      echo "</div>";

    }
   ?>
        </div>
        <!--End row -->

        <?php }
/* End lates items visisted */ 

/*Start Suggestion */
if(isset($_COOKIE['categories']))
{
?>

        <h3 class="home-cate text-left">Recommendations for you</h3>
        <div class="row">
            <?php   $sugecats=array();
  foreach($_COOKIE['categories'] as $cat){//prend tous les categories visites el les stockes dans une tableau indices
   $sugecats[]=$cat;
 }
 if(count($sugecats) == 1)
 {
    $items = getItemsByCat($sugecats[0]);//Ona  selement une seule categorie
    $suggItems =array();
    foreach($items as $item)
    {
      $suggItems[]=$item['id_prod'];
    }
    /*verifier si l'article deja aficher pour pas repeter deux articles au meme temps */
    $len= count($suggItems) - 1;
    $array_rand2=array();
    for($i=0;$i<3;$i++)
    {
      $aloeatoir= rand(0 , $len);  
      while(in_array($aloeatoir,$array_rand2))
      {
        $aloeatoir= rand(0 , $len-1);  
      }
      $array_rand2[]=$aloeatoir;
    
      $item = getItemsById ($suggItems[$aloeatoir] );//prendre aleatoirement une produit deja visited
      $item=$item[0];
      echo "<div class='col-sm-6 col-md-4'>";
      echo'
        <div class="card item-box">
        <a href="showproduct.php?idprod='.$item['id_prod'].'"> <img src="data/uploads/'.$item['image'].'" class="card-img-top hvr-grow" role="button" alt=""></a>
        <div class="card-body">
          <h5 class="card-title"><a href="showproduct.php?idprod='.$item['id_prod'].'">'.$item['titre_prod'].'</a></h5>
          <span class="price"> $'.$item['prix'].'</span>
          <span class="card-text sold">'.$item['solds'].' sold</span>
          <span class="card-text add_cart"><a class="btn btn-info  hvr-grow" href="cart.php?idprod='.$item['id_prod'].'">Add to cart <i class="fas fa-shopping-cart fa-lg"></i></a></span>
          <a href="showproduct.php?idprod='.$item['id_prod'].'" class="btn btn-primary  hvr-grow">Show More</a>
          </div>
        </div>';
     echo "</div>";
    }//End For                        
 }   //End If the client visited just one categorie
  if(count($sugecats) == 2)//On 2 categories on prendre 2 depuis la premiere categories et 1 depuis le dexieme et on l'affiche 
  {
    $itemscat1=getItemsByCat($sugecats[0]);
    $itemscat2=getItemsByCat($sugecats[1]);//On a selement 2 categoies
    $suggItems1 =array();
    $suggItems2 =array();
    foreach($itemscat1 as $item1)
    {
      $suggItems1[]=$item1['id_prod'];
    }  
    foreach($itemscat2 as $item2)
    {
      $suggItems2[]=$item2['id_prod'];
    } 
    for($i=0;$i<2;$i++)
    {
      /*verifier si l'article deja aficher pour pas repeter deux articles au meme temps */
       $len= count($suggItems1) - 1;
      $array_rand2=array();
      $aloeatoir= rand(0 , $len);  
      while(in_array($aloeatoir,$array_rand2))
      {
        $aloeatoir= rand(0 , $nombre-1);  
      }
      $array_rand2[]=$aloeatoir;
      $item = getItemsById ($suggItems1[$aloeatoir] );//prendre aleatoirement une produit deja visited
      $item=$item[0];
      echo "<div class='col-sm-6 col-md-4'>";
      echo'
        <div class="card item-box">
        <a href="showproduct.php?idprod='.$item['id_prod'].'"> <img src="data/uploads/'.$item['image'].'" class="card-img-top hvr-grow" role="button" alt=""></a>
        <div class="card-body">
          <h5 class="card-title"><a href="showproduct.php?idprod='.$item['id_prod'].'">'.$item['titre_prod'].'</a></h5>
          <span class="price"> $'.$item['prix'].'</span>
          <span class="card-text sold">'.$item['solds'].' sold</span>
          <span class="card-text add_cart"><a class="btn btn-info  hvr-grow" href="cart.php?idprod='.$item['id_prod'].'">Add to cart <i class="fas fa-shopping-cart fa-lg"></i></a></span>
          <a href="showproduct.php?idprod='.$item['id_prod'].'" class="btn btn-primary hvr-grow">Show More</a>
          </div>
        </div>';
     echo "</div>";
    }//End For  
     /*verifier si l'article deja aficher pour pas repeter deux articles au meme temps */
     $len= count($suggItems2) - 1;
     $array_rand2=array();
     $aloeatoir= rand(0 , $len);  
     while(in_array($aloeatoir,$array_rand2))
     {
       $aloeatoir= rand(0 , $nombre-1);  
     }
     $array_rand2[]=$aloeatoir;
     $item = getItemsById ($suggItems2[$aloeatoir] );//prendre aleatoirement une produit deja visited
     $item=$item[0];
     echo "<div class='col-sm-6 col-md-4'>";
     echo'
       <div class="card item-box">
       <a href="showproduct.php?idprod='.$item['id_prod'].'"> <img src="data/uploads/'.$item['image'].'" class="card-img-top hvr-grow" role="button" alt=""></a>
       <div class="card-body">
         <h5 class="card-title"><a href="showproduct.php?idprod='.$item['id_prod'].'">'.$item['titre_prod'].'</a></h5>
         <span class="price"> $'.$item['prix'].'</span>
         <span class="card-text sold">'.$item['solds'].' sold</span>
         <span class="card-text add_cart"><a class="btn btn-info  hvr-grow" href="cart.php?idprod='.$item['id_prod'].'">Add to cart <i class="fas fa-shopping-cart fa-lg"></i></a></span>
         <a href="showproduct.php?idprod='.$item['id_prod'].'" class="btn btn-primary  hvr-grow">Show More</a>
         </div>
       </div>';
    echo "</div>";
    
  }
  if(count($sugecats) >=3){
    $scats=array();
    $len= count($sugecats) - 1;
    $array_rand3=array();
    for($i=0;$i<3;$i++){
      $aloeatoir= rand(0 , $len);  
      while(in_array($aloeatoir,$array_rand3))
      {
        $aloeatoir = rand(0 , $len);  
      }
      $array_rand3[]=$aloeatoir;
      $itemsCat=getItemsByCat($sugecats[$aloeatoir]);
      $ary_item=array();
      foreach($itemsCat as $item){
        $ary_item[]=$item['id_prod'];
      }
      $itemf=getItemsById( $ary_item[rand(1,count($ary_item)) -1] );
      $itemf=$itemf[0];
      echo "<div class='col-sm-6 col-md-4'>";
      echo'
        <div class="card item-box">
        <a href="showproduct.php?idprod='.$itemf['id_prod'].'"> <img src="data/uploads/'.$itemf['image'].'" class="card-img-top hvr-grow" role="button" alt=""></a>
        <div class="card-body">
          <h5 class="card-title"><a href="showproduct.php?idprod='.$itemf['id_prod'].'">'.$itemf['titre_prod'].'</a></h5>
          <span class="price"> $'.$itemf['prix'].'</span>
          <span class="card-text sold">'.$itemf['solds'].' sold</span>
          <span class="card-text add_cart"><a class="btn btn-info  hvr-grow" href="cart.php?idprod='.$itemf['id_prod'].'">Add to cart <i class="fas fa-shopping-cart fa-lg"></i></a></span>
          <a href="showproduct.php?idprod='.$itemf['id_prod'].'" class="btn btn-primary hvr-grow">Show More</a>
          </div>
        </div>';
     echo "</div>";
    }
  }


       ?> </div>
        <?php
}
/*End Suggestion */

$stmt=$con->prepare("SELECT id_cat, titre_cat FROM categories");
$stmt->execute();
$cats= $stmt->fetchAll();
foreach($cats as $cat){
    ?>
        <h3 class="home-cate float-left"><?php echo $cat['titre_cat'];?></h3>
        <p class="float-left"><a class="see_more" href="categories.php?idcat=<?php echo $cat['id_cat']; ?>">See More</a>
        </p>
        <div class="clearfix"></div>
        <!--CLear float -->
        <div class="row">
            <?php    
  foreach(getItems_By_Cat_With_Limit($cat['id_cat']) as $items){
      echo "<div class='col-sm-6 col-md-4'>";
      echo'
         <div class="card item-box">
          <a href="showproduct.php?idprod='.$items['id_prod'].'"> <img src="data/uploads/'.$items['image'].'" class="card-img-top hvr-grow" role="button" alt=""></a>
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
  echo " </div> ";  //end row 
  
  echo '<p></p>';
  
}
  ?>

        </div>
</section>
<?php  include $tpl.'footer.php';
ob_end_flush();

?>