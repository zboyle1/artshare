<?php

/* Operations done mainly on submissions
 * - displaying submissions
 * - Inserting new submissions
 * - Deleting submissions
 * - Favortie / Unfavorite
 */

define( 'DB_NAME', 'Artshare' );
define( 'DB_USER', 'Coral' );
define( 'DB_PASSWORD', ')78S]37r%V5u');
define( 'DB_HOST', 'localhost' );

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// front page display
function foryou() {
    $userid = $_POST['userid'];

    global $conn;

    $sql = "SELECT s.submission_id
            FROM Submission s
            JOIN (
                SELECT k.submission_id, COUNT(*) AS keyword_count
                FROM keywords k
                JOIN (
                    SELECT submission_id FROM Comments WHERE member_id = 1234
                    UNION ALL
                    SELECT submission_id FROM Favorite WHERE member_id = 1234
                ) temp ON k.submission_id = temp.submission_id
                GROUP BY k.submission_id
            ORDER BY keyword_count DESC
            LIMIT 3
            ) top_submissions ON s.submission_id = top_submissions.submission_id
            ORDER BY s.upload_date DESC";

    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['submission_id'];

            echo '<a href = "/artshare/places/submission.php?=' . $id . '">' .
                 // '<img src="/artshare/assets/' . $id . '.png">'; 
                 '<img src="/artshare/assets/placeholder.png">' .
                 '</a>';
        }
    } else {
        echo '0';
    }

}

function newest() {
    global $conn;

    $sql = "SELECT submission_id FROM Submission ORDER BY upload_date DESC LIMIT 6";

    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['submission_id'];

            echo '<a href = "/artshare/places/submission.php?=' . $id . '">' .
                 // '<img src="/artshare/assets/' . $id . '.png">'; 
                 '<img src="/artshare/assets/placeholder.png">' .
                 '</a>';
        }
    } else {
        echo 'An error occured';
    }
}

function popular() {
    global $conn;

    $sql = "SELECT submission_id, COUNT(*) as favorite_count
            FROM Favorite
            GROUP BY submission_id
            ORDER BY favorite_count DESC
            LIMIT 6";

    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['submission_id'];

            echo '<a href = "/artshare/places/submission.php?=' . $id . '">' .
                 // '<img src="/artshare/assets/' . $id . '.png">'; 
                 '<img src="/artshare/assets/placeholder.png">' .
                 '</a>';
        }
    } else {
        echo 'An error occured';
    }
}

function talkedabout() {
    global $conn;

    $sql = "SELECT submission_id
            FROM Comments
            GROUP BY submission_id
            ORDER BY COUNT(*) DESC
            LIMIT 6";

    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['submission_id'];

            echo '<a href = "/artshare/places/submission.php?=' . $id . '">' .
                 // '<img src="/artshare/assets/' . $id . '.png">'; 
                 '<img src="/artshare/assets/placeholder.png">' .
                 '</a>';
        }
    } else {
        echo 'An error occured';
    }
}

$cmd = $_POST['cmd'];

if($cmd == 'foryou') {
    foryou();
} else if($cmd == 'newest') {
    newest();
} else if($cmd == 'popular') {
    popular();
} else if($cmd == 'talkedabout') {
    talkedabout();
} else 

mysqli_close($conn);