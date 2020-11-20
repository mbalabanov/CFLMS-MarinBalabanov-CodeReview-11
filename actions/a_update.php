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
        <title>Edit media | Big Library</title>
        
    </head>
    <body class="bg-light">

        <div class="container my-4">
            <div class='row pt-2 alert alert-success rounded-lg'>
                <div class='col-10 offset-1 text-center'>

                    <?php 
                        require_once 'db_connect.php';

                        if ($_POST) {
                            $title = $_POST['formtitle'];
                            $image = $_POST['formimage'];
                            $author_first_name = $_POST['formauthor_first_name'];
                            $author_last_name = $_POST['formauthor_last_name'];
                            $isbn_code = $_POST[ 'formisbn_code'];
                            $short_description = $_POST[ 'formshort_description'];
                            $publish_date = intval($_POST[ 'formpublish_date']);
                            $publisher_name = $_POST[ 'formpublisher_name'];
                            $publisher_address = $_POST[ 'formpublisher_address'];
                            $publisher_size = $_POST[ 'formpublisher_size'];
                            $media_type = $_POST[ 'formmedia_type'];

                            $media_id = $_POST['formmedia_id'];

                            $sql = "UPDATE media SET title = '$title', image = '$image', author_first_name = '$author_fist_name', author_last_name = '$author_last_name', isbn_code = '$isbn_code', short_description = '$short_description', publish_date = '$publish_date', publisher_name = '$publisher_name', publisher_address = '$publisher_address', publisher_size = '$publisher_size', media_type = '$media_type' WHERE media_id = {$media_id}" ;
                            if($connect->query($sql) === TRUE) {
                                echo "<h3>Media '$title' was successfully updated</h3><a class='btn btn-primary m-2' href='../update.php?id=" .$media_id."'>Edit media</a><a class='btn btn-secondary m-2' href='../index.php'>Back to library</a>";
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