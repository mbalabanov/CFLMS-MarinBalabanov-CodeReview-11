<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin']) && !isset($_SESSION['superadmin'])) {
        header("Location: index.php");
        exit;
    }

    // select logged-in users details
    if($_SESSION['admin']) {
        $res = mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['admin']);
        $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    } elseif($_SESSION['superadmin']) {
        $res = mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['superadmin']);
        $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    }

    $sql = 'SELECT * FROM countries';
    $countryresults = $connect->query($sql);

    if ($_GET['id']) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM locations WHERE locationId = {$id}" ;
        $result = $connect->query($sql);
        $data = $result->fetch_assoc();
        $connect->close();
    }
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
        <h2 class="mt-5 text-center">Update an Existing Location</h2>
        <div class="row">
            <div class="col-12 text-center mb-2">
                <div class="m-4 alert alert-primary">
                    <form action="actions/a_updatelocation.php" method="post">
                        <div class="row my-2">
                            <div class="col-md-4 text-right"><label for="formlocationId">Location ID<br><span class="text-danger"><sup>(read only)</sup></span></label></div >
                            <div class="col-md-8"><input class="form-control text-danger" type="text" name="formlocationId"  value="<?php echo $data['locationId'] ?>" readonly /></div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-4 text-right"><label for="formstreet">Street Address</label></div >
                            <div class="col-md-8"><input class="form-control" type="text" name="formstreet"  value="<?php echo $data['street'] ?>" /></div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-4 text-right"><label for="formtown">Town/City</label></div>
                            <div class="col-md-8"><input class="form-control" type="text" name="formtown" value="<?php echo $data['town'] ?>" /></div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-4 text-right"><label for="formpostalcode">Postal Code</label></div>
                            <div class="col-md-8"><input class="form-control" type="text" name="formpostalcode" value="<?php echo $data['postalCode'] ?>" /></div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-4 text-right"><label for="formcountry">Country</label></div>
                            <div class="col-md-8">
                                <select class="form-control" name="formcountry" id="formcountry">
                                <?php

                                    if($countryresults->num_rows > 0) {
                                        while($row = mysqli_fetch_assoc($countryresults)) {

                                            if($data['country'] == $row['countryId']) {
                                                printf('<option value ="%s" selected>%s</option>',
                                                $row['countryId'], $row['CountryName']);
                                            } else {
                                                printf('<option value ="%s">%s</option>',
                                                $row['countryId'], $row['CountryName']);
                                            }
                                        }
                                    } else {
                                        echo('<div class="alert alert-danger text-center" role="alert"><h3>No countries in database</h3></div>');
                                    }
                                ?>
                                </select>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary my-2" type ="submit">Update location</button><br><a class="btn btn-secondary my-2" href="locations.php">Back to Locations</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

  </body>
</html>
<?php ob_end_flush(); ?>

