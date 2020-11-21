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
    <title>Add A New Location | Adopt A Pet</title>
    
</head>
<body class="bg-light">

    <div class="container my-4">
        <div class='row pt-2 alert alert-primary rounded-lg'>
            <div class='col-10 offset-1 text-center'>

                <?php 

                    require_once 'db_connect.php';

                    if ($_POST) {
                        $street = $_POST['formstreet'];
                        $town = $_POST['formtown'];
                        $postalCode = $_POST[ 'formpostalcode'];
                        $country = intval($_POST[ 'formcountry']);

                        echo "$street, $town, $postalCode, $country";

                        $sql = "INSERT INTO locations (street, town, postalCode, country) VALUES ('$street', '$town', '$postalCode', '$country')";
                            if($connect->query($sql) === TRUE) {
                            echo "
                                <h3>New location address at '$street' successfully added to database</h3>
                                <a class='btn btn-secondary m-2' href='../index.php'>Back to pet list</a>
                                ";
                        } else  {
                            echo "
                            <div class='alert alert-danger pt-2 text-center' role='alert'>
                                <h3>Error " . $sql ." ". $connect->connect_error ."</h3>
                            </div>
                            ";
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