<?php
    ob_start();
    session_start();

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['user']) && !isset($_SESSION['admin']) && !isset($_SESSION['superadmin']) ) {
        header("Location: index.php");
        exit;
    }



// You can access the values posted by jQuery.ajax
// through the global variable $_POST, like this:
$searchfield = isset($_POST['searchfield']) ? $_POST['searchfield'] : null;

// var_dump($formmail);
$host= "localhost";
$username="root";
$password="";
$dbname="cflms-marinbalabanov-codereview-11";

$conn = mysqli_connect($host,$username,$password,$dbname);

if($conn){
   // echo "success";
}

$sql = "SELECT pets.petId, pets.name, pets.image, pets.type, pets.age, pets.descriptions, pets.hobbies, locations.street, locations.town, locations.postalCode, countries.CountryName FROM pets, locations, countries WHERE pets.location = locations.locationId AND locations.country = countries.countryId AND pets.name LIKE '{$searchfield}%';";
$result = $conn->query($sql);

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
    echo('<h4 class="mx-4 mt-3"><strong>No search results</strong></h4>');
}
?>