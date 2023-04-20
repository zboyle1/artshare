<?php
	include '../header.php';
    include '../footer.php';
    $user = $_SESSION['userid'];
    $picid = $_GET['id'];
?>

<div class="cell small-10 medium-10 large-10">
    <div class="grid-x grid-padding-x shrink">
        <div class="cell" id="pagetitle">
            Add a new comment
        </div>
        
        <div class = "cell">
            <img src = "/artshare/assets/placeholder.png">
        </div>

        <div class = "cell">
            <form onsubmit="return(comment('<?php echo $user . ',' . $picid ?>'))">
                <label>Comment
                    <textarea placeholder="Write your comment here" name = "com" id="com"></textarea>
                </label>
            
                <button class = "submit button">Submit</button>
	        </form>
        </div>
    </div>
</div>

<?php
    send_footer();
?>