<?php
	include '../header.php';
    include '../footer.php';
?>

<div class="cell small-10 medium-10 large-10">
    <div class="grid-x grid-padding-x">
        <div class="cell" id="pagetitle">
            <h3>Commissions</h3>
        </div>

        <div class="cell" id="filter">
            <label for="status-filter">Filter by status:</label>
            <select id="status-filter">
                <option value="all">All</option>
                <option value="unfinished">Waiting on...</option>
                <option value="todo">To do</option>
                <option value="received">Received commissions</option>
                <option value="finished">Finalized commissions</option>
            </select>
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
    document.getElementById("status-filter").addEventListener("change", filterCommissions);
    
    
    function filterCommissions() {
        let status = document.getElementById("status-filter").value;
        
        if (status == "all") {
            document.getElementById("unfinished").style.display = "block";
            document.getElementById("todo").style.display = "block";
            document.getElementById("received").style.display = "block";
            document.getElementById("finished").style.display = "block";
        } else {
            document.getElementById("unfinished").style.display = "none";
            document.getElementById("todo").style.display = "none";
            document.getElementById("received").style.display = "none";
            document.getElementById("finished").style.display = "none";
            
            document.getElementById(status).style.display = "block";
        }
    }
    
    userid = <?PHP echo $_SESSION['userid']; ?>;

    showunfinished(userid);
    showtodo(userid);
    showreceived(userid);
    showfinished(userid);
</script>    
<?php
    send_footer();
?>