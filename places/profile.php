<?php
	include '../header.php';
    include '../footer.php';
    $user = $_GET['user'];
?>
<div class="cell small-10 medium-10 large-10">
    <div class="grid-x grid-padding-x" id = "profile">
        <div class="cell" id="pagetitle">
            <h2><?php echo $user ?>'s profile</h2> 
        </div>
        <div class ="cell">

        <!-- userinfo -->
            <div class="grid-x grid-padding-x" id="userinfo">
                <!-- will be from ajax -->
                <div class = "cell large-6 medium-6 small-6">
                    <h3 class="subheader">User Information</h3>
                    <table>
                        <tr>
                            <td><b>Username:</b></td>
                        </tr>
                        <tr>
                            <td><b>Email:</b></td>
                        </tr>
                        <tr>    
                            <td><b>Age:</b></td>
                        </tr>
                        <tr>    
                            <td><b>Join date:</b></td>
                        </tr>
                    </table>
                </div>

                <div class = "cell large-6 medium-6 small-6">
                    <!-- The pencil will change the about section to a text area, when submitting the textarea the about will be changed and the new about will be displayed-->
                    <h3 class="subheader">About <?php echo ($_SESSION['user'] != $user) ? '' : '<a onclick="false"><i class="fi-pencil"></i></a>';?></h3>
                    <div class = "callout" id="about"> </div>
                </div>
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
    user = "<?php echo $user ?>"
</script>
<?php
    send_footer();
?>