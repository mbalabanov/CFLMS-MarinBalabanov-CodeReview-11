<?php
    ob_start();
    session_start();

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin' ]) && !isset($_SESSION['superadmin' ]) ) {
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
        <title>Edit Pet Entry | Adopt A Pet</title>
        
    </head>
    <body class="bg-light">

        <div class="container my-4">
            <div class='row pt-2 alert alert-success rounded-lg'>
                <div class='col-10 offset-1 text-center'>

                    <?php 
                        require_once 'db_connect.php';

                        if ($_POST) {
                            $name = $_POST['formname'];
                            $image = $_POST['formimage'];
                            $type = $_POST[ 'formtype'];
                            $descriptions = $_POST[ 'formdescription'];
                            $hobbies = $_POST[ 'formhobbies'];
                            $age = intval($_POST[ 'formage']);
                            $location = intval($_POST[ 'formlocation']);

                            $petId = $_POST['formpetid'];

                            $sql = "UPDATE pets SET name = '$name', image = '$image', type = '$type', descriptions = '$descriptions', hobbies = '$hobbies', age = '$age', location = '$location' WHERE petId = {$petId}" ;
                            if($connect->query($sql) === TRUE) {
                                echo "<h3>The entry for '$name' was successfully updated</h3><a class='btn btn-primary m-2' href='../update.php?id=".$petId."'>Edit Entry</a><a class='btn btn-secondary m-2' href='../index.php'>Back to Pet List</a>";
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