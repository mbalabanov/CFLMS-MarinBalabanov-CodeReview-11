<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // it will never let you open index(login) page if session is set
    if( isset($_SESSION['user' ]) || isset($_SESSION['admin' ]) || isset($_SESSION['superadmin' ]) ) {
        header("Location: home.php");
        exit;
    }

    $error = false;
   
    if( isset($_POST['btn-login']) ) {
   
        // prevent sql injections/ clear user invalid inputs
        $email = trim($_POST['email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);

        $pass = trim($_POST[ 'pass']);
        $pass = strip_tags($pass);
        $pass = htmlspecialchars($pass);
        // prevent sql injections / clear user invalid inputs
    
        if(empty($email)){
            $error = true;
            $emailError = "Please enter your email address.";
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $error = true;
            $emailError = "Please enter valid email address.";
        }
    
        if (empty($pass)){
            $error = true;
            $passError = "Please enter your password." ;
        }

        // if there's no error, continue to login
        if (!$error) {
            $password = hash( 'sha256', $pass); // password hashing
            $res=mysqli_query($connect, "SELECT * FROM users WHERE userEmail='$email'" );
            $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
            $count = mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row

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
                $errMSG = "Incorrect Credentials, Try again..." ;
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

        <title>Adopt A Pet</title>
    </head>
    <body class="bg-white">

    <?php include('navbar.php'); ?>

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
                    <h2 class="text-primary">Welcome to Adopt A Pet</h2>
                    <p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="assets/dogs/dog4.jpg" class="img-fluid rounded-lg" alt="Cute Dogs">
                <h3 class="text-primary">Cute Dogs</h3>
                <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>
            </div>
            <div class="col-md-4 text-center">
                <img src="assets/cats/cat3.jpg" class="img-fluid rounded-lg" alt="Majestic Cats">
                <h3 class="text-primary">Majestic Cats</h3>
                <p>Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
            </div>
            <div class="col-md-4 text-center">
                <img src="assets/woman.jpg" class="img-fluid rounded-lg" alt="Happy New Owners">
                <h3 class="text-primary">Happy New Owners</h3>
                <p>Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>
            </div>
        </div>

        <div class="row mt-3" id="login-box">
            <div class="col-md-6 p-5 text-center text-white bg-secondary">
                <h4>Please register and login as a user to proceed.</h4>
                <p>For a <span class="badge badge-pill badge-warning">standard user</span> please use username <strong>test1@test.com</strong> and <strong>tatata</strong> as the password. For <span class="badge badge-pill badge-warning">admin</span> please use <strong>admin@admin.com</strong> and <strong>tatata</strong> as password.</p>
            </div>
            <div class="col-md-6 border bg-light p-5">
                <h4 class="text-center">Login</h4>
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
                            <input type="email" name="email" class="form-control" placeholder="Your email address" value="<?php echo $email; ?>"  maxlength="40" />
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
                        <div class="col-md-12 text-center">
                            <button class="btn btn-primary m-2" type="submit" name="btn-login">Login</button>
                            <a class="btn btn-secondary m-2" href="register.php">Go to registration</a>
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





