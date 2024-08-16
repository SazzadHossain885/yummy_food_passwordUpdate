<?php
session_start();
include("../database/env.php");

$user_id = $_SESSION["auth"]["id"];
$current_password = $_REQUEST["old_password"];
$new_password = $_REQUEST["new_password"];
$confirm_password = $_REQUEST["con_password"];

$errors = [];

if (empty($current_password)) {
    $errors["currentPasswordError"] = "Current Password is Required!";
}

if (empty($new_password)) {
    $errors["newPasswordError"] = "New Password is Required!";
} else if (strlen($new_password) < 8) {
    $errors["newPasswordError"] = "New Password should be greater or equal to 8 characters!";
} else if ($new_password !== $confirm_password) {
    $errors["confirmPasswordError"] = "New Password and Confirm Password does not match!";
}

// Error or Save To Database
if (count($errors) > 0) {
    $_SESSION["errors"] = $errors;
    header("Location: ../dashboard/Profile.php");
} else {
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        $encPassword = $user["password"];
        if (password_verify($current_password, $encPassword)) {
            $newEncPassword = password_hash($new_password, PASSWORD_BCRYPT);
            $query = "UPDATE users SET password='$newEncPassword' WHERE id = '$user_id'";
            $res = mysqli_query($connection, $query);
            if ($res) {
                $_SESSION["password"] = true;
                header("Location: ../dashboard/Profile.php");
            }
        } else {
            $errors["current_password_error"] = "Invalid Password!";
            $_SESSION["errors"] = $errors;
            header("Location: ../dashboard/Profile.php");
        }
    } else {
        $errors["user_error"] = "No user found!";
        $_SESSION["errors"] = $errors;
        header("Location: ../dashboard/Profile.php");
    }
}