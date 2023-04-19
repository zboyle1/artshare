<?php
	include '../header.php';
    include '../footer.php';
?>

<div class="cell small-10 medium-10 large-10">
    <div class="grid-x grid-padding-x">
        <div class="cell" id="pagetitle">
            <h3>Commissions</h3>
        </div>

        <div class ="cell" id="commcontent">
            <div class="grid-x grid-padding-x shrink">
                <div class = "cell large-6 medium-12 small-12" id = "unfinished">
                    <h4 class="subheader">Waiting on...</h4>
                </div>
        
                <div class = "cell large-6 medium-12 small-12" id = "todo">
                    <h4 class="subheader">To do</h4>
                </div>

                <div class = "cell large-6 medium-12 small-12" id = "received">
                    <h4 class="subheader">Recieved commissions</h4>
                </div>

                <div class = "cell large-6 medium-12 small-12" id = "finished">
                    <h4 class="subheader">Finalized commissions</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    userid = <?PHP echo $_SESSION['userid']; ?>;

    showunfinished(userid);
    showtodo(userid);
    showreceived(userid);
    showfinished(userid);
</script>    
<?php
    send_footer();
?>