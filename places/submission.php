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
                <a class="button" href="/artshare/newcomment.php?id=">Comment</a>
                <a class="secondary button" onclick="unfavorite(<?php echo $userid . ',' . $id ?>)" id="un"><i class="fi-star"></i>
Unfavorite</a>
                <a class="warning button" onclick="favorite(<?php echo $userid . ',' . $id ?>)" id="fav"><i class="fi-star hollow"></i>
Favorite</a>
            </div>
        </div>
    </div>

    <div class="grid-x grid-padding-x" id="comments">
        <div class="cell">
        <!-- from ajax -->
            <div class="card expanded">
                <div class="card-divider">
                    <div class="grid-x grid-padding-x">
                        <div class="cell auto">
                            <?php echo ($_SESSION['user'] != $_GET['user']) ? '' : '<a onclick="false"><i class="fi-pencil"></i></a>';?>
                            <b>Username</b>
                        </div>
                    
                        <div class="cell shrink">
                            Date
                        </div>
                    </div>
                </div>

                <div class="card-section">
                    <p>Comment content goes here</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    picid = <?php echo $id ?>;
    userid = <?php echo $userid ?>;

    showsubinfo(userid, picid);
</script>    
<?php
    send_footer();
?>