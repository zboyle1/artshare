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

function showunfinished() {
    $userid = $_POST['user'];

    global $conn;

    $sql = "SELECT commission_id, username AS artist, startdate, price, payment
            FROM Commission
            JOIN Member ON Commission.artist_id = Member.member_id
            WHERE commissioner_id = $userid
            AND finish_date IS NULL
            ORDER BY start_date ASC;";

    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<table class="hover unstriped">' .
             '<thead>' .
             '<tr>' .
             '<th width = "150">ID</th>' .
             '<th>Artist</th>' .
             '<th>Start date</th>' .
             '<th>Price</th>' .
             '<th>Payment</th>' .
             '</tr>' .
             '</thead>' .
             '<tbody id="unfincom">';

		while($row = mysqli_fetch_assoc($result)) {
            $commid = $row['commission_id'];
            $artist = $row['artist'];
            $start_date = $row['startdate'];
            $price = $row['price'];
            $payment = $row['payment'];

            echo '<tr><td>' . $commid . '</td>' .
				 '<td>' . $artist . '</td>' .
				 '<td>' . $start_date . '</td>' .
                 '<td>' . $price . '</td>' .
                 '<td>' . $payment . '</td></tr>';
        }
        echo '</tbody> </table>';
    } else {
        echo '<div class="callout secondary">You\'re not waiting on any commissions</div>';
    }
}

function showtodo() {
    $userid = $_POST['user'];

    global $conn;

    $sql = "SELECT commission_id, username AS commissioner, startdate, price, payment
            FROM Commission
            JOIN Member ON Commission.commissioner_id = Member.member_id
            WHERE artist_id = $userid
            WHERE finish_date IS NULL
            ORDER BY start_date ASC;";

    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<table class="hover unstriped">' .
             '<thead>' .
             '<tr>' .
             '<th width = "150">ID</th>' .
             '<th>Commissioner</th>' .
             '<th>Start date</th>' .
             '<th>Price</th>' .
             '<th>Payment</th>' .
             '</tr>' .
             '</thead>' .
             '<tbody id="unfincom">';

		while($row = mysqli_fetch_assoc($result)) {
            $commid = $row['commission_id'];
            $commissioner = $row['commissioner'];
            $start_date = $row['startdate'];
            $price = $row['price'];
            $payment = $row['payment'];

            echo '<tr><td>' . $commid . '</td>' .
				 '<td>' . $commissioner . '</td>' .
				 '<td>' . $start_date . '</td>' .
                 '<td>' . $price . '</td>' .
                 '<td>' . $payment . '</td></tr>';
        }
        echo '</tbody> </table>';
    } else {
        echo '<div class="callout secondary">You have no commissions to-do</div>';
    }
}

function showreceived() {
    $userid = $_POST['user'];

    global $conn;

    $sql = "SELECT commission_id, username AS artist, finish_date, price, payment
            FROM Commission
            JOIN Member ON Commission.artist_id = Member.member_id
            WHERE commissioner_id = $userid
            AND finish_date IS NOT NULL
            ORDER BY finish_date DESC;";

    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<table class="hover unstriped">' .
             '<thead>' .
             '<tr>' .
             '<th width = "150">ID</th>' .
             '<th>Artist</th>' .
             '<th>Finish date</th>' .
             '<th>Price</th>' .
             '<th>Payment</th>' .
             '</tr>' .
             '</thead>' .
             '<tbody id="unfincom">';

		while($row = mysqli_fetch_assoc($result)) {
            $commid = $row['commission_id'];
            $artist = $row['artist'];
            $finish_date = $row['finish_date'];
            $price = $row['price'];
            $payment = $row['payment'];

            echo '<tr><td>' . $commid . '</td>' .
				 '<td>' . $artist . '</td>' .
				 '<td>' . $finish_date . '</td>' .
                 '<td>' . $price . '</td>' .
                 '<td>' . $payment . '</td></tr>';
        }
        echo '</tbody> </table>';
    } else {
        echo '<div class="callout secondary">You have not received any commissions</div>';
    }
}

function showfinished() {
    $userid = $_POST['user'];

    global $conn;

    $sql = "SELECT commission_id, username AS commissioner, finish_date, price, payment
            FROM Commission
            JOIN Member ON Commission.commissioner_id = Member.member_id
            WHERE artist_id = $userid
            AND finish_date IS NOT NULL
            ORDER BY finish_date DESC;";

    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<table class="hover unstriped">' .
             '<thead>' .
             '<tr>' .
             '<th width = "150">ID</th>' .
             '<th>Commissioner</th>' .
             '<th>Finish date</th>' .
             '<th>Price</th>' .
             '<th>Payment</th>' .
             '</tr>' .
             '</thead>' .
             '<tbody id="unfincom">';

		while($row = mysqli_fetch_assoc($result)) {
            $commid = $row['commission_id'];
            $commissioner = $row['commissioner'];
            $start_date = $row['startdate'];
            $price = $row['price'];
            $payment = $row['payment'];

            echo '<tr><td>' . $commid . '</td>' .
				 '<td>' . $commissioner . '</td>' .
				 '<td>' . $start_date . '</td>' .
                 '<td>' . $price . '</td>' .
                 '<td>' . $payment . '</td></tr>';
        }
        echo '</tbody> </table>';
    } else {
        echo '<div class="callout secondary">You have not finished any commissions</div>';
    }
}

function startnew() {

}

function markfinished() {

}

function filterhigherthanavg() {

}

function fromreapeatcust() {

}

function fromprevartist() {

}

$cmd  = $_POST['cmd'];

if($cmd == 'unfinished') {
    showunfinished();

} else if($cmd == 'todo') {
    showtodo();

} else if($cmd == 'received') {
    showreceived();

} else if($cmd == 'finished') {
    showfinished();

} else if($cmd == 'new') {
    startnew();

} else if($cmd == 'complete') {
    markfinished();

} else if($cmd == 'filter1') {
    filterhigherthanavg();

} else if($cmd == 'filter2') {
    fromreapeatcust();

} else if($cmd == 'filter3') {
    fromprevartist();
}

mysqli_close($conn);