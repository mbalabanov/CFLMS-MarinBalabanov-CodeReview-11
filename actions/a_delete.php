<?php
    ob_start();
    session_start();

    // Prevents any users to access this action who are not admin or superadmin
    if( !isset($_SESSION['admin' ]) && !isset($_SESSION['superadmin' ]) ) {
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
    <title>Delete Entry | Adopt A Pet</title>
    
</head>
<body class="bg-light">

    <div class="container my-4">
        <div class='row pt-2 alert alert-secondary rounded-lg'>
            <div class='col-10 offset-1 text-center py-4'>

                <!-- Deletes the item and displays message to user -->
                <?php 
                    require_once 'db_connect.php';
                    if ($_POST) {
                        $id = $_POST['id'];
                        $sql = "DELETE FROM pets WHERE petId = {$id}";
                            if($connect->query($sql) === TRUE) {
                            echo "<h3>Successfully deleted!!</h3><a class='btn btn-primary' href='../index.php'>Back to pet list</a>";
                        } else {
                            echo "<h3>Error updating record: ". $connect->error ."</h3>";
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