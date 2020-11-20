<nav class="navbar navbar-expand-lg navbar-light bg-light shadow p-4">
    <a href="index.php"><img src="assets/adopt-a-pet-logo/adopt-a-pet-logo.png" height="80" alt="Adopt A Pet" class="mr-4 navbar-brand h1" loading="lazy"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php
                if( isset($_SESSION['user']) || isset($_SESSION['admin']) ) {
                    echo('<li class="nav-item"><a class="nav-link" href="index.php">Pets</a></li>');
                }
            ?>
            <?php
                if( !isset($_SESSION['user']) && !isset($_SESSION['admin']) ) {
                    echo('<li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>');
                }
            ?>
            <?php
                if( isset($_SESSION['admin']) ) {
                    echo('<li class="nav-item"><a class="nav-link" href="admin.php">User Administration</a></li>');
                }
            ?>
        </ul>
        <?php
            if( isset($_SESSION['user']) || isset($_SESSION['admin']) ) {
                echo('<img src="'. $userRow['userImage' ] .'" height="40px" alt="'. $userRow['userEmail' ] .'" class="mx-3">'. $userRow['userEmail'] .' ('. ucfirst($userRow['userType' ]) .')<a class="btn btn-primary mx-4" href="logout.php?logout">Logout</a>');
            }
        ?>
    </div>
</nav>