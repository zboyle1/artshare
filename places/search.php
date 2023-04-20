<?php
    include '../header.php';
    include '../footer.php';

    if (isset($_GET['search'])) {
        $search_query = htmlspecialchars($_GET['search']);

        $results = searchfor($search_query);

        echo "<div class='cell small-10 medium-10 large-10'>
            <div class='grid-x grid-padding-x shrink'>
                <div class='cell' id='pagetitle'>
                    <h1>Search Results for \"$search_query\"</h1>
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
            <div class='grid-x grid-padding-x'>
                <div class='cell small-12'>
                    <h2>Results</h2>
                    <ul>";

        foreach ($results as $result) {
            echo "<li><a href='../submissions/view.php?id={$result['id']}'>{$result['title']}</a></li>";
        }

        echo "</ul></div></div></div>";
    } else {
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
    }

    send_footer();
?>