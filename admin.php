<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // it will never let you open admin page if session is set
    if( !isset($_SESSION['admin' ]) ) {
        header("Location: index.php");
        exit;
    }

    // select logged-in users details
    $res=mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['admin']);
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

    <div class="container my-5">
        <div class="row my-3">
            <div class="col-12 text-center">
                <h2>User Administration</h2>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12 text-center">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    New user
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <?php include('forms/registrationform.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php
                    if ( isset($errMSG) ) {
                ?>

                <div class="alert alert-<?php echo $errTyp ?> text-center" >
                    <?php echo $errMSG; ?>
                </div>

                <?php
                    }
                ?>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Profile Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email Address</th>
                            <th scope="col">Type</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = 'SELECT * FROM users';
                    $result = $connect->query($sql);

                    if($result->num_rows > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            printf('
                                <tr>
                                    <td>
                                        <img src="%s" alt="%s" width="100px">
                                    </td>
                                    <td>
                                        %s
                                    </td>
                                    <td>
                                        %s
                                    </td>
                                    <td>
                                        %s
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm mx-2" href="adminupdate.php?id=%s">Edit</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger btn-sm mx-2"  href="admindelete.php?id=%s">Delete</a>
                                    </td>
                                </tr>',
                                $row['userImage'], $row['userName'], $row['userName'], $row['userEmail'], $row['userType'], $row['userId'], $row['userId']);
                            }
                        } else {
                            echo('<tr><td colspan="6">No users in database</td></tr>');
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

  </body>
</html>
<?php ob_end_flush(); ?>