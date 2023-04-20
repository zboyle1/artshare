<?php
	include '../header.php';
    include '../footer.php';
    $user = $_SESSION['userid'];
    $picid = $_GET['id'];
?>

<div class="cell small-10 medium-10 large-10">
    <div class="grid-x grid-padding-x shrink">
        <div class="cell" id="pagetitle">
            Submit
        </div>
        
        <div class = "cell">
            <img src = "/artshare/assets/<?php echo $picid ?>.png">
        </div>

        <div class = "cell">
            <form onsubmit="return(editsub('<?php echo $user ?>', '<?php echo $picid?>'))">
		        <label>Title
                    <input type="text" id="title" required>
                </label>

                <span class="form-error">
                    You must add a title
                </span>

                <label>Description
                    <textarea placeholder="Write a short description about your work" name = "desc" id="desc"></textarea>
                </label>

                <label>Keywords
                    <input type="text" placeholder="Seperate with commas" id="keywords" required>
                </label>

                <span class="form-error">
                    Please add some keywords!
                </span>
                <div class = "callout alert" id="message"></div>
            
                <button class = "submit button">Submit</button>
	        </form>
        </div>
    </div>
</div>
<?php
    send_footer();
?>