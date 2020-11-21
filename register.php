<?php
    ob_start();
    session_start();

    // if session is not set this will redirect to login page
    if( isset($_SESSION['user' ]) || isset($_SESSION['admin'])) {
        header("Location: index.php");
        exit;
    }

    include_once 'actions/db_connect.php';
    $error = false;
    if ( isset($_POST['btn-signup']) ) {
    
    // sanitize user input to prevent sql injection
    $name = trim($_POST['name']);

    //trim - strips whitespace (or other characters) from the beginning and end of a string
    $name = strip_tags($name);

    // strip_tags — strips HTML and PHP tags from a string
    $name = htmlspecialchars($name);
    
    // htmlspecialchars converts special characters to HTML entities
    $email = trim($_POST[ 'email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $userImage = trim($_POST[ 'userimage']);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    // basic name validation
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

    //basic email validation
    if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $error = true;
        $emailError = "Please enter valid email address." ;
    } else {
        // checks whether the email exists or not
        $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
        if($count!=0){
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }
    // password validation
    if (empty($pass)){
        $error = true;
        $passError = "Please enter password.";
    } else if(strlen($pass) < 6) {
        $error = true;
        $passError = "Password must have atleast 6 characters." ;
    }

    // password hashing for security
    $password = hash('sha256' , $pass);
    // if there's no error, continue to signup
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
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
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