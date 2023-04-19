<?php
    include '../header.php';
    include '../footer.php';

    // Check if a search query was submitted
    if (isset($_GET['search'])) {

        $sql = "SELECT Submission_ID, Title, Upload_Date, Description, Keywords, Member_ID FROM Submission WHERE Title LIKE ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["%{$search_query}%"]);

        // Display the search results
        if ($stmt->rowCount() > 0) {
            echo "<div class='cell small-10 medium-10 large-10'>
                    <div class='grid-x grid-padding-x shrink'>
                        <div class='cell' id='pagetitle'>
                            <h1>Search Results for '{$search_query}'</h1>
                        </div>
                    </div>";

            while ($row = $stmt->fetch()) {
                echo "<div class='grid-x grid-padding-x'>
                        <div class='cell small-12 medium-6 large-6'>
                            <h2>{$row['Title']}</h2>
                            <p>{$row['Description']}</p>
                            <p>Keywords: {$row['Keywords']}</p>
                            <p>Submitted by member ID: {$row['Member_ID']}</p>
                        </div>
                    </div>";
            }

            echo "</div>";
        } else {
            echo "<div class='cell small-10 medium-10 large-10'>
                    <div class='grid-x grid-padding-x shrink'>
                        <div class='cell' id='pagetitle'>
                            <h1>No results found for '{$search_query}'</h1>
                        </div>
                    </div>
                </div>";
        }
    }

    echo "<div class='cell small-10 medium-10 large-10'>
            <div class='grid-x grid-padding-x shrink'>
                <div class='cell' id='pagetitle'>
                    <h1>Search</h1>
                </div>
            </div>
            <div class='grid-x grid-padding-x'>
                <div class='cell small-12 medium-6 large-6'>
                    <form method='GET' action='search.php'>
                        <input type='text' name='search' placeholder='Search'>
                        <button type='submit'>Search</button>
                    </form>
                </div>
            </div>
        </div>";

   
    send_footer();
?>