<?php
    ob_start();
    session_start();

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin' ]) ) {
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <title>Edit user | Adopt A Pet</title>
        
    </head>
    <body class="bg-light">

        <div class="container my-4">
            <div class='row pt-2 alert alert-success rounded-lg'>
                <div class='col-10 offset-1 text-center'>

                    <?php 
                        require_once 'db_connect.php';

                        if ($_POST) {
                            $userName = $_POST['formuserName'];
                            $userImage = $_POST['formuserImage'];
                            $userEmail = $_POST['formuserEmail'];
                            $userType = $_POST[ 'formuserType'];

                            $userId = $_POST['formuserId'];

                            $sql = "UPDATE users SET userName = '$userName', userImage = '$userImage', userEmail = '$userEmail', userType = '$userType' WHERE userId = {$userId}" ;
                            if($connect->query($sql) === TRUE) {
                                echo "<h3>User '$userName' was successfully updated</h3><a class='btn btn-primary m-2' href='../update.php?id=" .$userId."'>Edit user</a><a class='btn btn-secondary m-2' href='../admin.php'>Back to admin UI</a>";
                            } else {
                                echo "Error while updating record : ". $connect->error;
                            }

                            $connect->close();
                        }
                    ?>

                </div>
            </div>
        </div >
        <script src="../js/jquery-3.5.1.min.js"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
    </body>
</html>