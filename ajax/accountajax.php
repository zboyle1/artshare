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

function showpro() {
    global $conn;

    $user = $_POST['user'];

    $sql = "SELECT * FROM Member WHERE username = '$user'";
    $result = $conn->query($sql);

    if(mysqli_num_rows($result) == 0) {
        echo '<div class ="cell"><div class ="callout">User not found</div></div>';
    } else {
        $row = mysqli_fetch_assoc($result);

        $username = $row['username'];
        $email = $row['e_mail'];
        $birthday = $row['birthday'];
        $join = $row['join_date'];
        $about = $row['about'];

        $age = date_diff(date_create($birthday), date_create('now'))->y;

        echo '<div class = "cell large-6 medium-6 small-6">' .
             '<h3 class="subheader">User Information</h3>' .
             '<table>' .
             '<tr>' .
             '<td><b>Username:</b></td>' .
             '<td>' . $username . '</td>' .
             '</tr>' .
             '<tr>' .
             '<td><b>Email:</b></td>' .
             '<td>' . $email . '</td>' .
             '</tr>' .
             '<tr>' .    
             '<td><b>Age:</b></td>' .
             '<td>' . $age . '</td>' .
             '</tr>' .
             '<tr>' .    
             '<td><b>Join date:</b></td>' .
             '<td>' . $join . '</td>' .
             '</tr>' .
             '</table>' .
             '</div>' .

             '<div class = "cell large-6 medium-6 small-6">' .
             '<h3 class="subheader">About </h3>' .
             '<div class = "callout" id="about">'. 
             $about .
             '</div>' .
             '</div>';
    }

}

$cmd = $_POST['cmd'];

if($cmd == 'login') {
    login();
} else if ($cmd == 'logout') {
    logout();
} else if ($cmd == 'signup') {
    signup();
} else if ($cmd == 'showpro') {
    showpro();
}

mysqli_close($conn);