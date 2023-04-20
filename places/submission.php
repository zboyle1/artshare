<?php
	include '../header.php';
    include '../footer.php';

    $id = $_GET['id'];
    $userid = $_SESSION['userid'];
?>

<div class="cell small-10 medium-10 large-10">
    <div class="grid-x grid-padding-x" id="mainsubcontent">
        <div class ="cell">
            <div class="callout alert" id="message"></div>
        </div>
    </div>

    <div class="grid-x grid-padding-x">
        <div class="cell">
            <div class="button-group">
                <a class="button" href="/artshare/places/addcomment.php?id=<?php echo $id ?>">Comment</a>
                <a class="secondary button" onclick="unfav(<?php echo $userid . ',' . $id ?>)" id="un"><i class="fi-star"></i>
Unfavorite</a>
                <a class="warning button" onclick="fav(<?php echo $userid . ',' . $id ?>)" id="fav"><i class="fi-star hollow"></i>
Favorite</a>
            </div>
        </div>
    </div>

    <div class="grid-x grid-padding-x" id="comments">
        
    </div>
</div>

<script>
    picid = <?php echo $id ?>;
    userid = <?php echo $userid ?>;

    showsubinfo(userid, picid);
    isfav(userid, picid);
    showcomments(picid);
</script>    
<?php
    send_footer();
?>