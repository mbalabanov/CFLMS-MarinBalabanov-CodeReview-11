<?php 
    ob_start();
    session_start();

    require_once 'actions/db_connect.php';

    // Prevents any users to access this action who are not superadmin
    if( !isset($_SESSION['admin']) && !isset($_SESSION['superadmin'])) {
        header("Location: index.php");
        exit;
    }

    // Selects details of users who are logged in
    if($_SESSION['admin']) {
        $res = mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['admin']);
        $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    } elseif($_SESSION['superadmin']) {
        $res = mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['superadmin']);
        $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    }

    // Gets the locations table and joins it with the countries table for a complete location address to populate the select options list.
    $sql = 'SELECT locations.locationId, locations.street, locations.town, locations.postalCode, locations.country, countries.CountryName FROM locations INNER JOIN countries ON locations.country = countries.countryId;';
    $countrylist = $connect->query($sql);

    // Gets the ID in the URL and pulls the relevant pet entry from the database.
    if ($_GET['id']) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM pets WHERE petId = {$id}" ;
        $result = $connect->query($sql);
        $data = $result->fetch_assoc();
        $connect->close();
    }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Edit Pet Entry | Adopt A Pet</title>

</head>
<body class="bg-light">

<?php include('navbar.php'); ?>

<div class="container my-4">
    <div class="row mt-3 ">
        <div class="col-8 offset-2 pt-2 alert alert-primary rounded-lg">
            <h3 class="mt-2 text-center">Edit Pet Entry</h3>

            <!-- This form provides the input fields to update an existing pet entry. -->
            <form action="actions/a_update.php" method="post">
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formpetid">Pet ID<br><span><sup class="text-danger">(read only)</sup></span></label></div >
                    <div class="col-md-8"><input class="form-control text-danger" type="text" name="formpetid"  value="<?php echo $data['petId'] ?>" readonly /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formname">Name</label></div >
                    <div class="col-md-8"><input class="form-control" type="text" name="formname"  value="<?php echo $data['name'] ?>" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formimage">Image URL</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="formimage" value="<?php echo $data['image'] ?>" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formtype">Type<br><sup>(e.g. dog, cat, etc.)</sup></label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="formtype" value="<?php echo $data['type'] ?>" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formdescription">Description</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="formdescription" value="<?php echo $data['descriptions'] ?>" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formhobbies">Hobbies</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="formhobbies" value="<?php echo $data['hobbies'] ?>" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formage">Age</label></div>
                    <div class="col-md-8"><input class="form-control" type="number" name="formage" value="<?php echo $data['age'] ?>" /></div>
                </div>

                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formlocation">Location</label></div>
                    <div class="col-md-8">
                        <select name="formlocation" class="form-control" id="formlocation">

                            <!-- This renders the location and country data into the select options list. -->
                            <?php
                                if($countrylist->num_rows > 0) {
                                    while($row = mysqli_fetch_assoc($countrylist)) {
                                        if($data['location'] == $row['locationId']) {
                                            printf('<option value="%s" selected>%s, %s %s, %s</option>',
                                            $row['locationId'], $row['street'], $row['postalCode'], $row['town'], $row['CountryName']);
                                        } else {
                                            printf('<option value="%s">%s, %s %s, %s</option>',
                                            $row['locationId'], $row['street'], $row['postalCode'], $row['town'], $row['CountryName']);
                                        }
                                    }
                                } else {
                                    echo('<option value="1">No location in database</option>');
                                }
                            ?>

                        </select>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-12 text-right">
                        <button class="btn btn-primary m-2" type ="submit">Update Entry</button><br><a class="btn btn-secondary m-2" href="index.php">Back to pet list</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div >

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>