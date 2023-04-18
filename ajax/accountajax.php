<?php

/* Account functions
 * - Login, logout
 * - Signup
 * - Display user information
 */

define( 'DB_NAME', 'Artshare' );
define( 'DB_USER', 'Coral' );
define( 'DB_PASSWORD', ')78S]37r%V5u');
define( 'DB_HOST', 'localhost' );

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Login function

function isvalid ($user, $pass) {	
    global $conn;

    $sql = "SELECT * FROM Member WHERE username = '$user' AND passwrd = '$pass'";
    $result = $conn->query($sql);

    if (mysqli_num_rows($result) == 0) {
        return false;
    } else {
        return true;
    }	
}

function login() {
    if(isvalid($_POST['user'], $_POST['pass'])) {
        session_destroy();
        setcookie("user",$_POST['user'],time() + (86400 * 30), "/");
        echo '1';
    } else {
        logout();
        echo '0';
    }
}

function logout() {
    session_destroy();
    setcookie("user","", time() - 3600, "/");
    echo '1';
}

// Signup

function signup() {
    $user = $_POST['newuser'];
    $pass = $_POST['newpass'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];

    global $conn;
    
    $sql = "SELECT username FROM Member WHERE username = '$user';";
    $result = $conn->query($sql);
    
    if (mysqli_num_rows($result) > 0) {
        echo '1';
        return;
    }

    $insert = "INSERT INTO Member (member_id, username, passwrd, e_mail, birthday, join_date) VALUES (1000, '$user', '$pass','$email','$dob', curdate());";
    $result = $conn->query($insert);

    $sql = "SELECT username FROM Member WHERE username = '$user';";
    $result = $conn->query($sql);
    
    if (mysqli_num_rows($result) == 0) {
        echo '2';
        return;
    }

    session_destroy();
    setcookie("user",$user,time() + (86400 * 30), "/");
    echo '3';
}

$cmd = $_POST['cmd'];

if($cmd == 'login') {
    login();
} else if ($cmd == 'logout') {
    logout();
} else if ($cmd == 'signup') {
    signup();
}

mysqli_close($conn);