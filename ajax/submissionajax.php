<?php

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

            echo '<a href = "/artshare/places/submission.php?id=' . $id . '">' .
                 '<img src="/artshare/assets/' . $id . '.png">'.
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
                 '<img src="/artshare/assets/' . $id . '.png">'.
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

            echo '<a href = "/artshare/places/submission.php?id=' . $id . '">' .
                 '<img src="/artshare/assets/' . $id . '.png">'.
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

            echo '<a href = "/artshare/places/submission.php?id=' . $id . '">' .
                 '<img src="/artshare/assets/' . $id . '.png">'.
                 '</a>';
        }
    } else {
        echo 'An error occured';
    }
}

// Submission page
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

        $allowedit = ($userid != $artistid) ? '' : ' <a href="/artshare/places/editsubmission.php?id=' . $picid . '"><i class="fi-pencil"></i></a>';

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
             '<h3>' . $title . ' by <a href ="/artshare/places/profile.php?user=' . $artist . '">' . $artist . '</a>' . $allowedit . '</h3>' .
             '</div>' .

             '<div class = "cell" id="submission" style="margin-bottom:1em;">' .
             '<img src = "/artshare/assets/' . $picid . '.png">' .
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

// Profile
function profilesub() {
    global $conn;

    $user = $_POST['userid'];
    $sql = "SELECT member_id FROM Member WHERE username = '$user';";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);

    $userid = $row['member_id'];

    $sql = "SELECT submission_id
            FROM Submission
            WHERE member_ID = $userid";

    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['submission_id'];

            echo '<a href = "/artshare/places/submission.php?id=' . $id . '">' .
                 '<img src="/artshare/assets/' . $id . '.png">'.
                 '</a>';
        }
    } else {
        echo 'An error occured';
    }
}

function profilefav() {
    global $conn;

    $user = $_POST['userid'];
    $sql = "SELECT member_id FROM Member WHERE username = '$user';";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);

    $userid = $row['member_id'];

    $sql = "SELECT submission_id
            FROM Favorite
            WHERE member_ID = $userid";

    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['submission_id'];

            echo '<a href = "/artshare/places/submission.php?id=' . $id . '">' .
                 '<img src="/artshare/assets/' . $id . '.png">';
                 '</a>';
        }
    } else {
        echo 'An error occured';
    }
}

function upload() {
    global $conn;

    $userid = $_POST['userid'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $keywords = $_POST['keywords'];
    $type = $_POST['type'];
    $picid = 6;

    if($type == 'visual') {
        $medium = $_POST['medium'];
        $sql2 = "INSERT INTO Imge (submission_id, medium)
        VALUES ($picid, '$medium');";
    } else if($type == 'written') {
        $wordcount = $_POST['wordcount'];
        $sql2 = "INSERT INTO Written (submission_id, word_count)
        VALUES ($picid, $wordcount);";
    } else if($type == 'audio') {
        $genre = $_POST['genre'];
        $bpm = $_POST['bpm'];
        $sql2 = "INSERT INTO Music (submission_id, genre, bpm)
                VALUES ($picid, '$genre', $bpm);";
    }

    $sql = "INSERT INTO Submission (submission_id, member_ID, title, upload_date, description, keywords)
            VALUES ($picid, $userid, '$title', curdate(), '$desc', '$keywords');";

    $result = $conn->query($sql);
    $result = $conn->query($sql2);

    $sql = "SELECT * FROM Submission WHERE submission_id = $picid";
    $result = $conn->query($sql);

    if(mysqli_num_rows($result) == 0) {
        echo '0';
    } else {
        echo '1';
    }
}

function edit() {
    global $conn;

    $userid = $_POST['userid'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $picid = $_POST['picid'];

    $sql = "UPDATE Submission 
            SET title = '$title', description = '$desc'
            WHERE submission_id = $picid AND member_id = $userid;";

    $result = $conn->query($sql);
}

function isfav() {
    global $conn;

    $userid = $_POST['userid'];
    $picid = $_POST['picid'];

    $sql = "SELECT * FROM Favorite WHERE submission_id = $picid AND member_id = $userid";
    $result = $conn->query($sql);

    if(mysqli_num_rows($result) == 0) {
        echo '0';
    } else {
        echo '1';
    }
}

function fav() {
    
    global $conn;

    $userid = $_POST['userid'];
    $picid = $_POST['picid'];

    $sql = "INSERT INTO Favorite(submission_id, member_id) VALUES($picid, $userid);";
    $result = $conn->query($sql);
    echo '1';
}

function unfav() {
    global $conn;

    $userid = $_POST['userid'];
    $picid = $_POST['picid'];

    $sql = "DELETE FROM Favorite WHERE submission_id = $picid AND member_id = $userid";
    $result = $conn->query($sql);
    echo '1';
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
} else if($cmd == 'upload') {
    upload();
} else if($cmd == 'edit') {
    edit();
} else if($cmd == 'isfav') {
    isfav();
} else if($cmd == 'fav') {
    fav();
} else if($cmd == 'unfav') {
    unfav();
}

mysqli_close($conn);