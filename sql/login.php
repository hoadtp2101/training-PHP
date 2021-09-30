<?php
session_start();
require_once "./lib/common.php";
require_once "./lib/db.php";
$loginToken = isset($_COOKIE['remember_login']) ? $_COOKIE['remember_login'] : "";
if ($loginToken != "") {
    $now = new DateTime();
    $currentTime = $now->format('Y-m-d H:i:s');
    $getUserByRememberToken = "select * from users 
                                where remember_token = '$loginToken'
                                    and remember_expire >= '$currentTime'";
    // var_dump($getUserByRememberToken);die;
    $user = executeQuery($getUserByRememberToken, false);
    if ($user) {
        unset($user['password']);
        $_SESSION['auth'] = $user;
        header('location: LoginSuccess.php');
        die;
    }
}
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
            Login form
        </h3>
        <?php if (isset($_GET['msg'])) : ?>
            <div class="text-center"><?= $_GET['msg'] ?></div>
        <?php endif ?>
        <form action="<?= BASE_URL ?>LoginPdo.php" method="post">
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label text-center">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="mail">
                    <?php if (isset($_GET['emailErr'])) : ?>
                        <span class="text-danger"><?= $_GET['emailErr'] ?></span>
                    <?php endif ?>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label text-center">Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="password">
                    <?php if (isset($_GET['passwordErr'])) : ?>
                        <span class="text-danger"><?= $_GET['passwordErr'] ?></span>
                    <?php endif ?>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label text-center">remember me</label>
                <div class="col-sm-6">
                    <input type="checkbox" name="remember" id="" value="1">
                </div>
            </div>
            <div class="col-12 text-center">
                <button class="btn btn-primary" type="submit">Login</button>
            </div>
        </form>
    </div>
</body>

</html>