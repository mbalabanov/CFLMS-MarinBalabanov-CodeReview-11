<nav class="navbar navbar-expand-lg navbar-light bg-light shadow p-4">
    <a href="index.php"><img src="assets/adopt-a-pet-logo/adopt-a-pet-logo.png" height="80" alt="Adopt A Pet" class="mr-4 navbar-brand h1" loading="lazy"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- The navbar hides the login and register buttons when users are already logged in.
         It only shows the navbar item for location to Admins and Superadmins.
         It only shows the navbar item for the user administration to Superadmins.
         When users are logged in, then their email address and their role are displayed in the navbar. -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php
                if( isset($_SESSION['user']) || isset($_SESSION['admin']) || isset($_SESSION['superadmin']) ) {
                    echo('<li class="nav-item"><a class="nav-link" href="index.php">List of Pets</a></li>');
                }
            ?>
            <?php
                if( isset($_SESSION['admin']) || isset($_SESSION['superadmin']) ) {
                    echo('<li class="nav-item"><a class="nav-link" href="locations.php">Locations</a></li><li class="nav-item"><a class="nav-link" href="admin.php">User Administration</a></li>');
                }
            ?>
        </ul>
        <?php
                if( !isset($_SESSION['user']) && !isset($_SESSION['admin'])  && !isset($_SESSION['superadmin']) ) {
                    echo('<a class="btn btn-outline-primary mx-1" href="register.php">Register</a><a class="btn btn-primary mx-1" href="index.php#login-box">Login</a>');
                }
                if( isset($_SESSION['user']) || isset($_SESSION['admin']) || isset($_SESSION['superadmin']) ) {
                    echo('<img src="'. $userRow['userImage' ] .'" height="40px" alt="'. $userRow['userEmail' ] .'" class="mx-3">'. $userRow['userEmail'] .' ('. ucfirst($userRow['userType' ]) .')<a class="btn btn-primary mx-4" href="logout.php?logout">Logout</a>');
                }
        ?>
    </div>
</nav>