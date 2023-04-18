<?php

define( 'DB_NAME', 'Artshare' );
define( 'DB_USER', 'Coral' );
define( 'DB_PASSWORD', ')78S]37r%V5u');
define( 'DB_HOST', 'localhost' );

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function isloggedin() {
    if (isset($_COOKIE['user'])) {
        return true;
    } else {
        return false;
    }
}

function startsession() {
    session_start();

    if(isloggedin()) {
        setusersession();
    } else {
        $_SESSION['user'] = false;
    }
}

function setusersession() {
    global $conn;
    
    $user = $_COOKIE['user'];
    
    $sql = "SELECT * FROM Member WHERE username = '$user';";
    $result = $conn->query($sql);

    $row = mysqli_fetch_assoc($result);

    $_SESSION['userid'] = $row['member_id'];
    $_SESSION['user'] = $row['username'];


    mysqli_close($conn);
}
