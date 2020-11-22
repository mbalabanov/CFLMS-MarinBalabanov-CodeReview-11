<?php
    session_start();
    if (!isset($_SESSION['user']) || !isset($_SESSION['admin']) || !isset($_SESSION['superadmin']) ) {
        header( "Location: index.php");
    }

    // Destroys the user sessions on logout.
    if (isset($_GET['logout'])) {
        unset($_SESSION['user' ]);
        session_unset();
        session_destroy();

        unset($_SESSION['admin' ]);
        session_unset();
        session_destroy();

        unset($_SESSION['superadmin' ]);
        session_unset();
        session_destroy();

        header("Location: index.php");
        exit;
    }
?>