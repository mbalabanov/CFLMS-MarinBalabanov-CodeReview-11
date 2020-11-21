<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['user' ]) && !isset($_SESSION['admin' ]) && !isset($_SESSION['superadmin' ]) ) {
        header("Location: index.php");
        exit;
    }

    // select logged-in users details
    if(isset($_SESSION['user' ]) ) {
        $res=mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
    } elseif (isset($_SESSION['admin' ]) ) {
        $res=mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['admin']);
    } elseif (isset($_SESSION['superadmin' ]) ) {
        $res=mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['superadmin']);
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
        <p class="text-center">Write to us at <a href="mailto:office@adoptapet.com">office@adoptapet.com</a> if you want to adopt a pet. Pets older than eight years, have their <span class="text-danger">age marked red.</span></p>
        
        <?php
            if( isset($_SESSION['admin']) || isset($_SESSION['superadmin']) ) {
                printf('
                <div class="row">
                    <div class="col-12 text-center mb-2">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            New Pet Entry
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="m-4 alert alert-primary">');

                include("forms/createpetform.php");
                printf('
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ');
            }
        ?>

        <div class="row mb-5 alert alert-warning pb-4 rounded-lg border">

            <?php
                $sql = 'SELECT pets.petId, pets.name, pets.image, pets.type, pets.age, pets.descriptions, pets.hobbies, locations.street, locations.town, locations.postalCode, countries.CountryName FROM pets, locations, countries WHERE pets.location = locations.locationId AND locations.country = countries.countryId';
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
                                <p class="card-text"><span class="badge badge-pill badge-success p-2 mr-2">%s</span>',
                                $row['image'], $row['name'], $row['name'], $row['type']);
                                
                                if($row['age'] > 7) {
                                    printf('<span class="text-danger"><strong>%s</strong> years old</span></p>',
                                    $row['age']);
                                } else {
                                    printf('<strong>%s</strong> years old</p>',
                                    $row['age']);
                                }

                                printf('<p class="card-text"><strong>Description:</strong> %s<br/><strong>Hobbies:</strong> %s<br/><strong>Location:</strong> %s, %s %s, %s</p>'
                                , $row['descriptions'], $row['hobbies'], $row['street'], $row['postalCode'], $row['town'], $row['CountryName']);

                                if( isset($_SESSION['admin']) || isset($_SESSION['superadmin']) ) {
                                    printf('
                                    <p class="card-text">
                                        <a class="btn btn-primary btn-sm m-2" href="update.php?id=%s">Edit pet entry</a>
                                        <a class="btn btn-danger btn-sm m-2"  href="delete.php?id=%s">Delete pet entry</a>
                                    </p>', $row['petId'], $row['petId']);
                                } else {
                                    printf('
                                    <div class="alert alert-success" role="alert">
                                    To adopt <strong>%s</strong>, please send an email to <a href="mailto:office@adoptapet.com">office@adoptapet.com</a> with the name "%s" and ID "%s".
                                    </div>', $row['name'], $row['name'], $row['petId']);
                                }

                        printf('
                                    </div>
                                </div>
                            </div>
                        </div>');
                    }
                } else {
                    echo('<div class="alert alert-danger text-center" role="alert"><h3>No data in database</h3></div>');
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