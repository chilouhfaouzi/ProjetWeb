<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand logo" href="dashboard.php"><span class="b">B</span><span class="o">o</span><span class="u">u</span><span class="k">k</span><span class="i">i</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="main-nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="admin-categories.php">Categories</a> </li>
                <li class="nav-item"><a class="nav-link" href="manage-items.php">Items</a> </li>
                <li class="nav-item"><a class="nav-link" href="members.php">Members</a> </li>
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Statics</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php if (isset($_SESSION['admin'])) {
                            echo $_SESSION['admin'];
                        } else {
                            echo "Account";
                        } ?>
                    </a>
                    <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                        <!-- <a class="dropdown-item" href="members.php?do=Edit&userid=?php echo $_SESSION['ID']; ?>">Edit Profile</a> -->
                        <a class="dropdown-item" href="members.php?do=Edit&userid=<?php echo $_SESSION['ID']; ?>">Edit
                            Profile</a>
                        <a class="dropdown-item" href="settings.php">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>