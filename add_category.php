<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/admin.php");
require_once("models/category.php");

session_start();

$id = $_SESSION['USERID'];

$admin = new Admin();
if ($admin->is_admin($id) == false) {
    header("location: no_access.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cat = new Category();
    $_POST['id'] = $_SESSION['USERID'];
    $cat->addCategory($_POST, $_FILES);
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="css/main.css" rel="stylesheet"> -->
    <link href="css/instructor.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />
    <!-- <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> -->

    <style>
        body {
            background-color: #e0e0e0;
        }

        .dropdown-menu {
            max-height: 280px;
            overflow-y: auto;
            /* border: 1px solid red; */
        }

        .select {
            height: 30px;
            /* border: 1px solid red; */
            text-align: center;
            border-radius: 5px;
        }
        #catCard{
            margin-left: auto;
            margin-right: auto;
            border-radius: 0;
            margin-top: 0;
        }
        #cardHeader{
            margin-left: auto;
            margin-right: auto;
            width: 70rem;
            margin-bottom: 0;
            text-align: center;
        }
    </style>

</head>

<body>

    <?php include "utility/admin_navbar.php" ?>



    <div id="cardHeader" class="mt-5">
        <h2 class="bg-dark text-light p-3">ADD CATEGORY</h2>
    </div>


    <div id="catCard" class="card p-4 mb-5" style="width:70rem;">
        <form method="POST" action="" enctype="multipart/form-data">

            <!-- Text input -->
            <div class="form-outline mb-4">
                <input name="title" type="text" id="form6Example3" class="form-control" required />
                <label class="form-label" for="form6Example3">Category Name</label>
            </div>

            <!-- Text input -->
            <div class="form-outline mb-4">
                <textarea id="form6Example3" class="form-control" rows="8" name="description"></textarea>
                <label class="form-label" for="form6Example3">Description</label>
            </div>

            <label class="form-label" for="customFile">Upload Photo</label>
            <input name="picture" type="file" class="form-control" id="customFile" required />

            <hr>

            <!-- Submit button -->
            <button name="submit" type="submit" class="btn btn-dark btn-block mb-4">Save</button>
        </form>
    </div>


    <?php include "utility/footer.php" ?>

    <script type="text/javascript" src="js/main.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>

</html>