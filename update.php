<?php 
    ob_start();
    session_start();

    require_once 'actions/db_connect.php';

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['user' ]) ) {
        header("Location: index.php");
        exit;
    }

    // select logged-in users details
    $res=mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
    $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);

    if ($_GET['id']) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM media WHERE media_id = {$id}" ;
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

    <title>Edit media | Big Library</title>

</head>
<body class="bg-light">

<?php include('navbar.php'); ?>

<div class="container my-4">
    <div class="row mt-3 ">
        <div class="col-8 offset-2 pt-2 alert alert-primary rounded-lg">
            <h3 class="mt-2 text-center">Edit Media</h3>
            <form action="actions/a_update.php" method="post">

                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formmedia_id">Media ID<br><sup>(read only)</sup></label></div >
                    <div class="col-md-8"><input class="form-control" type="text" name="formmedia_id"  value="<?php echo $data['media_id'] ?>" readonly /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formimage">Media Title</label></div >
                    <div class="col-md-8"><input class="form-control" type="text" name="formtitle"  value="<?php echo $data['title'] ?>" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formimage">Image URL</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="formimage" value="<?php echo $data['image'] ?>" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formauthor_first_name">Author First Name</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="formauthor_first_name" value="<?php echo $data['author_first_name'] ?>" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formauthor_last_name">Author Last Name</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="formauthor_last_name" value="<?php echo $data['author_last_name'] ?>" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formisbn_code">ISBN Code</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="formisbn_code" value="<?php echo $data['isbn_code'] ?>" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formshort_description">Short Description</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="formshort_description" value="<?php echo $data['short_description'] ?>" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formpublish_date">Publishing Year</label></div>
                    <div class="col-md-8"><input class="form-control" type="number" name="formpublish_date" value="<?php echo $data['publish_date'] ?>" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formpublisher_name">Publisher's Name</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="formpublisher_name" value="<?php echo $data['publisher_name'] ?>" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formpublisher_address">Publisher's Address</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="formpublisher_address" value="<?php echo $data['publisher_address'] ?>" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formpublisher_size">Publisher Size</label></div>
                    <div class="col-md-8">
                        <select name="formpublisher_size" class="form-control" id="publisher_size">
                            <option>Choose publisher size...</option>
                            <option value="Book" <?php if ($data['publisher_size']=='big') echo 'selected';?> >big</option>
                            <option value="CD" <?php if ($data['publisher_size']=='medium') echo 'selected';?> >medium</option>
                            <option value="DVD" <?php if ($data['publisher_size']=='small') echo 'selected';?> >small</option>
                        </select>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4 text-right"><label for="formmedia_type">Media Type</label></div>
                    <div class="col-md-8">
                        <select name="formmedia_type" class="form-control" id="media_type">
                            <option>Choose media type</option>
                            <option value="Book" <?php if ($data['media_type']=='Book') echo 'selected';?> >Book</option>
                            <option value="CD" <?php if ($data['media_type']=='CD') echo 'selected';?> >CD</option>
                            <option value="DVD" <?php if ($data['media_type']=='DVD') echo 'selected';?> >DVD</option>
                        </select>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-4">
                    </div>
                    <div class="col-8 text-center">
                        <button class="btn btn-primary m-2" type ="submit">Update media</button><a class="btn btn-secondary m-2" href="index.php">Back to library</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div >

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>