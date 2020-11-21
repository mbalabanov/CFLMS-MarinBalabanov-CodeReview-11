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
        <h2 class="mt-5 text-center">Welcome to Adopt A Pet</h2>
        <div class="row">
            <div class="col-12 text-center mb-2">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Add new pet entry
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <?php include('forms/createpetform.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5 alert alert-warning pb-4 rounded-lg border">

            <?php
                $sql = 'SELECT * FROM pets';
                $result = $connect->query($sql);

                if($result->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        printf('
                        <div class="card mb-3">
                        <div class="row no-gutters">
                          <div class="col-md-3">
                            <img src="%s" class="card-img p-2" alt="%s">
                          </div>
                          <div class="col-md-9">
                            <div class="card-body">
                                <h4 class="card-title">%s</h4>
                                <p class="card-text"><span class="badge badge-pill badge-success mb-3 mr-2">%s</span><strong>%s</strong> years old</p>
                                <p class="card-text">%s</p>
                                <p class="card-text">
                                    <a class="btn btn-primary btn-sm m-2" href="update.php?id=%s">Edit pet entry</a>
                                    <a class="btn btn-danger btn-sm m-2"  href="delete.php?id=%s">Delete pet entry</a>
                                </p>
                            </div>
                          </div>
                        </div>
                      </div>',
                      $row['image'], $row['name'], $row['name'], $row['type'], $row['age'], $row['descriptions'], $row['hobbies'], $row['pet_id'], $row['pet_id']);
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