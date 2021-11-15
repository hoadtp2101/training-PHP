<?php
session_start();
require_once "./lib/common.php";
require_once "./lib/db.php";

// Nhận dữ liệu từ request
$name = trim($_POST['name']);
$nameErr = "";

$email = $_POST['mail'];
$emailErr = "";

$password = $_POST['password'];
$passwordErr = "";

$cfpassword = $_POST['cfpassword'];
$cfpasswordErr = "";

$phone = $_POST['phone'];
$phoneErr = "";

$address = $_POST['address'];
$addressErr = "";

// Kiểm tra name
if (strlen($name) == 0) {
    $nameErr = "Không để trống";
}

if ($nameErr === "" && (strlen($name) < 6 || strlen($name) > 200)) {
    $nameErr = "Độ dài họ và tên nằm trong khoảng 6 - 200 ký tự";
}

//Kiểm tra email
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 255) {
    $emailErr = "Địa chỉ email không đúng hoặc rỗng hoặc vượt quá 255 kí tự";
}

// Kiểm tra password và password confirm
$removeWhiteSpacePassword = str_replace(" ", "", $password);
if ((100 < strlen($password) || strlen($password) < 6) || (strlen($removeWhiteSpacePassword) != strlen($password))) {
    $passwordErr = "Mật khẩu không thỏa mãn đk (trong khoảng 6 - 100 ký tự và không chứa khoảng trắng)";
}

if ($password != $cfpassword) {
    $cfpasswordErr = "Mật khẩu và xác nhận mật khẩu không khớp";
}

if (10 > strlen($phone) || strlen($phone) > 20) {
    $phoneErr = "Trong khoảng từ 10 - 20 kí tự";
}

if (strlen($address) == 0) {
    $addressErr = "Không để trống";
}

if ($nameErr . $emailErr . $passwordErr . $cfpasswordErr . $phoneErr . $addressErr != "") {
    // require_once('register.php');
    header('location: ' . BASE_URL . "register.php?nameErr=$nameErr&emailErr=$emailErr&passwordErr=$passwordErr&cfpasswordErr=$cfpasswordErr&phoneErr=$phoneErr&addressErr=$addressErr");
    die;
}

// Xử lí
$hashPassword = password_hash($password, PASSWORD_DEFAULT);
$insertQuery = "insert into users (mail, name, password, phone, address)
                                values ('$email', '$name', '$hashPassword', '$phone', '$address')
                    ";

$connect = getDBConnect();
$stmt = $connect->prepare($insertQuery);
$stmt->execute();

header("location: " . BASE_URL . "login.php");
