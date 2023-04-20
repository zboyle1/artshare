<?php
    include '../header.php';
    include '../footer.php';   
?>
        <div class='cell small-10 medium-10 large-10'>
            <div class='grid-x grid-padding-x shrink'>
                <div class='cell' id='pagetitle'>
                    <h1>Search</h1>
                </div>
            </div>
            <div class='grid-x grid-padding-x'>
                <div class='cell small-12 medium-6 large-6'>
                    <form onsubmit="return(searchfor())">
                        <input type='text' name='search' placeholder='Search' id = "search">
                        <button class='button submit'>Search</button>
                    </form>
                </div>
            </div>
            <div class='grid-x grid-padding-x shrink' id ="results">
            </div>
        </div>
<?php
    send_footer();
?>