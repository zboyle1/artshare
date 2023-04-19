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
    $userid = $_POST['user'];

    global $conn;

    $sql = "SELECT s.submission_id
            FROM Submission s
            JOIN (
                SELECT k.submission_id, COUNT(*) AS keyword_count
                FROM keywords k
                JOIN (
                    SELECT submission_id FROM Comments WHERE member_id = $userid
                    UNION ALL
                    SELECT submission_id FROM Favorite WHERE member_id = $userid
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

            echo '<a href = "/artshare/places/submission.php?id=' . $id . '">' .
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

function showsubpage() {
    global $conn;

    $picid = $_POST['id'];
    $userid = $_POST['userid'];

    $sql = "SELECT s.*, (
                SELECT COUNT(*) FROM Favorite WHERE submission_id = s.submission_id
            ) AS favorite_count, (
                SELECT COUNT(*) FROM Comments WHERE submission_id = s.submission_id
            ) AS comment_count, (
                SELECT 'Written' FROM Written WHERE submission_id = s.submission_id 
                UNION SELECT 'Imge' FROM Imge WHERE submission_id = s.submission_id
                UNION SELECT 'Music' FROM Music WHERE submission_id = s.submission_id
            ) AS submission_type, (
                SELECT username FROM Member WHERE member_ID = s.member_id
            ) AS artist
            FROM Submission s
            WHERE s.submission_id = $picid;";

    $result = $conn->query($sql);

    if (mysqli_num_rows($result) == 0) {
        echo '0';
    } else {
        $row = mysqli_fetch_assoc($result);

        $artistid = $row['member_ID'];
        $artist = $row['artist'];
        $title = $row['title'];

        $allowedit = ($userid != $artistid) ? '' : ' <a href="/artshare/places/editsub.php?id=' . $picid . '"><i class="fi-pencil"></i></a>';

        $date = $row['upload_date'];
        $numfav = $row['favorite_count'];
        $numcom = $row['comment_count'];

        $type = $row['submission_type'];
        $typerow = '';

        $desc = $row['description'];
        
        $sql = "SELECT * FROM $type WHERE submission_id = $picid;";
        $result = $conn->query($sql);
        $row2 = mysqli_fetch_assoc($result);

        if($type == 'Imge') {
            $typerow = '<td>Medium:</td>
                        <td>' . $row2['medium'] . '</td>';

        } else if($type == 'Audio') {
            $typerow = '<td>Genre:</td>
                        <td>' . $row2['genre'] . '</td>
                        </tr><tr>
                        <td>BPM:</td>
                        <td>' . $row2['bpm'] . '</td>';

        } else if($type = 'Written') {
            $typerow = '<td>Word count:</td>
                        <td>' . $row2['word_count'] . '</td>';              
        }

        echo '<div class="cell" id="pagetitle">' .
             '<h3>' . $title . ' by ' . $artist .  $allowedit . '</h3>' .
             '</div>' .

             '<div class = "cell" id="submission" style="margin-bottom:1em;">' .
             '<img src = "/artshare/assets/placeholder.png">' .
             '</div>' .
              
             '<div class = "cell large-4 medium-4 small-6">' .
                    '<table>' .
                            '<tr>' .
                            '<td>Post date:</td>' .
                            '<td>' . $date . '</td>' .
                        '</tr><tr>' .
                            '<td>Favorites:</td>' .
                            '<td>' . $numfav . '</td>' .
                        '</tr><tr>' .
                            '<td>Comments:</td>' .
                            '<td>' . $numcom . '</td>' .
                        '</tr><tr>' .
                        $typerow .
                        '</tr>' .
                    '</table>' .
                '</div>' .
        
                '<div class="cell large-8 medium-8 small-6">' .
                    '<div class = "callout">' .
                        $desc .
                    '</div>' .
                '</div>';
    }
}

function profilesub() {

}

function profilefav() {

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
} else if($cmd == 'subpage') {
    showsubpage();
} else if($cmd == 'profilesub') {
    profilesub();
} else if($cmd == 'profilefav') {
    profilefav();
}

mysqli_close($conn);