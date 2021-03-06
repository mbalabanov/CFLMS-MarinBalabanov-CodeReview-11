<?php
    ob_start();
    session_start();

    require_once 'actions/db_connect.php';

    // Prevents any users to access this action who are not superadmin
    if( !isset($_SESSION['superadmin' ]) ) {
        header("Location: index.php");
        exit;
    }

    // Selects details of users who are logged in.
    // Since only Superadmin users can access this page, only their data is queried
    $res=mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['superadmin']);
    $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);

    // Gets the ID in the URL and pulls the relevant user data from the database. 
    if ($_GET['id']) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE userId={$id}" ;
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

    <title>Delete user | Adopt A Pet</title>

</head>
<body class="bg-light">

<div class="container my-4">
    <div class="row pt-2">

        <!-- Asks user to confirm delete and if confirmed passes the user data to delete action. -->
        <div class="col-12">
            <div class="alert alert-danger p-4 text-center pb-4" role="alert">
                <h3 class="mt-2">Do you really want to delete '<?php echo $data['userName'] ?>'?</h3>
                <form action ="actions/a_admindelete.php" method="post">
                    <input type="hidden" name= "id" value="<?php echo $data['userId'] ?>" />
                    <button class="btn btn-danger" type="submit">Delete</button >
                    <a class="btn btn-secondary" href="admin.php">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div >

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>