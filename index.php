<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // Sends logged in users to home with the pet list
    if( isset($_SESSION['user' ]) || isset($_SESSION['admin' ]) || isset($_SESSION['superadmin' ]) ) {
        header("Location: home.php");
        exit;
    }

    $error = false;

    // This recieves the inputs in the login fields, checks and sanitizes them.
    if( isset($_POST['btn-login']) ) {
   
        // Prevent SQL injections and clears the inputs from invalid text.
        $email = trim($_POST['email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);

        $pass = trim($_POST[ 'pass']);
        $pass = strip_tags($pass);
        $pass = htmlspecialchars($pass);

        // Validates inputs and displays error messages    
        if(empty($email)){
            $error = true;
            $emailError = '<div class="alert alert-danger my-1" role="alert">Please enter your email address.</div>';
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $error = true;
            $emailError = '<div class="alert alert-danger my-1" role="alert">Please enter valid email address.</div>';
        }
    
        if (empty($pass)){
            $error = true;
            $passError = '<div class="alert alert-danger my-1" role="alert">Please enter your password.</div>';
        }

        // Continue to login unless there is an error
        if (!$error) {
            // Hashes the password
            $password = hash( 'sha256', $pass);
            $res=mysqli_query($connect, "SELECT * FROM users WHERE userEmail='$email'" );
            $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
            // If username and password are correct, this counts if there are multiple row entries
            $count = mysqli_num_rows($res);
            if( $count == 1 && $row['userPass' ]==$password ) {
                if($row['userType']=='admin'){
                    $_SESSION['admin'] = $row['userId'];
                    header( "Location: home.php");
                } elseif ($row['userType']=='superadmin'){
                    $_SESSION['superadmin'] = $row['userId'];
                    header( "Location: admin.php");
                } else {
                    $_SESSION['user'] = $row['userId'];
                    header( "Location: index.php");
                }
            } else {
                $errMSG = '<div class="alert alert-danger my-1" role="alert">Incorrect Credentials, Try again...</div>';
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
    <body class="bg-white">

    <?php include('navbar.php'); ?>

    <!-- Adopt A Pet Intro video (embedded as responsive Youtube video) -->
    <div class="row">
        <div class="col-12 border">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/rf_reiVro4A" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                    <h2 class="text-warning">Welcome to Adopt A Pet</h2>
                    <p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="assets/dogs/dog4.jpg" class="img-fluid rounded-lg" alt="Cute Dogs">
                <h3 class="text-warning">Cute Dogs</h3>
                <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>
            </div>
            <div class="col-md-4 text-center">
                <img src="assets/cats/cat3.jpg" class="img-fluid rounded-lg" alt="Majestic Cats">
                <h3 class="text-warning">Majestic Cats</h3>
                <p>Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
            </div>
            <div class="col-md-4 text-center">
                <img src="assets/woman.jpg" class="img-fluid rounded-lg" alt="Happy New Owners">
                <h3 class="text-warning">Happy New Owners</h3>
                <p>Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>
            </div>
        </div>

        <div class="row mt-3" id="login-box">
            <div class="col-md-6 p-5 text-center text-white bg-secondary">
                <h4>Please register and login as a user to proceed.</h4>
                <p>For a <span class="badge badge-pill badge-warning">standard user</span> please use username <strong>test1@test.com</strong> and <strong>tatata</strong> as the password. For <span class="badge badge-pill badge-warning">admin</span> please use <strong>admin@admin.com</strong> and <strong>tatata</strong> as password. For <span class="badge badge-pill badge-warning">superadmin</span> please use <strong>superadmin@admin.com</strong> and <strong>tatata</strong> as password.</p>
            </div>
            <div class="col-md-6 border bg-light p-5">
                <h4 class="text-center">Login</h4>

                <!-- Provides space for error messages -->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
                    <?php
                        if ( isset($errMSG) ) {
                        echo  $errMSG;
                    ?>
                    <?php } ?>
                    <div class="row my-2">
                        <div class="col-md-4 text-right">
                            <label for="email">Email Address</label>
                        </div>
                        <div class="col-md-8">
                            <input type="email" name="email" class="form-control" placeholder="Your email address" value="<?php echo $email; ?>" maxlength="40" />
                            <span class="text-danger"><?php  echo $emailError; ?></span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-4 text-right">
                            <label for="pass">Password</label>
                        </div>
                        <div class="col-md-8">
                            <input type="password" name="pass"  class="form-control" placeholder="Your password" maxlength="15"  />
                            <span class="text-danger"><?php  echo $passError; ?></span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary my-2" type="submit" name="btn-login">Login</button><br/>
                            <a href="register.php">Go to registration</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 p-0">
                <img src="assets/dogs.jpg" alt="Adopt A Pet" class="img-fluid">
            </div>
            <div class="col-md-6 p-5 text-center text-white bg-secondary">
                <h4>Lorem ipsum dolor sit ame</h4>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo. Inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                <img src="assets/adopt-a-pet-logo/adopt-a-pet-logo.png" width="200px" alt="Adopt A Pet" loading="lazy" class="m-2">
            </div>
        </div>
        
        <!-- Animaged HTML5 banner advertising Adopt A Pet --> 
        <div class="row">
            <div class="col-md-12 text-center">
                <div id="header_hype_container" class="HYPE_document img-fluid rounded-lg" style="margin:auto;position:relative;width:100%;height:100%;overflow:hidden;">
                    <script type="text/javascript" charset="utf-8" src="assets/animated-header/header.hyperesources/header_hype_generated_script.js?57091"></script>
                </div>
                <h3>Ut enim ad minima, ut aliquid consequatur?</h3>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

  </body>
</html>
<?php ob_end_flush(); ?>





