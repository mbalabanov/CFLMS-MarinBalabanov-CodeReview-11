<?php
    ob_start();
    session_start();

    // Prevents any users to access this action who are not superadmin
    if( !isset($_SESSION['superadmin' ]) ) {
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <title>Edit user | Adopt A Pet</title>
        
    </head>
    <body class="bg-light">

        <div class="container my-4">
            <div class='row pt-2 alert alert-success rounded-lg'>
                <div class='col-10 offset-1 text-center'>

                    <!-- Updates the item and displays message to user -->
                    <?php 
                        require_once 'db_connect.php';

                        if ($_POST) {
                            $userName = $_POST['formuserName'];
                            $userImage = $_POST['formuserImage'];
                            $userEmail = $_POST['formuserEmail'];
                            $pass = $_POST['formpassword'];
                            $password = hash('sha256' , $pass);
                            $userType = $_POST['formuserType'];

                            $userId = $_POST['formuserId'];

                            $sql = "UPDATE users SET userName = '$userName', userImage = '$userImage', userEmail = '$userEmail', userPass = '$password', userType = '$userType' WHERE userId = {$userId}" ;
                            if($connect->query($sql) === TRUE) {
                                echo "<h3>User '$userName' was successfully updated</h3><a class='btn btn-primary m-2' href='../adminupdate.php?id=" .$userId."'>Edit user</a><a class='btn btn-secondary m-2' href='../admin.php'>Back to Users</a>";
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