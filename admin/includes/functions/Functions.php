<?php
//Functions 
    //Function for GetTitle Of page 
function getTitle(){
    global $pageTitle;
    if(isset($pageTitle)){
        echo $pageTitle;
    }
    else {
        echo "Default";
    }
}
function good($msg){
    echo '<p class="p-3 mb-2 bg-success text-white">' . $msg . '</p>';
}
function bad($msg){
    echo '<p class="p-3 mb-2 bg-danger text-white text-center">' . $msg . '</p>';
}
//show table
function showTable($tableHeader, $dataResults, $counter) {

    //Construct table header
    $table =  '<table  class="table  table-responsive " >'
            . ' <thead ><tr>';

    foreach ($tableHeader as $value) {
        $table .= '<th>' . $value . '</th>';
    }
    $table .= '</thead><tbody>';

    foreach ($dataResults as $rows) {
            $table .='<tr>';
        foreach($rows as $cell) {
            $table .= '<td>' . $cell . '</td>';
        }
            $table .='</tr>';
    }

    //Construct  table body
    $table .= '</tbody></table>';

    if ($counter == 0) {
        echo ('<p class="text-warning">Aucun utilisateur trouvé</p>');
    } 

    echo $table;
}
//Show product
function showproduct($tableHeader, $dataResults, $counter) {
    $nombreproducts=1;
    foreach ($dataResults as $rows) {
        // print_r($rows);
        $table="<br>";
        $table .=  '<table  class="table table-product" align="center" border="1" > <thead>
        <tr><th colspan="3"><span style="position: relative; left: 80px;">Product '.$nombreproducts.' </span><a style="color:red;" href="manage-items.php?change=remove&item='.$rows[0].'"><i class="fas fa-eye"></i> Remove</a> <a style="color:black;" href="manage-items.php?change=edit&item='.$rows[0].'"><i class="fas fa-pen"></i> Idit</a> </th></tr>
        </thread>  <tbody>';
        $nombreproducts++;
        unset($rows[0]); //on a suprime id parceque on a fini d'en avoir besoin et pour profiter la fonction array_combine : nombre des elements eguax
        foreach(array_combine($tableHeader , $rows) as $info => $cell ) {
            if($info=='Description'){
                $table .='<tr height="100px" >';
                $table .= '<td style="font-weight:600;" width="120px">' . $info . '</td>';
                $table .= '<td colspan="2"  >' . $cell . '</td>';                    
                $table .='</tr>';
            } else {
            $table .='<tr>';
            $table .= '<td style="font-weight:600;" width="120px">' . $info . '</td>';
            $table .= '<td  colspan="2">' . $cell . '</td>';
            $table .='</tr>';
            }
        }
        $table .= ' </tbody></table>';
        echo "<div class='clear-fix'></div>";
        echo $table;
    }

    //Construct  table body
    

    if ($counter == 0) {
        echo ('<p class="text-warning">Aucun Article trouvé</p>');
    } 

    
}
    /*Redirect function Failure
**$errmsg : echo  the error msg  , $seconds : seconds before redirecting
*/
function redirectfaild($errmsg, $redpage, $seconds = 3 ){ 
    echo "<div class='alert alert-danger text-center'>$errmsg </div>";
    echo "<div class='alert alert-info text-center'>You will redirected to $redpage page  after $seconds sec.</div>";
    header("Refresh:$seconds;url=$redpage.php");
    exit();
    }
    /*Redirect function Success
**$errmsg : echo  the error msg  , $seconds : seconds before redirecting
*/
function redirectsuccess($godmsg, $redpage, $seconds = 3 ){ 
    echo "<div class='alert alert-success'>$godmsg </div>";
    echo "<div class='alert alert-info'>You will redirected to $redpage page  after $seconds sec.</div>";
    header("Refresh:$seconds;url=$redpage.php");
    exit();
    }


    /*
    **Count Number of rows 
    **
    */
    function countRows($item, $table ) {
        global $con;
        $stmt=$con->prepare('SELECT COUNT('.$item.') FROM '.$table.'');
        $stmt->execute();
        return $stmt->fetchColumn();
    }
     /*
    **Get latest orders  */
    function getLatest_orders($LIMIT = 5){
        global $con;
        $stmt=$con->prepare('SELECT orders.* , users.fullname AS name,items.titre_prod as title FROM `orders` 
        INNER JOIN users ON orders.id = users.id
        INNER JOIN items ON orders.id_prod=items.id_prod 
         LIMIT '.$LIMIT.'');
        $stmt->execute();
        $rows= $stmt->fetchAll();
        return $rows ;
    }


    /*
    **Get latest Records function  
    ** $select : Field to select , $table : the table to choose from
    */
    function getLatest($select, $table,$order,$limit = 5 ) {
        global $con;
        $stmt=$con->prepare('SELECT '.$select.' FROM '.$table.' ORDER BY '.$order.' DESC LIMIT '.$limit.'');
        $stmt->execute();
        $rows= $stmt->fetchAll();
        return $rows ;
    }
    /*
    **Get statistique (Sells and Cart)
    ** 
    */
    function getStats($col) {
        global $con;
        $stmt=$con->prepare("SELECT $col FROM stats");
        $stmt->execute();
        $rows= $stmt->fetchColumn();
        return $rows;
    }
    /*
    **Increment statistique (Sells and Cart)
    ** $col : Column to increment ( sells or cart) , $qntty  : quantity (sells or cart) 
    */
    function incrStats($col,$qntty = 1) {
        global $con;
        $numbers=getStats($col);
        $numbers=$numbers+$qntty;
        $stmt=$con->prepare("UPDATE stats SET $col=$numbers");
        $stmt->execute();
    }
    
        /*
        **get categories
        */
    function getCats() {
    global $con;
    $stmt=$con->prepare("SELECT * FROM categories");
    $stmt->execute();
    $rows= $stmt->fetchAll();
    return $rows ;
    }


/*get items by categories
**
*/   
function getItemsByCat($idcat) {
    global $con;
    $stmt=$con->prepare("SELECT * FROM items  WHERE id_cat=$idcat");
    $stmt->execute();
    $rows= $stmt->fetchAll();
    return $rows ;
}
/*get items by categories with Limit
**
*/   
function getItems_By_Cat_With_Limit($idcat,$limit=3) {
    global $con;
    $stmt=$con->prepare("SELECT * FROM items  WHERE id_cat=$idcat LIMIT $limit");
    $stmt->execute();
    $rows= $stmt->fetchAll();
    return $rows ;
}
/*get items by ID
**
*/   
function getItemsById($idprod) {
    global $con;
    $stmt=$con->prepare("SELECT * FROM items WHERE id_prod=$idprod");
    $stmt->execute();
    $rows= $stmt->fetchAll();
    return $rows ;
}

/*get items by ID
**$Elements: The elements wanted
** $table :  From table
**$column  : The column tha is subject to the condition
**$value : The value of condition 
*/ 
function getElementsByColomn ($Elements, $table, $column, $value)
{
    global $con;
    $stmt=$con->prepare("SELECT $Elements FROM $table WHERE $column=$value");
    $stmt->execute();
    $rows= $stmt->fetchAll();
    return $rows ;
}

function getForAll( $elem,$table,$condition)
{
    global $con;
    $stmt=$con->prepare("SELECT $elem FROM $table WHERE $condition");
    $stmt->execute();
    $rows= $stmt->fetchAll();
    return $rows ;
}



?>