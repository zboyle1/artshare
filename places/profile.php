<?php
	include '../header.php';
    include '../footer.php';
    $user = $_GET['user'];
?>
<div class="cell medium-10 large-10">
    <div class="grid-x grid-padding-x" id= "pets">
        <div class="cell large-4" id="pagetitle">
            <h2><?php echo $user ?>'s profile</h2>      
    </div>
</div>

<script>
    user = "<?php echo $user ?>"
</script>
<?php
    send_footer();
?>