<?php
    ob_start();
    session_start();

    require_once 'actions/db_connect.php';

    // Prevents any users to access this action who are not admin or superadmin
    if( !isset($_SESSION['admin' ]) && !isset($_SESSION['superadmin']) ) {
        header("Location: index.php");
        exit;
    }

    // Selects details of users who are logged in.
    if($_SESSION['admin']) {
        $res = mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['admin']);
        $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    } elseif($_SESSION['superadmin']) {
        $res = mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['superadmin']);
        $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    }

    // Gets the ID in the URL and pulls the relevant user data from the database.
    if ($_GET['id']) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM pets WHERE petId={$id}" ;
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

    <title>Delete Entry | Adopt A Pet</title>

</head>
<body class="bg-light">

<!-- Asks user to confirm delete and if confirmed passes the pet data to delete action. -->
<div class="container my-4">
    <div class="row pt-2">
        <div class="col-12">
            <div class="alert alert-danger p-4 text-center pb-4" role="alert">
                <h3 class="mt-2">Do you really want to delete '<?php echo $data['name'] ?>'?</h3>
                <form action ="actions/a_delete.php" method="post">
                    <input type="hidden" name= "id" value="<?php echo $data['petId'] ?>" />
                    <button class="btn btn-danger" type="submit">Delete</button >
                    <a class="btn btn-secondary" href="index.php">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div >

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>