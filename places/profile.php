<?php
	include '../header.php';
    include '../footer.php';
    $user = $_GET['user'];
    $userid = $_SESSION['userid'];
?>
<div class="cell small-10 medium-10 large-10">
    <div class="grid-x grid-padding-x" id = "profile">
        <div class="cell" id="pagetitle">
            <h2><?php echo $user ?>'s profile</h2> 
            <a class="button" <?php echo ($_SESSION['user'] != $user) ? '' : 'style="display:none;"';?> href="/artshare/places/request.php?artist='<?php echo $user ?>'">Request commission</a>
        </div>
        <div class ="cell">

        <!-- userinfo -->
            <div class="grid-x grid-padding-x" id="userinfo">
                <!-- will be from ajax -->
                
                <!-- /will be from ajax -->
            </div>
        <!-- /userinfo -->

        <!-- usersubmissions -->
            <div class="grid-x grid-padding-x">
                <!-- from ajax -->
                <div class="callout-wrapper">
                    <h4 class="subheader">Submissions</h4>
                    <div class="callout" id ="index">
                        <div class="image-container" id = "usersub"><!-- from ajax --></div>
                    </div>
                </div>
            </div>
        <!-- /usersubmissions -->

        <!-- userfavorites -->
            <div class="grid-x grid-padding-x">
                <div class="callout-wrapper">
                    <h4 class="subheader">Favorites</h4>
                    <div class="callout" id ="index">
                        <div class="image-container" id = "userfav"><!-- from ajax --></div>
                    </div>
                </div>
            </div>
        <!-- /usersubmissions -->
        </div>
    </div>
</div>

<script>
    user = "<?php echo $userid ?>"
    
    prosubs(user);
    profavs(user);
    profile(user);
</script>
<?php
    send_footer();
?>