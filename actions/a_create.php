<?php
    ob_start();
    session_start();

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['user' ]) ) {
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
    <title>Add Pet Entry | Adopt A Pet</title>
    
</head>
<body class="bg-light">

    <div class="container my-4">
        <div class='row pt-2 alert alert-primary rounded-lg'>
            <div class='col-10 offset-1 text-center'>

                <?php 
                    require_once 'db_connect.php';

                    if ($_POST) {
                    $title = $_POST['formtitle'];
                    $image = $_POST['formimage'];
                    $author_first_name = $_POST[ 'formauthor_first_name'];
                    $author_last_name = $_POST[ 'formauthor_last_name'];
                    $isbn_code = $_POST[ 'formisbn_code'];
                    $short_description = $_POST[ 'formshort_description'];
                    $publish_date = intval($_POST[ 'formpublish_date']);
                    $publisher_name = $_POST[ 'formpublisher'];
                    $publisher_address = $_POST[ 'formpublisher'];
                    $publisher_size = $_POST[ 'formpublisher'];
                    $media_type = $_POST[ 'formmedia_type'];

                    $sql = "INSERT INTO media (title, image, author_first_name, author_last_name, isbn_code, short_description, publish_date, publisher_name, publisher_address, publisher_size, media_type) VALUES ('$title', '$image', '$author_first_name', '$author_last_name', '$isbn_code', '$short_description', '$publish_date', '$publisher_name', '$publisher_address', '$publisher_size', '$media_type')";
                        if($connect->query($sql) === TRUE) {
                        echo "
                            <h3>New media '$title' successfully added to database</h3>
                            <a class='btn btn-secondary m-2' href='../index.php'>Back to library</a>
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