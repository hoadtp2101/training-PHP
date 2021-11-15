<?php
session_start();
require_once "./lib/common.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h3 class="text-center">
            Register form
        </h3>
        <form class="row g-3 needs-validation" method="POST" action="<?= BASE_URL ?>RegisterPdo.php">
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" name="mail">
                <?php if (isset($_GET['emailErr'])) : ?>
                    <span class="text-danger"><?= $_GET['emailErr'] ?></span>
                <?php endif ?>
            </div>
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name">
                <?php if (isset($_GET['nameErr'])) : ?>
                    <span class="text-danger"><?= $_GET['nameErr'] ?></span>
                <?php endif ?>
            </div>
            <div class="col-md-6">
                <div class="col-md-12">
                    <label class="form-label">Password </label>
                    <input type="password" name="password" class="form-control">
                    <?php if (isset($_GET['passwordErr'])) : ?>
                        <span class="text-danger"><?= $_GET['passwordErr'] ?></span>
                    <?php endif ?>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Password confirm </label>
                    <input type="password" name="cfpassword" class="form-control">
                    <?php if (isset($_GET['cfpasswordErr'])) : ?>
                        <span class="text-danger"><?= $_GET['cfpasswordErr'] ?></span>
                    <?php endif ?>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control">
                    <?php if (isset($_GET['phoneErr'])) : ?>
                        <span class="text-danger"><?= $_GET['phoneErr'] ?></span>
                    <?php endif ?>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label">Address</label>
                <textarea name="address" cols="30" rows="7" class="form-control"></textarea>
                <?php if (isset($_GET['addressErr'])) : ?>
                    <span class="text-danger"><?= $_GET['addressErr'] ?></span>
                <?php endif ?>
            </div>

            <div class="col-12 text-center">
                <button class="btn btn-primary" type="submit">Register</button>
            </div>
        </form>
</body>
</div>

</html>