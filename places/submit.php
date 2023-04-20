<?php
	include '../header.php';
    include '../footer.php';
    $user = $_SESSION['userid'];
?>

<div class="cell small-10 medium-10 large-10">
    <div class="grid-x grid-padding-x shrink">
        <div class="cell" id="pagetitle">
            Submit
        </div>
        
        <div class = "cell">
            <img src = "/artshare/assets/placeholder.png">
        </div>

        <div class = "cell">
            <form onsubmit="return(uploadsub('<?php echo $user ?>'))">
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

                <fieldset id="type">
                    <input type="radio" name="type" value="visual" id="visual" required><label for="visual">Visual</label>
                    <input type="radio" name="type" value="written" id="written"><label for="written">Written</label>
                    <input type="radio" name="type" value="audio" id="audio"><label for="audio">Audio</label>
                </fieldset>

                <select id="medium" style="display:none;">
                    <option value="painting">Paint</option>
                    <option value="charcoal">Charcoal/Graphite</option>
                    <option value="pastels">Pastels</option>
                    <option value="digital">Digtal</option>
                    <option value="collage">Collage</option>
                    <option value="other">Other</option>
                </select>

                <input type="text" placeholder="enter wordcount" id="wordcount" style="display:none;">
                <input type="text" placeholder="enter bpm" id="bpm" style="display:none;">

                <select id="genre" style="display:none;">
                    <option value="pop">Pop</option>
                    <option value="rock">Rock/Alt</option>
                    <option value="rb">R&B</option>
                    <option value="rap">Rap</option>
                    <option value="noise">Noise</option>
                    <option value="other">Other</option>
                </select>

                <div class = "callout alert" id="message"></div>
            
                <button class = "submit button">Submit</button>
	        </form>
        </div>
    </div>
</div>

<script>
    var myFieldset = document.getElementById("type");
    myFieldset.addEventListener("change", function(event) {
        if (event.target.value == "visual") {

            document.getElementById("medium").style.display = "block";

            document.getElementById("bpm").style.display = "none";
            document.getElementById("genre").style.display = "none";
            document.getElementById("wordcount").style.display = "none";
        } else if (event.target.value == "written") {

            document.getElementById("wordcount").style.display = "block";

            document.getElementById("bpm").style.display = "none";
            document.getElementById("genre").style.display = "none";
            document.getElementById("medium").style.display = "none";
        } else if (event.target.value == "audio") {
            
            document.getElementById("bpm").style.display = "block";
            document.getElementById("genre").style.display = "block";
            document.getElementById("medium").style.display = "none";
            document.getElementById("wordcount").style.display = "none";
        }
    });
</script>

<?php
    send_footer();
?>