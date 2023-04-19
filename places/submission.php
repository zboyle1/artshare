<?php
	include '../header.php';
    include '../footer.php';

    $id = $_GET['id'];
    $userid = $_SESSION['userid'];
?>

<div class="cell small-10 medium-10 large-10">
    <div class="grid-x grid-padding-x" id="mainsubcontent">
        <!-- The pencil will convert page into a form where user can change anything about their own submission -->
        <div class="cell" id="pagetitle">
            <h3>Title by user<?php echo ($_SESSION['user'] != $_GET['user']) ? : '<a onclick="false"><i class="fi-pencil"></i></a>';?></h3>
        </div>

        <div class = "cell" id="submission" style="margin-bottom:1em;">
            <img src = "/artshare/assets/placeholder.png">
            <!-- 
            in the ajax call, determine what type the submission is. if its written, display the writing instead of an image 
            <div class="callout" id="writing">
            </div>
            -->
        </div>
        
        <div class ="cell">
            <div class="grid-x grid-padding-x" id="information">
                <div class = "cell large-4 medium-4 small-6">
                    <table>
                        <tr>
                            <td>Submission type:<td>
                        </tr><tr>
                            <td>Post date:</td>
                        </tr><tr>
                            <td>Favorites:</td>
                        </tr><tr>
                            <td>Comments:</td>
                        </tr><tr>
                        <!-- This will be within an if statement, for now this is for an image -->
                            <td>Medium:</td>
                        <!--
                            <td>Word count:</td>

                            <td>Genre:</td>
                        </tr><tr>
                            <td>BPM:</td>
                        -->
                        </tr>
                    </table>
                </div>
        
                <div class="cell large-8 medium-8 small-6">
                    <div class = "callout">
                        Description of the submission
                    </div>
                </div>
            </div>
        </div>

        <div class="cell">
            <div class="button-group">
                <a class="button" href="/artshare/newcomment.php?id=">Comment</a>
                <a class="secondary button" onclick="unfavorite(<?php echo $userid . ',' . $id ?>)" id="un"><i class="fi-star"></i>
Unfavorite</a>
                <a class="warning button" onclick="favorite(<?php echo $userid . ',' . $id ?>)" id="fav"><i class="fi-star hollow"></i>
Favorite</a>
            </div>
        </div>

        <div class="cell" id="comments">
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
</script>    
<?php
    send_footer();
?>