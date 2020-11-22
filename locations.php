<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // Prevents any users to access this action who are not admin or superadmin
    if( !isset($_SESSION['admin' ]) && !isset($_SESSION['superadmin']) ) {
        header("Location: index.php");
        exit;
    }

    // Selects details of users who are logged in
    if($_SESSION['admin']) {
        $res=mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['admin']);
        $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    } elseif ($_SESSION['superadmin']) {
        $res=mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['superadmin']);
        $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    } 

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="css/bootstrap.min.css">

        <title>Adopt A Pet</title>
    </head>
    <body class="bg-light">

    <?php include('navbar.php'); ?>

    <div class="container">
        <h2 class="mt-5 text-center">List of Locations</h2>
        
        <!-- The form to create a new location entry is in an accordion. -->
        <div class="row">
            <div class="col-12 text-center mb-2">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    New Location
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="m-4 alert alert-primary">
                                    <?php include('forms/locationform.php'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- This renders the location data into a table.
             Locations cannot be deleted, because they are used as a foreign key in the pets table.
             This is not a terrible issue, because admins can change existing locations or assign pets to different locations. -->
        <div class="row my-3">
            <div class="col-md-12">
                <table class="table border">
                    <thead>
                        <tr class="table-active">
                            <th scope="col">Street Address</th>
                            <th scope="col">Town/City</th>
                            <th scope="col">Postal Code</th>
                            <th scope="col">Country Name</th>
                            <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                    $sql = 'SELECT locations.locationId, locations.street, locations.town, locations.postalCode, locations.country, countries.CountryName FROM locations INNER JOIN countries ON locations.country = countries.countryId;';

                    $result = $connect->query($sql);

                    if($result->num_rows > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            printf('
                                <tr>
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
                                        %s
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm mx-2" href="updatelocation.php?id=%s">Edit</a>
                                    </td>
                                </tr>',
                                $row['street'], $row['town'], $row['postalCode'], $row['CountryName'], $row['locationId']);
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

    <?php include('footer.php'); ?>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

  </body>
</html>
<?php ob_end_flush(); ?>