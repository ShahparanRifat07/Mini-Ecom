<?php

require('models/database.php');
require('models/user.php');


$result = NULL;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    $result = $user->loginUser($_POST);
}
session_start();
if (isset($_SESSION["LOGGEDIN"])) {
    header("location: index.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.css" rel="stylesheet" />
    <title>Mini-Ecom</title>
    <title>Document</title>
    <style>
        body {
            background-color: #e0e0e0;
        }

        #card1 {
            margin-left: auto;
            margin-right: auto;
        }

        .form-section {
            margin-top: 10vh;
            display: flex;
            justify-content: center;
            margin-bottom: 10vh;
        }

        .warning {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 25px;
            background: #E53935;
            margin: 10px 0px;
            border-radius: 5px;
            color: #fff;
        }

        .warning p {
            margin-top: 2vh;
        }

        .succesmsg {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 25px;
            background: #43A047;
            margin: 10px 0px;
            border-radius: 5px;
            color: #fff;
        }

        .succesmsg p {
            margin-top: 2vh;
        }
    </style>
</head>

<body>
    <?php include "utility/navbar.php" ?>


    <div id="card1" class="card mt-5 mb-5 p-3" style="width: 44rem;">



        <?php
        if ($result != "") {
        ?>
            <div class="warning">
                <p><?php echo $result ?></p>
            </div>

        <?php
        }
        ?>


        <form method="POST" action="">

            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" name="email" id="form3Example3" class="form-control" required />
                <label class="form-label" for="form3Example3">Email address</label>
            </div>



            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" name="password" id="form3Example4" class="form-control" required />
                <label class="form-label" for="form3Example4">Password</label>
            </div>


            <!-- Submit button -->
            <button type="submit" class="btn btn-dark btn-block mb-4">Sign up</button>

        </form>
    </div>


    <?php include "utility/footer.php" ?>


    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"></script>

</body>

</html>