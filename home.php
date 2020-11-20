<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['user' ]) && !isset($_SESSION['admin' ]) ) {
        header("Location: index.php");
        exit;
    }

    // select logged-in users details
    if(isset($_SESSION['user' ]) ) {
        $res=mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
    } elseif (isset($_SESSION['admin' ]) ) {
        $res=mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['admin']);
    }
    $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <title>Adopt A Pet</title>
    </head>
    <body class="bg-light">

    <?php include('navbar.php'); ?>

    <div class="container">
        <h2 class="mt-5 text-center">Welcome to the Adopt A Pet</h2>
        <div class="row">
            <div class="col-12 text-center mb-2">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Add new media
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <?php include('forms/createmediaform.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5 alert alert-primary pb-4 rounded-lg">

            <?php
                $sql = 'SELECT * FROM media';
                $result = $connect->query($sql);

                if($result->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        printf('
                        <div class="card mb-3">
                        <div class="row no-gutters">
                          <div class="col-md-3">
                            <img src="%s" class="card-img" alt="%s">
                          </div>
                          <div class="col-md-9">
                            <div class="card-body">
                                <h4 class="card-title">%s</h4>
                                <h5 class="card-title">by %s %s</h5>
                                <span class="badge badge-pill badge-success mb-3">%s</span>
                                <p class="card-text"><sup><strong>%s</strong>, published %s. ISBN-%s. %s (%s)</sup></p>
                                <p class="card-text">%s</p>
                                <p class="card-text">
                                    <a class="btn btn-primary btn-sm m-2" href="update.php?id=%s">Edit media</a>
                                    <a class="btn btn-danger btn-sm m-2"  href="delete.php?id=%s">Delete media</a>
                                </p>
                            </div>
                          </div>
                        </div>
                      </div>',
                      $row['image'], $row['title'], $row['title'], $row['author_first_name'], $row['author_last_name'], $row['status'], $row['media_type'], $row['publish_date'], $row['isbn_code'], $row['publisher_name'], $row['publisher_address'], $row['short_description'], $row['media_id'], $row['media_id']);
                    }
                } else {
                    echo('<div class="alert alert-danger text-center" role="alert"><h3>No meals in database</h3></div>');
                }
            ?>

        </div>
    </div>

    <?php include('footer.php'); ?>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

  </body>
</html>
<?php ob_end_flush(); ?>