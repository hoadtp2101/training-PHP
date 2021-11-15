<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once "./lib/db.php";
require_once "./lib/common.php";

$email = isset($_POST['mail']) ? $_POST['mail'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$remember = $_POST['remember'];

$emailErr = "";
$passwordErr = "";

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 255) {
    $emailErr = "Địa chỉ email không đúng hoặc rỗng hoặc vượt quá 255 kí tự";
}

$removeWhiteSpacePassword = str_replace(" ", "", $password);
if ((100 < strlen($password) || strlen($password) < 6) || (strlen($removeWhiteSpacePassword) != strlen($password))) {
    $passwordErr = "Mật khẩu không thỏa mãn đk (trong khoảng 6 - 100 ký tự và không chứa khoảng trắng)";
}

if ($emailErr . $passwordErr != "") {
    // require_once('register.php');
    header('location: ' . BASE_URL . "login.php?emailErr=$emailErr&passwordErr=$passwordErr");
    die;
}

$getUserByEmailQuery = "select * from users where mail = '$email'";
$user = executeQuery($getUserByEmailQuery, !true);

if ($user && password_verify($password, $user['password'])) {
    if ($remember == 1) {
        $remember_token = sha1(uniqid() . $user['mail']);

        $expireObj = new DateTime("+15 days");
        $expireTime = $expireObj->format("Y-m-d H:i:s");

        setcookie('remember_login', $remember_token, time() + (60 * 60 * 24 * 15), '/');

        $updateRememberQuery = "update users 
                                set 
                                    remember_token = '$remember_token', 
                                    remember_expire = '$expireTime'
                                where id = " . $user['id'];   
        executeQuery($updateRememberQuery, false);
    }
    unset($user['password']);
    $_SESSION['auth'] = $user;

    header('location: ' . BASE_URL . "LoginSuccess.php");
    die;
}

header("location: " . BASE_URL . "login.php?msg=Đăng nhập thất bại.");
