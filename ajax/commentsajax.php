<?php

/* Operations done with comments
 * - New comments
 * - Delete comment
 * - Display comments
 */

define( 'DB_NAME', 'Artshare' );
define( 'DB_USER', 'Coral' );
define( 'DB_PASSWORD', ')78S]37r%V5u');
define( 'DB_HOST', 'localhost' );

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function comment() {
    global $conn;

    $picid = $_POST['picid'];
    $userid = $_POST['userid'];
    $body = $_POST['body'];

    $sql = "INSERT INTO Comments(member_id, submission_id, datepost, body) VALUES ($userid, $picid, curdate(), $body);";

    $result = $conn->query($sql);
}

function show() {
    global $conn;

    $picid = $_POST['picid'];

    $sql = "SELECT c.*, m.username
            FROM Submission
            JOIN Comments c ON Submission.submission_id = c.submission_id
            JOIN Member m ON c.member_id = m.member_id
            WHERE Submission.submission_id = $picid;";
    $result = $conn->query($sql);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $user = $row['username'];
            $date = $row['datepost'];
            $body = $row['body'];


            echo '<div class="cell">' .
                 '<div class="card expanded">' .
                 '<div class="card-divider">' .
                    '<div class="grid-x grid-padding-x">' .
                        '<div class="cell auto">' .
                            '<b>' . $user . '</b>' .
                        '</div>' .
                    
                        '<div class="cell shrink">' .
                            $date .
                        '</div>' .
                    '</div>' .
                 '</div>' .

                 '<div class="card-section">' .
                    '<p>' . $body . '</p>' .
                 '</div>' .
                 '</div>' .
                 '</div>' ;
        }
    } else {
        echo '<div class = "cell"><div class="callout">No comments!</div></div>';
    }
}

$cmd = $_POST['cmd'];

if($cmd == 'comment') {
    comment();
} else if($cmd == 'show') {
    show();
}

mysqli_close($conn);