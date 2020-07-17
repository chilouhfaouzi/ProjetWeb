<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
  <a class="navbar-brand logo" href="index.php"><span class="b">B</span><span class="o">o</span><span class="u">u</span><span class="k">k</span><span class="i">i</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="main-nav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-capitalize" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Categories
        </a>
        <div class="dropdown-menu " aria-labelledby="navbarDropdown">
          <?php 
           foreach(getCats() as $cat){
                echo '<a class="dropdown-item" href="categories.php?idcat='.$cat['id_cat'].'">'.$cat['titre_cat'].'</a>' ;
           }
          ?>
         
        </div>
      </li>
      <li class="nav-item"><a class="nav-link" href="best_offers.php">Best offers</a> </li>
      <li class="nav-item"><a class="nav-link" href="help.php">Help</a> </li>
     
    </ul>
    <ul class="navbar-nav ml-auto">
    <li class="nav-item hvr-grow"><a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart fa-lg"></i></a> </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-capitalize" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <?php if (isset($_SESSION['username'])) {  echo $_SESSION['firstname'] ;} else {echo"Account";}?>
        </a>
        <div class="dropdown-menu " aria-labelledby="navbarDropdown">
         <!-- <a class="dropdown-item" href="members.php?do=Edit&userid= ?php echo $_SESSION['ID']; ?>">Edit Profile</a> -->
         <a class="dropdown-item" href="orders.php">My Orders</a>
         <a class="dropdown-item" href="<?php if (isset($_SESSION['username'])) {  echo 'account.php?id'.$_SESSION['ID'].''; } else {echo "login.php"; }?>">My Account</a>
          <div class="dropdown-divider"></div>
          <?php if (isset($_SESSION['username'])) { echo '<a class="dropdown-item" href="logout.php">LogOut</a>';} else {echo '<a class="dropdown-item" href="login.php">Sign-In</a>';}?>
          
        </div>
      </li>
    </ul>
  </div>
  </div>
</nav>


