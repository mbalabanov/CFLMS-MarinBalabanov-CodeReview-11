<?php 
    ob_start();
    session_start();

    require_once 'actions/db_connect.php';

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin' ]) ) {
        header("Location: index.php");
        exit;
    }

    // select logged-in users details
    $res=mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['admin']);
    $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);

    if ($_GET['id']) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE userId = {$id}" ;
        $result = $connect->query($sql);
        $data = $result->fetch_assoc();
        $connect->close();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Edit user | Adopt A Pet</title>

</head>
<body class="bg-light">

<?php include('navbar.php'); ?>

<div class="container my-4">
    <div class="row mt-3 ">
        <div class="col-8 offset-2 pt-2 alert alert-primary rounded-lg">
            <h3 class="mt-2 text-center">Edit User</h3>
            <form action="actions/a_adminupdate.php" method="post">

                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formuserId">User ID (read only)</label></div >
                    <div class="col-md-8"><input class="form-control" type="text" name="formuserId"  value="<?php echo $data['userId'] ?>" readonly /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formuserName">User's Name</label></div >
                    <div class="col-md-8"><input class="form-control" type="text" name="formuserName"  value="<?php echo $data['userName'] ?>" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formuserEmail">User's Email Address</label></div >
                    <div class="col-md-8"><input class="form-control" type="text" name="formuserEmail"  value="<?php echo $data['userEmail'] ?>" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formuserImage">Image URL</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="formuserImage" value="<?php echo $data['userImage'] ?>" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formuserType">User Type</label></div>
                    <div class="col-md-8">
                        <select name="formuserType" class="form-control" id="userType">
                            <option>Choose user type...</option>
                            <option value="admin" <?php if ($data['userType']=='admin') echo 'selected';?> >admin</option>
                            <option value="user" <?php if ($data['userType']=='user') echo 'selected';?> >user</option>
                        </select>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-4">
                    </div>
                    <div class="col-8 text-center">
                        <button class="btn btn-primary m-2" type ="submit">Update user</button><a class="btn btn-secondary m-2" href="admin.php">Back to admin UI</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div >

<?php include('footer.php'); ?>

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>