<?php
	include 'header.php';
    include 'footer.php';
?>
<div class="cell small-10 medium-10 large-10">
    <div class="grid-x grid-padding-x shrink">
        <div class="cell" id="pagetitle">
        
        </div>

        <div class="cell" id="main">
            <div class="callout-container">
                <div class="callout-wrapper" id = "optional">
                    <h4 class ="subheader">For you</h4>
                    <div class="callout" id ="index">
                        <div class="image-container" id = "foryou"></div>
                    </div>
                </div>
                
                <div class="callout-wrapper">
                    <h4 class ="subheader">Newest submissions</h4>
                    <div class="callout" id ="index">
                        <div class="image-container" id = "newest"></div>
                    </div>
                </div>
                    
                <div class="callout-wrapper">
                    <h4 class ="subheader">Most popular</h4>
                    <div class="callout"  id ="index">
                        <div class="image-container" id = "popular"></div>
                    </div>
                </div>
                    
                <div class="callout-wrapper">
                    <h4 class ="subheader">Most talked about</h4>
                    <div class="callout" id ="index">
                        <div class="image-container" id = "talkedabout"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
userid = <?php echo $_SESSION['userid']; ?>;

foryou(userid);
newest();
popular();
talkedabout();

</script>

<?php
    send_footer();
?>