<?php

/* Search functions
 * - Search submissions based on title
 */

define( 'DB_NAME', 'Artshare' );
define( 'DB_USER', 'Coral' );
define( 'DB_PASSWORD', ')78S]37r%V5u');
define( 'DB_HOST', 'localhost' );

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function searchfor($search_query) {

    $sql = "SELECT * FROM submissions WHERE title LIKE '%$search_query%' OR description LIKE '%$search_query%' OR keywords LIKE '%$search_query%'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['title'];
            $description = $row['description'];
            $keywords = $row['keywords'];
            $member_id = $row['member_id'];

            echo "<div class='submission'>
                    <h3>$title</h3>
                    <p>$description</p>
                    <p>Keywords: $keywords</p>
                    <p>Submitted by member #$member_id</p>
                  </div>";
        }
    } else {
        echo "<p>No results found for '$search_query'</p>";
    }

}


mysqli_close($conn);