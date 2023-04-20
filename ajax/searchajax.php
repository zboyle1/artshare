<?php
define( 'DB_NAME', 'Artshare' );
define( 'DB_USER', 'Coral' );
define( 'DB_PASSWORD', ')78S]37r%V5u');
define( 'DB_HOST', 'localhost' );

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

    $search_query = $_POST['searchquery'];

    if (isset($_POST['searchquery'])) {
        $search_query = htmlspecialchars($_POST['searchquery']);

        $sql = "SELECT DISTINCT * FROM Submission WHERE title LIKE '%$search_query%' OR description LIKE '%$search_query%' OR keywords LIKE '%$search_query%'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

            echo '<div class="cell">' .
                 '<h1>Search Results for ' . $search_query . '</h1>';

            while ($row = mysqli_fetch_assoc($result)) {
                $title = $row['title'];
                $member_id = $row['member_ID'];
                $picid = $row['submission_id'];

                echo '</div>' .
                     '<div class ="cell large-4">' .
                     '<div class="card">' .
                     '<a href="../places/submission.php?id=' . $picid . '">' .
                     '<img src = "/artshare/assets/' . $picid . '.png">' .
                     '<h3>' . $title . '</h3>' .
                     '<p>Submitted by member #' . $member_id . '</p>'.
                     '</div>';
            }
            echo '</div>';
        } else {
            echo '<p>No results found for ' . $search_query . '</p>';
        }

    }



mysqli_close($conn);