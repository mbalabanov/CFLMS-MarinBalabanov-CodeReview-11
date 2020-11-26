<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // Prevents any users to access this action who are not superadmin
    if( !isset($_SESSION['superadmin' ]) ) {
        header("Location: index.php");
        exit;
    }

    // Selects details of users who are logged in
    $res=mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['superadmin']);
    $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);


    $error = false;

    // This receives the inputs in the registration fields, checks and sanitizes them.
    if ( isset($_POST['btn-signup']) ) {
    
    // Sanitize user's input to prevent SQL injection.
    $name = trim($_POST['name']);

    // Removes whitespace (or other characters) from the beginning and end of the user's name.
    $name = strip_tags($name);

    // Removes any HTML and PHP tags from the input.
    $name = htmlspecialchars($name);
    
    // Converts any special characters to HTML entities to prevent code injection.
    $email = trim($_POST[ 'email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $userImage = trim($_POST[ 'userimage']);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    // Basic validation of user's name.
    if (empty($name)) {
        $error = true ;
        $nameError = "Please enter your full name.";
    } else if (strlen($name) < 3) {
        $error = true;
        $nameError = "Name must have at least 3 characters.";
    } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true ;
        $nameError = "Name must contain alphabets and space.";
    }

    // Basic validation of email address.
    if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $error = true;
        $emailError = "Please enter valid email address." ;
    } else {

        // Checks if email address is already in use.
        $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
        if($count!=0){
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }

    // Validates the password and outputs messages.
    if (empty($pass)){
        $error = true;
        $passError = "Please enter password.";
    } else if(strlen($pass) < 6) {
        $error = true;
        $passError = "Password must have atleast 6 characters." ;
    }

    // Hashes the password before saving it to database.
    $password = hash('sha256' , $pass);

    // Continue registration unless there is an error.
    if( !$error ) {
        $query = "INSERT INTO users(userName,userEmail,userPass,userImage) VALUES('$name','$email','$password','$userImage')";
        $res = mysqli_query($connect, $query);

        if ($res) {
            $errTyp = "warning";
            $errMSG = "Successfully registered, please login.";
            unset($name);
            unset($email);
            unset($pass);
        } else  {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later..." ;
        }
    }

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

    <!-- The form to add users is in an accordion. -->
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
                                <div class="m-4 alert alert-primary">
                                    <?php include('forms/registrationform.php'); ?>

                                    <?php
                                        if ( isset($errMSG) ) {
                                    ?>

                                    <div class="alert alert-<?php echo $errTyp ?>" >
                                        <?php echo $errMSG; ?>
                                    </div>

                                    <?php
                                        }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Provides space for the error messages -->
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
                <table class="table border">
                    <thead>
                        <tr class="table-active">
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
                                $row['userImage'], $row['userName'], $row['userName'], $row['userEmail'], ucfirst($row['userType']), $row['userId'], $row['userId']);
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