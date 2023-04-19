<?php
include 'functions.php';

if (session_status() == PHP_SESSION_NONE) {
    startsession();
}

function guest_nav() {
    echo <<<GUESTLINKS
    <ul class="vertical menu">
    <li><a href="/artshare/index.php">Home</a></li>
    <li><a href="/artshare/places/login.php">Login</a></li>
    <li><a href="/artshare/places/signup.php">Sign Up</a></li>
    </ul>
GUESTLINKS;
}

function user_nav() {
    echo <<<USERLINKS
    <ul class="vertical menu">
    <li><a href="/artshare/index.php">Home</a></li>
    <li><a href="/artshare/places/profile.php?user={$_SESSION['user']}">Profile</a></li>
    <li><a href="/artshare/places/submit.php">Submit a piece</a></li>
    <li><a href="/artshare/places/commission.php">Commissions</a></li>
    <li><a href="/artshare/places/search.php">Search</a></li>
    <li><a onclick="logout()">Logout</a></li>
    </ul>
USERLINKS;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Artshare</title>

        <link rel="stylesheet" href="/artshare/css/foundation.css">
        <link rel="stylesheet" href="/artshare/css/foundation-icons.css">
        <link rel="stylesheet" href="/artshare/css/app.css">
        <link rel="stylesheet" href="/artshare/jqueryconfirm/jquery-confirm.min.css">

        <script src="/artshare/js/vendor/jquery.js"></script>
        <script src="/artshare/js/vendor/what-input.js"></script>
        <script src="/artshare/js/vendor/foundation.js"></script>
        <script src="/artshare/jqueryconfirm/jquery-confirm.min.js"></script>
        <script src="/artshare/js/ajax.js"></script>
        <script src="/artshare/js/app.js"></script>            
    </head>
    <body>
        <div class="grid-container xy-grid">
            <div class="grid-x grid-padding-x">
                <div id="logo" class="cell">
                    <h1>Artshare</h1>
                </div>
            </div>

            <div id="content" class="grid-x grid-margin-x">

                <div id = "nav" sclass="cell large-2 medium-2 small-2 cell-auto-height">
                    <?php !$_SESSION['user'] ? guest_nav() : user_nav(); ?>
                </div>