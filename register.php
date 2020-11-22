<?php
    ob_start();
    session_start();

    // Sends logged in users to home with the pet list
    if( isset($_SESSION['user' ]) || isset($_SESSION['admin']) || isset($_SESSION['superadmin'])) {
        header("Location: home.php");
        exit;
    }

    include_once 'actions/db_connect.php';

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

        <title>Register | Adopt A Pet</title>
    </head>
    <body class="bg-light">

        <?php include('navbar.php'); ?>

        <div class="container my-5">
            <div class="row">
                <div class="col-8 offset-2 pt-2 alert alert-primary rounded-lg">
                    <h2 class="my-4 text-center">Register</h2>

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
                    <div class="row">
                        <div class="col-12 text-right">
                            <a class="btn btn-secondary" href="index.php#login-box">Back to home</a>
                        </div>
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