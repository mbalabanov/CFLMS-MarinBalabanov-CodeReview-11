<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // Prevent users to access this page without a login
    if( !isset($_SESSION['user' ]) && !isset($_SESSION['admin' ]) && !isset($_SESSION['superadmin' ]) ) {
        header("Location: index.php");
        exit;
    }

    // Selects details of users who are logged in
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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <title>Adopt A Pet</title>
    </head>
    <body class="bg-light">

    <?php include('navbar.php'); ?>

    <div class="container">
        <h2 class="mt-5 text-center">Welcome to Adopt A Pet</h2>
        <p class="text-center">Write to us at <a href="mailto:office@adoptapet.com">office@adoptapet.com</a> if you want to adopt a pet. Pets older than eight years, have their <span class="text-danger">age marked red.</span></p>
        
        <!-- The form to create a new pet entry is in an accordion. -->
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

        <!-- The live search input field calls on the action a_petslivesearch. User inputs are routed to the JS function at the bottom of this source. -->
        <form id="livesearch">
            <div class="row my-4 alert alert-primary p-4 rounded-lg border">
                <label for="searchfield" class="col-sm-2 col-form-label text-right">Filter</label>
                <div class="col-sm-10">
                    <input class="form-control" id="searchfield" name="searchfield" type="text" value="" placeholder="Start typing pet's name..."/>
                </div>
            </div>
        </form>

        <div class="row mb-5 alert alert-warning pb-4 rounded-lg border" id="petsearch">

            <!-- Initially renders the list of all pet entries when the page is loaded.
                 Subsequent pet entries are rendered based on the live search. -->
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

                                // As per the project requirements, the age of the pet is checked and emphasized.
                                if($row['age'] > 7) {
                                    printf('<span class="text-danger"><strong>%s</strong> years old</span></p>',
                                    $row['age']);
                                } else {
                                    printf('<strong>%s</strong> years old</p>',
                                    $row['age']);
                                }

                                printf('<p class="card-text"><strong>Description:</strong> %s<br/><strong>Hobbies:</strong> %s<br/><strong>Location:</strong> %s, %s %s, %s</p>'
                                , $row['descriptions'], $row['hobbies'], $row['street'], $row['postalCode'], $row['town'], $row['CountryName']);

                                // Admins and Superadmins see the options to edit or delete pet entries.
                                // Regular users see the message on how to apply to adopt the pet.
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

    <script>

        // Variable holds the search request
        let searchrequest;

        /* Function for search term check on keyup */
        $("#searchfield").keyup(function(event){

            // Holds the data of the searchfield in this form
            var $form = $(this);

            // Selects and stores input in the searchfield
            var $inputs = $form.find("input");

            // Serializes the data in the searchfield
            var serializedData = $form.serialize();

            // Sends the search request to the livesearch action
            searchrequest = $.ajax({
                url: "actions/a_petslivesearch.php",
                type: "post",
                data: serializedData
            });

            // Receives the callback on success and inserts the search results in the pet list
            searchrequest.done(function (response, textStatus, jqXHR){
                document.getElementById("petsearch").innerHTML=response;
            });

            // Receives the callback on failure and outputs to the console
            searchrequest.fail(function (jqXHR, textStatus, errorThrown){
                console.error(
                    "This error has occured: "+
                    textStatus, errorThrown
                );
            });

            // Any callback reactivates the input field
            searchrequest.always(function () {
                $inputs.prop("disabled", false);
            });
        });

    </script>

  </body>
</html>
<?php ob_end_flush(); ?>